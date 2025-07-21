<?php
/**
 * Template Name: Custom RSS Template - Jobs
 */

do_action( 'jobs_before_feed' );

//header('Content-Type: text/html; charset=utf-8', true);
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
status_header(200);

// enable bottom header to download feed as file
//header('Content-Disposition: attachment; filename="jobs_feed.xml"');

// t.isken@baeckerei-isken.de
// 1e304c95b5456d75389afcfc77c752847c621cea09d275c8af8fc270185b1218 - needle
// 15af3caceb92963a7369422799fdb096253e26c2595f03450f78cffd2b3cbf8f8ac83c69abdc7aedf8df8ad5b7ca697d

// https://developer.indeed.com/docs/indeed-apply/direct-employer/#encryption_decryption
function pkcs5_pad ($text) {
    $blocksize = 16;
    $pad = $blocksize - (strlen($text) % $blocksize);
    $text .= str_repeat(chr($pad), $pad);
    return $text;
}

function pkcs5_unpad($text) {
    $pad = ord($text{strlen($text)-1});
    if ($pad > strlen($text)) return false;
    if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
    return substr($text, 0, -1 * $pad);
}

function encrypt($str, $key) {
    $iv = str_repeat("\0", 16);


    $str = pkcs5_pad($str);
    $opts =  OPENSSL_RAW_DATA;
    $encrypted = openssl_encrypt($str, 'AES-128-CBC', $key, $opts, $iv);
    return $encrypted;
}

function decrypt($str, $key) {
    $iv = str_repeat("\0", 16);
    $opts =  OPENSSL_RAW_DATA;
    $decrypted = openssl_decrypt($str, 'AES-128-CBC', $key, $opts, $iv);
    return pkcs5_unpad($decrypted);
}

$clientID = 'fb79957288dc680850f41b41127316083257dd8289673edca434add73fa6285a';
$apiSecret = 'R2skTCKRwZfLrxQyS3ty7K6NrjM7ThUVf27zafQHeubhLNejv4Rm6imFv0kssx8x';
$newkey = mb_strcut($apiSecret, 0, 16, "UTF8");

function encrypt_position_email(string $email, string $apiSecret = 'R2skTCKRwZfLrxQyS3ty7K6NrjM7ThUVf27zafQHeubhLNejv4Rm6imFv0kssx8x'): string
{
    // truncate api-secret to first 16 bytes
//    $newkey = mb_strcut($apiSecret, 0, 16, "UTF8");
    $newkey = utf8_encode($apiSecret);
    $newkey = mb_substr($newkey, 0, 16, "UTF-8");

//    var_dump($newkey);
//    die;


    // encrypt
    $encrypted = encrypt($email, $newkey);

    // we decrypt merely as an exercise
//    $decrypted = decrypt($encrypted, $newkey);
    // this is the value to send to Indeed
    $encryptedhex = bin2hex($encrypted);

//    return $encryptedhex;
//    if ($encryptedhex != "eaaacff9df2e4c2a63083a303d4521f0bd41e375232a2895310179bc030addfba655e21c3309d9343206ae55866764e8") {
//        print("invalid encrypted hex value!");
//    }

//    print("Hex value of encrypted: " . $encryptedhex . "n");
//    print($encrypted);
//    print(decrypt($encrypted, $newkey));
//    print("Decrypted: " . $decrypted . "n");

//    var_dump(decrypt('15af3caceb92963a7369422799fdb096253e26c2595f03450f78cffd2b3cbf8f8ac83c69abdc7aedf8df8ad5b7ca697d', $newkey));

    return mb_substr($encryptedhex, 0, 64, "UTF-8");
}

//Deadline field: position_valid_through
$deadlineMetaKey = 'position_valid_through';

$args = array(
    'post_type'   => 'jobs',
    'post_status' => ['publish'],
    'orderby'     => 'date',
    'order'       => 'DESC',
    'posts_per_page' => -1,
//     'posts_per_page' => 10,
    'meta_query' => [
        // Only who not have deadline or which deadline is not out of date
        'relation' => 'OR',
        [
            'key' => 'position_valid_through',
            'value' => date('d.m.Y'),
            'compare' => '>=',
        ],
        [
            'key' => 'position_valid_through',
            'value' => '',
            'compare' => 'IN',
        ],
    ],
);

$jobs = new WP_Query($args);

//echo wp_count_posts('jobs')->publish;
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<source>
<publisher>JetztJob</publisher>
<publisherurl><?php bloginfo_rss('url') ?></publisherurl>
<?php

$allowedDescriptionTags = ['<b>',
    '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>',
    '<br>', '<p>',
    '<ul>', '<li>',
    '<strong>', '<em>', '<table>', '<tbody>', '<th>', '<tr>', '<td>'];

if ( $jobs->have_posts() ):
    while ( $jobs->have_posts() ):
        $jobs->the_post();

        $post_id = $jobs->post->ID;
        // Source Name?
        $hiringOrganization = strip_tags(get_post_meta($post_id, 'position_hiring_organization_name', true));

        $titleKey = 'job_title_search'; // position_custom_text_1
        $positionTitle = strip_tags(get_post_meta($post_id, $titleKey, true));

        $positionCity = strip_tags(get_post_meta($post_id, 'position_job_location', true));
        $positionRegion = strip_tags(get_post_meta($post_id, 'position_job_location_addressRegion', true));
        $positionStreet = strip_tags(get_post_meta($post_id, 'position_job_location_streetAddress', true));
        $positionPostalCode = strip_tags(get_post_meta($post_id, 'position_job_location_postalCode', true));

        $positionDeadline = trim(get_post_meta($post_id, $deadlineMetaKey, true));

        $positionURL = esc_url(add_query_arg( 'source', 'Indeed', get_permalink($post_id)));

        $firma = get_the_terms($post_id, 'firma');
        $firmaObj = array_shift($firma);
        $firmaName = @$firmaObj->name;

        // tag open <([a-z]+)([^>]+)*>
        // tag close <\/([a-z]+)([^>]+)>
        // all content inside of tags (.*?)
        // <li([^>]+)*>(.*?)<\/li>

        //<li([^>]+)*>(.*[<]{1}.*)<\/(li)([^>]+)>
        $positionDescription = trim(strip_shortcodes(get_post_meta($post_id, 'position_description', true)));
        /*        $res = preg_replace('/(?<=<div.*?class="some-class".*?>)(.*?)(?=<\/div>)/g', $positionDescription);*/
//        $res = preg_replace('/<div(.*?)>', '', $positionDescription);
//        $res = preg_replace('#<div class="[]">(.*?)</div>#', '', $positionDescription);
//        $res = preg_replace('#<div class="[a-zA-Z0-9\s]+">#','', $positionDescription);
//        $res = preg_replace('#</div>#','', $positionDescription);
        $positionBenefits = trim(strip_shortcodes(get_post_meta($post_id, 'position_job_benefits', true)));
        $positionResponsibilities = trim(strip_shortcodes(get_post_meta($post_id, 'position_responsibilities', true)));
        $positionQualifications = trim(strip_shortcodes(get_post_meta($post_id, 'position_qualifications', true)));
        $positionContacts = trim(strip_shortcodes(get_post_meta($post_id, 'position_contacts', true)));
        $positionContacts = trim(str_replace(['[', ']'], '',$positionContacts));
        $fullDescription = trim(
            "<h2>Beschreibung</h2> ".
            $positionDescription
            .'<h2>Mitarbeitervorteile</h2> '
            .$positionBenefits
            .'<h2>Deine Aufgaben</h2> '
            .$positionResponsibilities
            .'<h2>Dein Profil</h2> '
            .$positionQualifications
            .'<h2>Haben wir dein Interesse geweckt?</h2> '
            .$positionContacts);
        $fullDescription = trim(str_replace(['  '], ' ', $fullDescription));
//        $fullDescription = trim(str_replace(["\r\n", '&nbsp;', ''], '', $fullDescription));
        $fullDescription = trim(str_replace(['&nbsp;', ''], '', $fullDescription));
        $fullDescription = trim(str_replace(["\r\n", "\n\n"], ["", "\n"], $fullDescription));

        $positionIndustry = strip_tags(get_post_meta($post_id, 'position_industry', true));

        $positionEmploymentType = get_post_meta($post_id, 'position_employment_type');

        $positionConfirmationEmail = trim(get_post_meta($post_id, 'job_confirmation_email', true));

        $jobTypesStr = '';
        if (count($positionEmploymentType)) {
            $filteredJobTypes = array_filter($positionEmploymentType[0], function ($item) {
                return $item !== 'OTHER';
            });

            $jobTypesValues = array_values($filteredJobTypes);
            $jobTypes = array_map(function ($item) {
                $item = str_replace('_', $item === 'PER_DIEM' ? ' ' : '-', $item);
                return ucwords(mb_strtolower($item));
            }, $jobTypesValues);

            $jobTypesStr = implode(', ', $jobTypes);
        }


        $salary = '';
        $currency_symbol = get_option( 'jobs_currency_symbol'.'_'.Job_Postings::getLang() );

        if (!$currency_symbol) {
            $currency_symbol = '€';
        }

        $key = 'position_base_salary';

        $values = get_post_custom($post_id);
        $value = isset($values[$key]) ? esc_attr($values[$key][0]) : '';
        $upto = isset($values[$key . '_upto']) ? esc_attr($values[$key . '_upto'][0]) : '';
        $unittext_value = isset($values[$key . '_unittext']) ? esc_attr($values[$key . '_unittext'][0]) : '';
        $unitText = $field['unitText'] ?? array();

        if ($currency_symbol) {
            $currency_position = get_option('jobs_currency_position' . '_' . Job_Postings::getLang());
            if (!$currency_position) $currency_position = 'before';

            $starting = '';
            $to = '';

            switch ($currency_position) {
                case 'after':
                    $salary .= $starting . $value . '' . $currency_symbol;
                    if ($upto) {
                        $salary .= $starting = apply_filters('job-postings/salary-range-separator', '');
                        $salary .= $to . $upto . '' . $currency_symbol;
                    }
                    break;
                default:
                    $salary .= $starting . $currency_symbol . '' . $value;
                    if ($upto) {
                        $salary .= $starting = apply_filters('job-postings/salary-range-separator', '');
                        $salary .= $currency_symbol . '' . $to . $upto;
                    }
                    break;
            }

        } else {
            $salary .= $value;
        }

        if (!empty($unitText) && isset($unitText[$unittext_value])) {
            $salary .= apply_filters('job-postings/unitText_output', $unitText[$unittext_value], $unittext_value, $unitText);
        }

        $salary = $salary !== '€' ? $salary : '';

        // Niederfüllbach - word with incorrect char which failde to fetch the job description and broke list retrieving

        //<id><?= $jobs->post->ID </id>
        //<sourcename><![CDATA[<?= @$hiringOrganization; ]]></sourcename>

        ?>
        <job>
            <title><![CDATA[<?= @$positionTitle ?>]]></title>
            <date><![CDATA[<?= get_the_date('D, j M Y G:i:s T', $jobs->post); ?>]]></date>
            <referencenumber><![CDATA[<?= @$post_id; ?>]]></referencenumber>
            <url><![CDATA[<?= @$positionURL; ?>]]></url>
            <company><![CDATA[<?= @$firmaName ? $firmaName : '' ?>]]></company>
            <sourcename><![CDATA[<?= @$hiringOrganization; ?>]]></sourcename>

            <city><![CDATA[<?= @$positionCity ?? ''; ?>]]></city>

            <?php if (@$positionRegion): ?>
                <state><![CDATA[<?= @$positionRegion; ?>]]></state>
            <?php else: ?>
                <state></state>
            <?php endif; ?>

            <country><![CDATA[Deutschland]]></country>
            <postalcode><![CDATA[<?= @$positionPostalCode; ?>]]></postalcode>

            <?php if (@$positionStreet): ?>
                <streetaddress><![CDATA[<?= @$positionStreet; ?>]]></streetaddress>
            <?php endif; ?>

            <email><![CDATA[contact@jetztjob.de]]></email>

            <description>
                <![CDATA[<?= trim(strip_tags(@$fullDescription, $allowedDescriptionTags)); ?>]]>
            </description>

            <?php if (@$salary): ?>
                <salary><![CDATA[<?= @$salary; ?>]]></salary>
            <?php endif; ?>

            <?php if (@$jobTypesStr): ?>
                <jobtype><![CDATA[<?= @$jobTypesStr; ?>]]></jobtype>
            <?php endif; ?>

            <?php if (@$positionIndustry): ?>
                <category><![CDATA[<?= @$positionIndustry; ?>]]></category>
            <?php endif; ?>

            <?php if (@$positionDeadline): ?>
                <expirationdate><![CDATA[<?= date('D, j M Y', strtotime($positionDeadline)); ?>]]></expirationdate>
            <?php endif; ?>

            <indeed-apply-data><![CDATA[indeed-apply-jobTitle=<?= urlencode(@$positionTitle) ?>&indeed-apply-jobId=<?= @$post_id ?>&indeed-apply-jobCompanyName=<?= urlencode(@$firmaName) ?>&indeed-apply-jobLocation=<?= urlencode(@$positionCity) ?>&indeed-apply-jobUrl=<?= urlencode(@$positionURL); ?>&indeed-apply-email=<?= encrypt_position_email(@$positionConfirmationEmail ?? 'contact@jetztjob.de', $apiSecret); ?>]]></indeed-apply-data>
        </job>
    <?php
    endwhile;
endif; ?>
</source>
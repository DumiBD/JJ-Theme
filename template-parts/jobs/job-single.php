<?php 
/*
	Small job preview template


	VSRIABLES:
	
	$post_id
	$btn_name
	$position_title
	$job_location
	$employment_type
	$permalink
	$preview_location
	$preview_employment_type
	$custom_message
*/

$post_id = $args['post_id'];
$custom_message = $args['custom_message'];

$hiring_organization = $args['hiring_organization'];
$hiring_organization_logo = $args['hiring_organization_logo'];

$firmalink = $args['firmalink'];

$btn_name = $args['btn_name'];
$permalink = $args['permalink'];
$target = $args['target'];

$position_title = $args['position_title'];

$info = '';

if( $args['job_location'] && $args['preview_location'] != 'on' ) {
	$info .= apply_filters( 'jobs/preview_details_jobLocation', '<span class="job-preview-location">'. $args['job_location'] . '</span>');
}

if( $args['employment_type'] && $args['preview_employment_type'] != 'on'  ) {
	$coma = '';
	if( $info != '' ) {
        $coma = '<span class="job-preview-details-separator"><span>';
    }

	$coma = apply_filters( 'jobs/preview_details_separator', $coma );

	$info .= $coma; 
	$info .= apply_filters( 'jobs/preview_details_employmentType', '<span>-</span> <span>' . $args['employment_type'] . '</span>');
}

$info = apply_filters( 'jobs/preview_details', $info, $post_id );

$custom_message = apply_filters( 'jobs/preview_custom_message', $custom_message, $post_id );

$custom_message_el = '';
if ($custom_message) {
	$custom_message_el = '<div class="job_custom_message">'.$custom_message.'</div>';
}

// Updated Code by Sigma
$view_button = '<a href="/firma/' . $firmalink . '" class="firma-logo">
<img class="sc_list_hiring_logo" src="'. $hiring_organization_logo .'" alt="'.$hiring_organization.'" title="'.$hiring_organization.'">
</a>';
$view_button = apply_filters('job-postings/view_button', $view_button, $btn_name, $permalink, $target, $post_id);
//$cta_button = '<a href="'.$permalink.'" target="'.$target.'" class="apply-btn local">'.$btn_name.'</a>';

$viewType = $_SESSION['grid-view'];

$templateArgs = [
    'btn_name' => $btn_name,
    'permalink' => $permalink,
    'target' => '',
    'position_title' => $position_title,

    'info' => $info,
    'custom_message_el' => $custom_message_el,

    'firmalink' => $firmalink,
    'hiring_organization_logo' => $hiring_organization_logo,
    'hiring_organization' => '',

    'view_button' => $view_button,
    'cta_button' => $cta_button,
];

switch ($viewType) {
    case 'grid':
        get_template_part('template-parts/jobs/item/grid', null, $templateArgs);
        break;
    case 'list':
        get_template_part('template-parts/jobs/item/list', null, $templateArgs);
        break;
    case 'expanded':
        get_template_part('template-parts/jobs/item/expanded', null, $templateArgs);
        break;
    default:
        get_template_part('template-parts/jobs/item/grid', null, $templateArgs);
}



// Updated Code by Sigma

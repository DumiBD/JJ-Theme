<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

add_action('init', 'register_wp_session');
function register_wp_session() {
    if (!session_id()) {
        session_start();

        if (!$_SESSION['grid-view']) {
            $_SESSION['grid-view'] = 'grid';
        }
    }
}

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:
function jetztjob_scripts() {
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_theme_file_uri() . '/js/jquery-3.6.0.min.js');
    wp_enqueue_script('jquery');

    // Register loadmore pagination
    wp_register_script('jfwp_load_more', get_stylesheet_directory_uri() . '/js/loadmore.js', array('jquery'));

    wp_enqueue_script('jetztjob-custom-select', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array(), true);
    wp_enqueue_script('jetztjob-custom', get_theme_file_uri() . '/js/custom.js', array(), true);
}

add_action('wp_enqueue_scripts', 'jetztjob_scripts');

if (!function_exists('chld_thm_cfg_locale_css')):
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')):
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('astra-theme-css'));
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 10);


wp_enqueue_style('select2', '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');
wp_enqueue_style('fontawesome', 'https://jetztjob.de/wp-content/plugins/elementor/assets/lib/font-awesome/css/solid.min.css');

// END ENQUEUE PARENT ACTION


//  Functions for extracting value from array in job-postings meta (for csv export)
function job_value_for_export($value) {
    $dataArray = unserialize($value);
    if (isset($dataArray['value'])) {
        return $dataArray['value'];
    } else {
        return $value;
    }
}
function job_attachment_value_for_export($value) {
    $firstDeserialize = unserialize($value);
    if (isset($firstDeserialize)) {
        $valueArray = unserialize($firstDeserialize);
        if (isset($valueArray['value'])) {
            return $valueArray['value'];
        }
    }
    return $value;
}



// Update  tablet breakpoint
add_filter( 'astra_tablet_breakpoint', function() {
    return 1200;
});


// register the shortcode to wrap html around the content 
function jetztjob_responsive_video_shortcode( $atts ) {
	extract( shortcode_atts( array (
		'id' => ''
	), $atts ) );
	return '<div><div class="jetztjob-video-container"><iframe src="//www.youtube.com/embed/' . $id . '" height="315" width="560" allowfullscreen="" frameborder="0"></iframe></div></div>';
}
add_shortcode ('jetztjob-video', 'jetztjob_responsive_video_shortcode' );


//wp-admin custom logo	
function my_login_logo()
{
    ?>
    <style>
        .login h1 a {
            background-image: none, url(/wp-content/uploads/2025/03/JetztJob-color.svg) !important;
            width: auto !important;
            -webkit-background-size: 300px !important;
            background-size: 300px !important;
            height: 75px !important;
        }
    </style><?php
}

add_action('login_enqueue_scripts', 'my_login_logo');

add_filter('login_headerurl', 'custom_loginlogo_url');
function custom_loginlogo_url($url)
{
    return home_url();
}





add_filter('login_headertitle', 'xs_login_headertitle');
function xs_login_headertitle($title)
{
    return get_bloginfo('name') . ' â€“ ' . get_bloginfo('description');
}

// Create a shortcode for the current year
function year_shortcode()
{
    $year = date('Y');
    return $year;
}

add_shortcode('year', 'year_shortcode');


add_action('wp_head', 'sc_custom_head_codes');
function sc_custom_head_codes()
{
    ?>
    <meta name="google-site-verification" content="ZAfBwTaovobuFN59N2B3RWmbrJtPli8zMxul19iDmMk"/>
    <!-- SalesViewerÂ® -->
    <script>!(function (s, a, l, e, sv, i, ew, er) {
            try {
                (a = s[a] || s[l] || function () {
                    throw "no_xhr";
                }), (sv = i = "//salesviewer.org"), (ew = function (x) {
                    (s = new Image()), (s.src = "//salesviewer.org/tle.gif?sva=n5e7P7d5M7X1&u=" + window.location + "&e=" + encodeURIComponent(x))
                }), (l = s.SV_XHR = function (d) {
                    return ((er = new a()), (er.onerror = function () {
                        if (sv != i) return ew("load_err");
                        (sv = "//www.salesviewer.com/t"), setTimeout(l.bind(null, d), 0);
                    }), (er.onload = function () {
                        (s.execScript || s.eval).call(er, er.responseText);
                    }), er.open("POST", sv, !0), (er.withCredentials = true), er.send(d), er);
                }), l("h_json=" + 1 * ("JSON" in s && void 0 !== JSON.parse) + "&h_wc=1&h_event=" + 1 * ("addEventListener" in s) + "&sva=" + e);
            } catch (x) {
                ew(x)
            }
        })(window, "XDomainRequest", "XMLHttpRequest", "n5e7P7d5M7X1");</script>
    <noscript><img src="//salesviewer.org/n5e7P7d5M7X1.gif" style="visibility:hidden;"/></noscript>
    <!-- End SalesViewerÂ® -->
    <?php
}

;


// Disable Default Wordpress styles
add_action('wp_enqueue_scripts', function (): void {
    // Dequeue the styles added by theme.json file
    wp_dequeue_style('global-styles');
});


// Translate "page" slug in pagination
/*function my_custom_page_word() {
	global $wp_rewrite;
	$wp_rewrite->pagination_base = 'jobseite';
	unset($wp_rewrite->extra_rules_top["page/([0-9]{1,})/?$"]);
//	$_SERVER['REQUEST_URI']
	$wp_rewrite->extra_rules_top['jobseite/([0-9]{1,})/?$'] = '/?post_type=jobs&paged='.$matches[1]."-".$_SERVER['REQUEST_URI'];
}
add_action( 'init', 'my_custom_page_word' );*/


/**
 * Added By SC
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_taxonomy');
function tsm_filter_post_type_by_taxonomy()
{
    global $typenow;
    $post_type = 'jobs'; // change to your post type
    $taxonomy = 'firma'; // change to your taxonomy
    if ($typenow == $post_type) {
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf(__('Show all %s', 'textdomain'), $info_taxonomy->label),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => true,
            'hide_empty' => true,
        ));
    };
}

/**
 * Added By SC
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query)
{
    global $pagenow;
    $post_type = 'jobs'; // change to your post type
    $taxonomy = 'firma'; // change to your taxonomy
    $q_vars = &$query->query_vars;
    if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
        $term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
        $q_vars[$taxonomy] = $term->slug;
    }
}


/**
 *
 * Added By SC
 * Change Pagination Slug from *page* to *seite*. Also htaccess redirect added
 *
 */

if (!function_exists('t5_page_to_seite')) {
    register_activation_hook(__FILE__, 't5_flush_rewrite_on_init');
    register_deactivation_hook(__FILE__, 't5_flush_rewrite_on_init');
    add_action('init', 't5_page_to_seite');

    function t5_page_to_seite()
    {
        $GLOBALS['wp_rewrite']->pagination_base = 'seite';
    }

    function t5_flush_rewrite_on_init()
    {
        add_action('init', 'flush_rewrite_rules', 11);
    }
}

add_filter('wp_get_nav_menu_items', 'exclude_menu_items_handler', null, 3);
function exclude_menu_items_handler($items, $menu, $args) {
    global $wp;

    $currentPageURL = add_query_arg($wp->query_vars, home_url($wp->request));
    $currentPagePathStr = wp_parse_url($currentPageURL, PHP_URL_PATH);
    $currentPagePathArr = preg_split('@/@', $currentPagePathStr, -1, PREG_SPLIT_NO_EMPTY);

    $taxonomy = 'firma';

    $excludeMenuItemID = 17139;

    foreach ($items as $key => $item) {
        if (array_key_exists($taxonomy, array_flip($currentPagePathArr))) {
            if ($item->object_id == $excludeMenuItemID) {
                unset($items[$key]);
            }
        }
    }

    return $items;
}

// TODO: Wrap all function when Jobs for WordPress is enabled
if (is_plugin_active('job-postings/job-postings.php')) {
    // var_dump(wp_get_active_and_valid_plugins());
    /**
     * Init Job Feed
     */
    add_action('init', function () {
        add_feed('jobs_feed', 'custom_jobs_feed');
    });

    /**
     * Add custom rss feed tempalte rss-jobs.php for RSS: jobs_feed
     */
    function custom_jobs_feed()
    {
        get_template_part('rss', 'jobs');
    }

    /**
     * Search by city name. Listing for cities page
     */
    add_shortcode('jfwp-search-by-city', 'jfwp_search_by_city');
    function jfwp_search_by_city()
    {
        ob_start();

        // Get all jobs posts ids as an array
        $all_posts = get_posts(array(
                'post_type' => 'jobs',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'fields' => 'ids'
            )
        );

        // get an array with all unique "city" post meta
        foreach ($all_posts as $post) {
            $all_position_locations[] = trim(get_post_meta($post, "position_job_location", true));
        }
        $unique_position_locations = array_unique($all_position_locations);
        asort($unique_position_locations);

        ?>
        <div class="jfwp-cities__container">
            <?php
            foreach ($unique_position_locations as $location) {
                if (!$location) {
                    continue;
                }

//            $location = trim($location);

                $link = esc_url(add_query_arg([
                        'job-location' => $location,
                    ], get_home_url()) . '#job-listing');
                ?>
                <div class="jfwp-cities__item">
                    <a href="<?= $link; ?>"><?= trim($location); ?></a>
                </div>
            <?php } ?>
        </div>

        <?php
        $output = ob_get_clean();

        return $output;
    }

    /**
     * Search by city name. Listing for cities page
     */
    add_shortcode('jfwp-search-default', 'jfwp_search_default');
    function jfwp_search_default()
    {
        ob_start();
        ?>
        <form method="GET" class="job_filters-form search-form search-form-default"
              action="<?= home_url('/'); ?>#job-listing">

            <div class="job-search-wrap">
                <input id="job-search" class="job-search" type="text"
                       placeholder="<?php esc_attr_e('Hier suchen…', 'jetztjob2'); ?>"
                       name="job-location">
            </div>
            <input type="hidden" name="list" value="t">

            <button class="search-form-submit" type="submit"><?php esc_attr_e('Suchen', 'jetztjob2'); ?></button>
        </form>

        <?php
        $output = ob_get_clean();

        return $output;
    }

    /**
     * Main search form for Home
     */
    add_shortcode('jfwp-main-search', 'jfwp_main_search');
    function jfwp_main_search()
    {

        ob_start();

        $all_posts = get_posts(array(
                'post_type' => 'jobs',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'fields' => 'ids'
            )
        );

        foreach ($all_posts as $post) {
            $location = trim(get_post_meta($post, "position_job_location", true));
            $location = str_replace([',', '.', '!', 'Deutschland', 'DE'], '', $location);
            $location = trim($location);

            if ($location) {
                $all_position_locations[] = $location;
            }
        }
        $unique_position_locations = array_unique($all_position_locations);
        asort($unique_position_locations);

        $searchType = $_GET['list'] ? strip_tags($_GET['list']) : '';
        $searchTerm = $_GET['job-search'] ? strip_tags($_GET['job-search']) : '';
        ?>
        <style>

        </style>
        <form class="search-form" method="get" action="<?= home_url('/'); ?>#job-listing">
            <div class="search-by-city">
                <select id="job-location" name="job-location" class="select2-single select2-city"
                        data-placeholder="Stadt auswählen">
                    <option></option>
                    <?php
                    $currLocation = $_GET['job-location'] ? strip_tags($_GET['job-location']) : '';

                    foreach ($unique_position_locations as $location) {

                        ?>
                        <option value="<?php echo $location ?>" <?= $currLocation == $location ? 'selected="selected"' : '' ?>>
                            <?php echo $location ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="search-by-type">
                <select id="search-type" name="list" class="select2-single no-search jfwp-search-type"
                        data-class="jfwp-search-type">
                    <?php

                    $jobTypes = [
                        't' => 'Job Titel',
                        'f' => 'Arbeitgeber'
                    ];

                    foreach ($jobTypes as $typeVal => $typeName) { ?>
                        <option value="<?php echo $typeVal ?>" <?= $searchType === $typeVal ? 'selected="selected"' : '' ?>>
                            <?php echo $typeName ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="search-by-name">
                <div class="search-input-wrap">
                    <i class="jfwp-search-icon"></i>
                    <input id="job-search"
                           class="job-search"
                           type="text"
                           placeholder="<?php esc_attr_e('Hier suchen…', 'jetztjob2'); ?>"
                           value="<?= $searchTerm ?>"
                           name="job-search">
                </div>
            </div>
            <button class="search-form-submit"
                    type="submit"><?php esc_attr_e('Suchen', 'jetztjob2'); ?></button>
        </form>

        <?php
        $output = ob_get_clean();

        return $output;
    }

    if (class_exists('JobList')) {
        add_shortcode('jfwp-job-listing', 'jfwp_job_listing');
        function jfwp_job_listing($atts = array(), $content = '') {
            extract(
                shortcode_atts(
                    array(
                        'firma' => '',
                        'category' => '',
                        'showcategory' => 'false',
                        'aligncategory' => 'left',
                        'hide_empty' => 'true',
                        'show_count' => 'false',
                        'show_filters' => 'false',
                        'limit' => '',
                        'posts_per_page' => apply_filters('jobs/per_page', get_option('jobs_posts_per_page')) ?? 6,
                        'hide_past' => false,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'target' => '_self',
                    ),
                    $atts
                )
            );

            // if firma ID not set in shortcode, get firma id and retrieve positions by received ID
            if (!$firma && is_tax('firma')) {
                $term = get_queried_object();
                $firma = $term->term_id;
            }

            ob_start();

            wp_enqueue_style('jp-front-styles');
            Job_Postings::customStyles();


            $hide_empty = ($hide_empty == 'true') ? true : false;

            if ($limit == '' && $showcategory == 'true' && $show_filters == 'false') {
                // echo JobCategory::do_job_categories($aligncategory, $category, $firma, $hide_empty, $show_count);
            }

            if ($limit == '' && $show_filters == 'true') {
                $filter_class = get_option('jobs_filters_styles');
                $filter_class = $filter_class ? $filter_class : 'filter-style-1';
                echo '<div class="job-postings-filters clearfix ' . $filter_class . '">';
                // echo JobCategory::do_job_categories($aligncategory, $category, $firma, $hide_empty, $show_count);

                echo JobSearch::render_search();
                echo '</div>';
            }

            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            if ($paged == 1) {
                $paged = get_query_var('page') ? get_query_var('page') : 1;
            }

            $args = array(
                'post_type' => 'jobs',
                'orderby' => $orderby,
                'order' => $order,
                'posts_per_page' => $posts_per_page
            );

            if (strpos($orderby, 'position_') !== false) {
                $args['orderby'] = 'meta_value';
                $args['meta_key'] = $orderby;
            }

            if ($limit && $limit != '') {
                $args['posts_per_page'] = $limit;
                //$args['nopaging'] = true;
            }



            // Additional code by Sigma
            if ($firma) {
                $firma = Job_Postings_Helper::numbers_separator_only($firma);
                $firma = explode(',', $firma);

                $args['tax_query'][] = array(
                    'taxonomy' => 'firma',
                    'field' => 'term_id',
                    'terms' => $firma
                );
            }

            if ($category) {
                $category = Job_Postings_Helper::numbers_separator_only($category);
                $category = explode(',', $category);

                $args['tax_query'][] = array(
                    'taxonomy' => 'jobs_category',
                    'field' => 'term_id',
                    'terms' => $category
                );
            }

            if ((isset($_GET['job-category']) && $_GET['job-category'] != '' && $_GET['job-category'] != 'all')) {
                $jobCat = $_GET['job-category'];
                $args['tax_query'][] = array(
                    'taxonomy' => 'jobs_category',
                    'field' => 'slug',
                    'terms' => $jobCat
                );
            }

            $meta_query = [];

            // Code By Sigma - Add search by Job Location
            if (!$category && isGetParamExists('job-location')) {
                global $wpdb;

                $jobLoc = retrieveCleanValueFromGet('job-location');
                $jobLoc = $wpdb->esc_like($jobLoc) . '%'; // Thanks Manny Fleurmond

                // Search in all custom fields
                $post_ids_loc = $wpdb->get_col($wpdb->prepare("
                    SELECT DISTINCT post_id FROM {$wpdb->postmeta}
                    WHERE meta_key = 'position_job_location' 
                    AND meta_value LIKE '%s'", $jobLoc));
                $post_ids = $post_ids_loc;

//                 $post_ids_loc = $wpdb->get_col($wpdb->prepare("
//                     SELECT DISTINCT post_id FROM {$wpdb->postmeta}
//                     WHERE meta_value LIKE '%s'", $jobLoc));
//                 $post_ids = $post_ids_loc;

                $args['post__in'] = $post_ids;
            }

            if (!$category
                && isGetParamExists('job-search')
                && isGetParamExistsWithMatch('list', 't')) {

//            $search = retrieveCleanValueFromGet('job-search');
                global $wpdb;

                $keyword = retrieveCleanValueFromGet('job-search');
                $keyword = '%' . $wpdb->esc_like($keyword) . '%'; // Thanks Manny Fleurmond

                // Search in all custom fields
                /* $post_ids_meta = $wpdb->get_col( $wpdb->prepare( "
                     SELECT DISTINCT post_id FROM {$wpdb->postmeta}
                     WHERE meta_value LIKE '%s'
                 ", $keyword ) );*/
                $post_ids_meta = array();
                // Search in post_title and post_content
                /* $post_ids_post = $wpdb->get_col( $wpdb->prepare( "
                     SELECT DISTINCT ID FROM {$wpdb->posts}
                     WHERE post_type = 'jobs'
                     AND post_title LIKE '%s'
                     OR post_content LIKE '%s'
                 ", $keyword, $keyword ) );*/
                $post_ids_post = $wpdb->get_col($wpdb->prepare("
                    SELECT DISTINCT post_id as ID FROM {$wpdb->postmeta}
                    WHERE meta_key = 'position_custom_text_1'
                    AND meta_value LIKE '%s'
                ", $keyword));

                //print_r($post_ids_post);
                // 'position_title' - meta key for postition title

                $post_ids = array_merge($post_ids_meta, $post_ids_post);

                $args['post__in'] = $post_ids;

            } elseif (!$category
                && isGetParamExists('job-search')
                && isGetParamExistsWithMatch('list', 'f')) {

//            $search = retrieveCleanValueFromGet('job-search');
                global $wpdb;

                $keyword = retrieveCleanValueFromGet('job-search');
                $keyword = '%' . $wpdb->esc_like($keyword) . '%'; // Thanks Manny Fleurmond

                // Search in all custom fields
                /* $post_ids_meta = $wpdb->get_col( $wpdb->prepare( "
                     SELECT DISTINCT post_id FROM {$wpdb->postmeta}
                     WHERE meta_value LIKE '%s'
                 ", $keyword ) );*/
                $post_ids_meta = array();
                // Search in post_title and post_content
                /* $post_ids_post = $wpdb->get_col( $wpdb->prepare( "
                     SELECT DISTINCT ID FROM {$wpdb->posts}
                     WHERE post_type = 'jobs'
                     AND post_title LIKE '%s'
                     OR post_content LIKE '%s'
                 ", $keyword, $keyword ) );*/
                $post_ids_post = $wpdb->get_col($wpdb->prepare("
                    SELECT DISTINCT post_id as ID FROM {$wpdb->postmeta}
                    WHERE meta_key = 'position_hiring_organization_name'
                    AND meta_value LIKE '%s'
                ", $keyword));

                //print_r($post_ids_post);
                // 'position_title' - meta key for postition title

                $post_ids = array_merge($post_ids_meta, $post_ids_post);

                $args['post__in'] = $post_ids;

                if (isGetParamExists('job-location')) {
                    $jobLoc = retrieveCleanValueFromGet('job-location');

                    $meta_query[] = [
                        'key' => 'position_job_location',
                        'value' => trim($jobLoc),
                        'compare' => 'LIKE',
                    ];
                }
            }

            if ($hide_past == true) {
//                $args['meta_query'] = array(
                $meta_query[] = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'position_valid_through_date',
                        'value' => date('Y-m-d'),
                        'compare' => '>=',
                        'type' => 'DATE'
                    ),
                    // Show job posts that dont have date set
                    array(
                        'key' => 'position_valid_through',
                        'value' => '',
                        'compare' => '=',
                    )
                );
            }


            if (current_user_can('manage_options')) {
                /*print_r('<pre>');
                print_r( $args );
                print_r('</pre>');*/
            }


            $args = apply_filters('jobs/listing_query', $args);
//        $args['posts_per_page'] = 10; // disabled to use config option
            $args['paged'] = $paged;
            $args['meta_query'] = $meta_query;

            $jobs = new WP_Query($args);

            $jobsCount = $jobs->found_posts;

            // Declare LoadMore
            wp_localize_script('jfwp_load_more', 'jobs_loadmore_params', array(
                'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
                'jobs' => json_encode($jobs->query_vars), // everything about your loop is here
                'job_location' => isGetParamExists('job-location') ? retrieveCleanValueFromGet('job-location') : '',
                'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
                'max_page' => $jobs->max_num_pages
            ));
            wp_enqueue_script('jfwp_load_more');


            if (!$category && isGetParamExists('job-search') && count($post_ids) == 0) {

                get_template_part('template-parts/jobs/list', 'not-found', ['class' => $class]);
            } else {

                // we use foundation and bootstraps column class by default
                $class = apply_filters('jobs-listing/grid_class', 'column medium-12 col-md-12');
                $class = sanitize_text_field($class);

                if ($jobs->have_posts()) {

//                get_template_part('template-parts/jobs/list', 'header-info', [
//                    'class' => $class,
//                    'searchTerm' => isGetParamExists('job-search')
//                        ? retrieveCleanValueFromGet('job-search') . ': '
//                        : '',
//                    'jobsCount' => $jobsCount
//                ]);

                    jobsListViewActions();

                    $searchTerm = isGetParamExists('job-search') ? retrieveCleanValueFromGet('job-search') . ': ' : '';
                    $gridViewType = ' view-' . $_SESSION['grid-view'];

                    echo '<div class="job-listing row clearfix jobs-regular-list" data-jobs-info="' . $searchTerm . $jobsCount . ($jobsCount > 1 ? " Jobs " : " Job ") . 'gefunden">';

                    echo '<div class="job-listing-row ' . $class . $gridViewType . '" data-sdf="' . $jobsCount . '">';

                    while ($jobs->have_posts()) {
                        $jobs->the_post();

                        $post_id = $jobs->post->ID;

                        echo job_preview($post_id, $target);
                    }

                    echo '</div>';
                    echo '</div>';

                    if ($limit == '' && (int)$jobs->max_num_pages > 1) {
                        // echo JobList::jobs_corenavi($jobs); // Default pagination

                        get_template_part('template-parts/jobs/loadmore'); // ajax pagination
                    }


                    /* Restore original Post Data */
                    wp_reset_postdata();
                } else {

                    get_template_part('template-parts/jobs/list', 'not-found', ['class' => $class]);
                }
            }

            return ob_get_clean();
        }

        function job_preview($post_id, $target)
        {
            ob_start();

            $btn_name = get_option('jobs_preview_cta' . '_' . Job_Postings::getLang());
            if (!$btn_name) {
                $btn_name = _x('View', 'job-postings', 'job-postings');
            }

            $position_title = get_post_meta($post_id, 'position_title', true);
            $job_location = get_post_meta($post_id, 'position_job_location', true);
            $employment_type = get_post_meta($post_id, 'position_employment_type', true);
            $permalink = get_permalink($post_id);

            // Additional code by Sigma
            $terms = get_the_terms($post_id, 'firma');
            $term = array_shift($terms);
            $firmalink = $term->slug;
            $hiring_organization_logo = get_post_meta($post_id, 'position_logo', true);

            $custom_message = get_post_meta($post_id, 'job_custom_message', true);

            $preview_location = get_option('jobs_preview_location');
            $preview_employment_type = get_option('jobs_preview_employment_type');

            $fields = Job_Postings::$fields;
            $list = array();
            if (is_array($employment_type) && !empty($fields) && isset($fields['position_employment_type']['options'])) {
                $options = $fields['position_employment_type']['options'];
                foreach ($employment_type as $vk => $value_key) {
                    if (isset($options[$value_key]) && $value_key != 'OTHER') {
                        $list[] = $options[$value_key];
                    }
                }
                if (isset($employment_type['other_input'])) {
                    $list[] = $employment_type['other_input'];
                }
            } else if (!is_array($employment_type) && $employment_type != '') {
                $list[] = $employment_type;
            }

            $employment_type = apply_filters('job-postings/format_list', implode(', ', $list), $list);


            get_template_part('template-parts/jobs/job', 'single', [
                'post_id' => $post_id,
                'custom_message' => $custom_message,
                'job_location' => $job_location,
                'preview_location' => $preview_location,
                'employment_type' => $employment_type,
                'preview_employment_type' => $preview_employment_type,
                'firmalink' => $firmalink,
                'btn_name' => $btn_name,
                'target' => '',
                'permalink' => $permalink,
                'position_title' => $position_title,
                'hiring_organization_logo' => $hiring_organization_logo,
                'hiring_organization' => '',
            ]);

            return ob_get_clean();
        }

        function jobsListViewActions($anchor = 'job-listing')
        {
			// featured-list
			// job-listing
			
            global $wp;

            // Init default grid view on session start
            if (!$_SESSION['grid-view']) {
                $_SESSION['grid-view'] = 'grid';
            }

            $currentPageWithQuery = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request));

            $gridTypeFromQuery = retrieveCleanValueFromGet('grid-view');
            if (isGetParamExists('grid-view') && $_SESSION['grid-view'] !== $gridTypeFromQuery) {
                $_SESSION['grid-view'] = $gridTypeFromQuery;
            }

            get_template_part('template-parts/jobs/list', 'view-actions', [
                'urlWithQuery' => $currentPageWithQuery,
				'anchor' => $anchor
            ]);
        }

        add_action('wp_ajax_jobs_loadmore', 'jobs_loadmore_ajax_handler');
        add_action('wp_ajax_nopriv_jobs_loadmore', 'jobs_loadmore_ajax_handler');
        function jobs_loadmore_ajax_handler()
        {

            // prepare our arguments for the query
            $args = json_decode(stripslashes($_POST['query']), true);
            $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
            $args['post_status'] = 'publish';

            $jobs = new WP_Query($args);

            if ($jobs->have_posts()) {
                while ($jobs->have_posts()) {
                    $jobs->the_post();

                    $post_id = $jobs->post->ID;

                    echo job_preview($post_id, '');
                }
            }
            die; // here we exit the script and even no wp_reset_query() required!
        }

        function isGetParamExists(string $paramName): bool
        {
            return array_key_exists($paramName, $_GET) && trim(strip_tags($_GET[$paramName])) !== '';
        }

        function isGetParamExistsWithMatch(string $paramName, string $matchedTo = ''): bool
        {
            return array_key_exists($paramName, $_GET) && trim(strip_tags($_GET[$paramName])) === $matchedTo;
        }

        function retrieveCleanValueFromGet(string $paramName): string
        {
            return trim(strip_tags($_GET[$paramName])) ?? '';
        }


        add_action('wp_loaded', 'jfwp_overwrite_shortcodes');
        function jfwp_overwrite_shortcodes()
        {
            remove_shortcode('job-postings');
            add_shortcode('job-postings', 'jfwp_job_listing');
        }

        // Page with example: https://staging.jetztjob.de/job/baeckerei-isken-stellenangebote/isken-ausbildung-beacker/
        // JETZT BEWERBEN button
        add_shortcode('jetzt-bewerben', 'jfwp_custom_apply_button');
        function jfwp_custom_apply_button($atts)
        {
            ob_start();
            if ($postID = get_the_ID()) {
                $applyNowCustom = get_post_meta($postID, 'position_apply_now', true);
                $apply = $applyNowCustom ?? _x('Apply now', 'apply-now', 'job-postings');
                echo '<button class="button jp-apply-button">' . $apply . '</button>';
            }
            return ob_get_clean();
        }

        // featured firma
        add_shortcode('jfwp-featured-companies', 'jfwp_get_featured_companies');
        function jfwp_get_featured_companies()
        {

            // determine if is not front page and haven't job-location query param
            if (!is_front_page() && !isGetParamExists('job-location')) {
                return;
            }

            ob_start();

            $metaQueries = [];

            // if is home without location query
            if (is_front_page() && !isGetParamExists('job-location')) {
                $metaQueries[] = [
                    'key' => 'is_featured_on_home',
                    'value' => true,
                    'compare' => '='
                ];
            }

            // if is home and location is set
            if (is_front_page() && isGetParamExists('job-location')) {
                $metaQueries[] = [
                    'relation' => 'AND',
                    [
                        'key' => 'is_featured_on_search_by_city',
                        'value' => true,
                        'compare' => '='
                    ],
                    [
                        'key' => 'firma_city',
                        'value' => retrieveCleanValueFromGet('job-location') ?? '',
                        'compare' => 'LIKE'
                    ]
                ];
            }

            $args = [
                'taxonomy' => 'firma',
                'hide_empty' => false,
                'update_term_meta_cache' => true,
                'meta_query' => $metaQueries
            ];

            $termQuery = new WP_Term_Query($args);
            $terms = wp_list_filter($termQuery->terms, ['parent' => 0]);

            $gridViewType = get_grid_view_from_query();

            get_template_part('template-parts/firma/home-featured', null, [
                'terms' => $terms,
                'termsCount' => count($terms),
                'gridViewType' => $gridViewType
            ]);

            return ob_get_clean();
        }

        function get_grid_view_from_query()
        {
            $gridTypeFromQuery = retrieveCleanValueFromGet('grid-view');
            if (isGetParamExists('grid-view') && $_SESSION['grid-view'] !== $gridTypeFromQuery) {
                $_SESSION['grid-view'] = $gridTypeFromQuery;
            }


            if (!$gridTypeFromQuery) {
                return $_SESSION['grid-view'];
            }

            return $gridTypeFromQuery;
        }

        function jfwp_is_featured_companies_empty()
        {
            $metaQueries = [];

            // if is home without location query
            if (is_front_page() && !isGetParamExists('job-location')) {
                $metaQueries[] = [
                    'key' => 'is_featured_on_home',
                    'value' => true,
                    'compare' => '='
                ];
            }

            // if is home without location query
            if (is_front_page() && isGetParamExists('job-location')) {
                $metaQueries[] = [
                    'relation' => 'AND',
                    [
                        'key' => 'is_featured_on_search_by_city',
                        'value' => true,
                        'compare' => '='
                    ],
                    [
                        'key' => 'firma_city',
                        'value' => retrieveCleanValueFromGet('job-location') ?? '',
                        'compare' => 'LIKE'
                    ]
                ];
            }

            //TODO: query for searching by city
            // query will be here

            $args = [
                'taxonomy' => 'firma',
                'hide_empty' => false,
                'update_term_meta_cache' => true,
                'meta_query' => $metaQueries
            ];

            return !wp_count_terms($args);
        }

        // Add custom body to quicker secrion hiding
        add_filter('body_class', 'jfwp_custom_body_class');
        function jfwp_custom_body_class(array $classes)
        {
            $new_class = jfwp_is_featured_companies_empty() ? 'featured-companies-empty' : null;

            if ($new_class) {
                $classes[] = $new_class;
            }

            return $classes;
        }

        // Function to add city and logo to each term if term have at least one job.
        // Should be run only once
        if (!is_admin()) {
//        add_action('init', 'jfwp_add_logo_and_city_to_term');
        }
        function jfwp_add_logo_and_city_to_term()
        {
            $args = [
                'taxonomy' => 'firma',
                'hide_empty' => false,
                'update_term_meta_cache' => true,
            ];

            $term_query = new WP_Term_Query($args);
            $term_ids = wp_list_pluck($term_query->terms, 'term_id');
            $term_ids = array_slice($term_ids, 0, 5);

//        $ids = [];
            foreach ($term_ids as $term_id) {

                $args = [
                    'post_type' => 'jobs',
                    'posts_per_page' => 1
                ];

                $args['tax_query'][] = [
                    'taxonomy' => 'firma',
                    'field' => 'term_id',
                    'terms' => $term_id
                ];

                $args = apply_filters('jobs/listing_query', $args);
                $query = new WP_Query($args);


                if ($query->have_posts()) {
                    $job = $query->posts[0];
                    $jobID = $job->ID;

                    $jobCity = get_post_meta($jobID, 'position_job_location', true);

                    if ($jobCity !== '') {
                        update_term_meta($term_id, 'firma_city', $jobCity);
                    }

                    $jobEmploymentTypes = get_post_meta($jobID, 'position_employment_type');
                    $jobTypesStr = '';
                    if (count($jobEmploymentTypes)) {
                        $filteredJobTypes = array_filter($jobEmploymentTypes[0], function ($item) {
                            return $item !== 'OTHER';
                        });

                        $jobTypesValues = array_values($filteredJobTypes);
                        $jobTypes = array_map(function ($item) {
                            $item = str_replace('_', $item === 'PER_DIEM' ? ' ' : '-', $item);
                            $formatterTypeItem = ucwords(mb_strtolower($item));

                            // return translated strings
                            return __($formatterTypeItem, 'job-postings');
                        }, $jobTypesValues);

                        $jobTypesStr = implode(', ', $jobTypes);
                    }

                    if ($jobTypesStr !== '') {
                        update_term_meta($term_id, 'firma_job_types', $jobTypesStr);
                    }

                    $jobRegion = get_post_meta($jobID, 'position_job_location_addressRegion', true);
                    if ($jobRegion !== '') {
                        update_term_meta($term_id, 'firma_region', $jobRegion);
                    }

                    $postLogoURLRaw = get_post_meta($jobID, 'position_logo', true);
                    $jobLogoURL = preg_replace('/-\d+[Xx]\d+\./', '.', $postLogoURLRaw) ?? get_option('jobs_company_logo');
                    $image_id = attachment_url_to_postid($jobLogoURL);

                    if ($image_id > 0) {
                        update_term_meta($term_id, 'firma_logo', $image_id);
                    }
                }
            }

            var_dump('done');

            // 7. Firma cards with filter by city
            // 8. Create Firma featured cards
            // 9. Firma cards responsive
        }

        function add_position_apply_button_to_bottom() {
            echo '<div class="job-content-wrap jfwp-action-wrapper">';
            echo do_shortcode('[jetzt-bewerben]');
            echo '</div>';
        }
        add_action('job-postings/single/after_right', 'add_position_apply_button_to_bottom', 10);
    }
}

add_shortcode('jfwp-latest-blog-post', 'jfwp_latest_blog_post');
function jfwp_latest_blog_post()
{
    $posts = wp_get_recent_posts( [
        'numberposts'      => 1,
        'offset'           => 0,
        'category'         => 0,
        'orderby'          => 'post_date',
        'order'            => 'DESC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true,
    ], OBJECT );

    $latestPost = $posts[0];

    $attachment_id = get_post_thumbnail_id($latestPost->ID);
    //    var_dump($latestPost->post_сontent);
    ob_start();
    ?>
    <div class="latest-blogpost elementor-element elementor-element-37ef898 elementor-widget elementor-widget-image" data-id="37ef898"
         data-element_type="widget" data-widget_type="image.default">
        <div class="elementor-widget-container">
            <div class="elementor-image latest-blogpost--image">
                <?= wp_get_attachment_image($attachment_id, 'medium') ?>
            </div>
        </div>
        <div class="latest-blogpost--content">

            <div class="latest-blogpost--header">
                <div class="elementor-element elementor-element-06f4aa2 elementor-widget elementor-widget-heading"
                     data-id="06f4aa2" data-element_type="widget" data-widget_type="heading.default">
                    <div class="elementor-widget-container">
                        <a href="<?= get_permalink($latestPost->ID) ?>">
                            <h4 class="latest-blogpost--title elementor-heading-title elementor-size-default"><?= $latestPost->post_title ?></h4>
                        </a>
                    </div>
                </div>

                <?php if ($latestPost->post_excerpt !== ''): ?>
                    <div class="elementor-element elementor-element-df88faf itemScaleCardText elementor-widget elementor-widget-text-editor"
                         data-id="df88faf" data-element_type="widget" data-widget_type="text-editor.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-text-editor elementor-clearfix latest-blogpost--excerpt">
                                <p><?= $latestPost->post_excerpt?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="elementor-element elementor-element-d5e0f7e elementor-align-center itemScaleCardBtn elementor-widget elementor-widget-button"
                 data-id="d5e0f7e" data-element_type="widget" data-widget_type="button.default">
                <div class="elementor-widget-container">
                    <div class="elementor-button-wrapper">
                        <a href="<?= get_permalink($latestPost->ID) ?>"
                           class="latest-blogpost--link elementor-button-link elementor-button elementor-size-sm" role="button">
						<span class="elementor-button-content-wrapper">
						    <span class="elementor-button-text"><?= esc_attr_e('Weiterlesen', 'jetztjob2') ?></span>
		                </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

function get_custom_single_template($single_template) {
    global $post;

    var_dump($post->post_type);
    if ($post->post_type == 'firma') {
        $terms = get_the_terms($post->ID, 'firma');
        var_dump($terms);
//        if($terms && !is_wp_error( $terms )) {
//            //Make a foreach because $terms is an array but it supposed to be only one term
//            foreach($terms as $term){
//                $single_template = dirname( __FILE__ ) . '/single-'.$term->slug.'.php';
//            }
//        }
    }
    return $single_template;
}

//add_filter( "taxonomy_template", "get_custom_single_template" ) ;

// https://www.advancedcustomfields.com/resources/google-map/
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyB1QGepSCqyWiTuaPuyn1N1V3uO9Lk2stU';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');




// Force Browser Cache Clear (uncomment when needed)
function force_browser_cache_clear() {
    if (!is_admin()) {
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
    }
}
add_action('init', 'force_browser_cache_clear');
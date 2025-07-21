<?php
/*
Template Name: TEST layout
Template Post Type: post, page, event
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 



//  V2
//get your custom posts ids as an array
$all_posts = get_posts(array(
	'post_type'	 => 'jobs',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'fields' => 'ids'
    )
);
foreach ( $all_posts as $p ) {
	$all_position_locations[] = get_post_meta( $p, "position_job_location", true );
}
$unique_position_locations = array_unique( $all_position_locations );
asort($unique_position_locations);
?>

<select name="filter_location" class="position-location">
    <option hidden disabled selected value="">Stadt auswählen</option>	
	<?php foreach($unique_position_locations as $pl){ ?>
    <option value="<?php echo $pl ?>">
    <?php echo $pl ?>
    </option>
    <?php } ?>	
</select>
<?php




get_footer(); ?>	
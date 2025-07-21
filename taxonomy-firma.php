<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



// Default function - disabled
// get_header();

// Code From header.php - inserted to replace the standard header menu with a custom one based on ACF fields
?><!DOCTYPE html>
<?php astra_html_before(); ?>
<html <?php language_attributes(); ?>>
<head>
<?php astra_head_top(); ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">

<?php wp_head(); ?>
<?php astra_head_bottom(); ?>


<?
// CUSTOM - GET ACF FIELDS
// get the current taxonomy term
$term = get_queried_object();
// vars
$firma_unternehmenswebsite = get_field( 'firma_unternehmenswebsite', $term);
$linkedin_firma_link = get_field( "linkedin_firma_link", $term);
$facebook_firma_link = get_field( "facebook_firma_link", $term);
$instagram_firma_link = get_field( "instagram_firma_link", $term);
$tiktok_firma_link = get_field( "tiktok_firma_link", $term);
?>	
<link rel='stylesheet' id='elementor-icons-fa-brands-css'  href='/wp-content/plugins/elementor/assets/lib/font-awesome/css/brands.min.css' type='text/css' media='all' />
</head>

<body <?php astra_schema_body(); ?> <?php body_class(); ?> data="123">
<?php astra_body_top(); ?>
<?php wp_body_open(); ?>

<a
	class="skip-link screen-reader-text"
	href="#content"
	role="link"
	title="<?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?>">
		<?php echo esc_html( astra_default_strings( 'string-header-skip-link', false ) ); ?>
</a>

<div <?php
	echo astra_attr(
		'site',
		array(
			'id'    => 'page',
			'class' => 'hfeed site',
		)
	);
	?>>

<header id="masthead" class="firma-header" itemscope="itemscope" itemtype="https://schema.org/WPHeader">
<section class="elementor-section elementor-top-section elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-element_type="section">

<div class="elementor-container elementor-column-gap-default">
<div class="elementor-column elementor-col-25 elementor-top-column elementor-element  firma-logo" data-element_type="column">
		<?php do_action( 'astra_site_identity', $astra_active_device ); ?>
</div>

<div class="elementor-column elementor-col-75 elementor-top-column elementor-element firma-nav" data-element_type="column">

<div class="main-navigation ast-inline-flex">
	<?php do_action( 'astra_header_menu_1' ); ?>
</div>	
<?php if( $firma_unternehmenswebsite ) {?>
<div class="ast-builder-layout-element ast-flex site-header-focus-item ast-header-button-1" data-section="section-hb-button-1">
		<div class="ast-builder-button-wrap ast-builder-button-size-">
		<a class="ast-custom-button-link firma-action-link" href="<?php echo $firma_unternehmenswebsite; ?>" target="blank">
			<div class="ast-custom-button">Unternehmenswebsite</div>
		</a>
	</div>
</div>
<?php } ?>

<div class="ast-builder-layout-element ast-flex site-header-focus-item ast-header-button-1 firma-social" >
	<?php if( $linkedin_firma_link ) {?>
		<div class="elementor-icon"><a href="<?php echo $linkedin_firma_link; ?>" target="_blank"><i aria-hidden="true" class="fab fa-linkedin-in"></i></a></div>
	<?php } ?>
	<?php if( $facebook_firma_link ) {?>
		<div class="elementor-icon"><a href="<?php echo $facebook_firma_link; ?>" target="_blank"><i aria-hidden="true" class="fab fa-facebook-f"></i></a></div>
	<?php } ?>
	<?php if( $instagram_firma_link ) {?>
		<div class="elementor-icon"><a href="<?php echo $instagram_firma_link; ?>" target="_blank"><i aria-hidden="true" class="fab fa-instagram"></i></a></div>
	<?php } ?>
	<?php if( $tiktok_firma_link ) {?>
		<div class="elementor-icon"><a href="<?php echo $tiktok_firma_link; ?>" target="_blank"><i aria-hidden="true" class="fab fa-tiktok"></i></a></div>
	<?php } ?>
</div>


</div>
</div>	


</section>									
</header>
<?php
    $term_id = $term->term_id;
?>
<!-- 	if ($term_id > 238 || $term_id === 214) -->
<?php if ($term_id > 244 || have_rows("firma_content", $term)): ?>
<?php

    get_template_part( 'template-parts/firma/content/single', null, [
            'term' => $term
    ]);
    get_footer();

    return;
    ?>
<?php elseif ($a == $b): ?>
	
	
<?php else: ?>
    <?php the_content();?>
<?php endif; ?>











	<div id="content" class="site-content">
		<div class="ast-container">
		<?php astra_content_top(); ?>


<?
// END Custom header code
 ?>






<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>
		<?php astra_primary_content_top(); ?>

				<main id="main" class="site-main">
					<?php do_action( 'astra_before_archive_title' ); ?>
					<?php do_action( 'astra_after_archive_title' ); ?>
					<?php
					    $description = get_the_archive_description();
						if ( $description ) { echo $description; }			
					?>
					

					<?php do_action( 'astra_after_archive_description' ); ?>
				</main>
		<?php the_content(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>

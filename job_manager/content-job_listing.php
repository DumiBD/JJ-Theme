<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.34.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;
?>
<li <?php wpmj_job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_long ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_lat ); ?>">

        <div class="position-details">
            <a class="position-title-link" href="<?php the_job_permalink(); ?>">
                <h3><?php wpjm_the_job_title(); ?></h3>
            </a>

            <div class="location position-location">
                <svg class="position-location-icon" width="21" height="24" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.375 23.25V5.90625H5.01562V0.75H15.9844V11.0625H20.625V23.25H11.9906V18.0938H9.00937V23.25H0.375ZM2.0625 21.375H5.01562V18.0938H2.0625V21.375ZM2.0625 16.2188H5.01562V12.9375H2.0625V16.2188ZM2.0625 11.0625H5.01562V7.78125H2.0625V11.0625ZM6.70312 16.2188H9.65625V12.9375H6.70312V16.2188ZM6.70312 11.0625H9.65625V7.78125H6.70312V11.0625ZM6.70312 5.90625H9.65625V2.625H6.70312V5.90625ZM11.3438 16.2188H14.2969V12.9375H11.3438V16.2188ZM11.3438 11.0625H14.2969V7.78125H11.3438V11.0625ZM11.3438 5.90625H14.2969V2.625H11.3438V5.90625ZM15.9844 21.375H18.9375V18.0938H15.9844V21.375ZM15.9844 16.2188H18.9375V12.9375H15.9844V16.2188Z" fill="#D02130"/>
                </svg>

                <span class="position-location-text"><?php the_job_location( false ); ?></span>
            </div>

            <a class="position-btn" href="<?php the_job_permalink(); ?>"><?= esc_html_e('Jetzt bewerben', 'wp-job-manager'); ?></a>
        </div>

        <div class="position-logo">
            <?php the_company_logo(); ?>
        </div>
</li>

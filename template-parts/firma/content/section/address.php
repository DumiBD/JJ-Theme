<style>
    /*.jfwp-firma .firma-location--section {*/
    /*    background-color: #EDEDED;*/
    /*    padding: 40px 20px 60px 20px;*/
    /*}*/

    /*.jfwp-firma .firma-location--section .has_eae_slider > .elementor-column-wrap > .elementor-widget-wrap {*/
    /*    padding: 0;*/
    /*}*/

    /*.jfwp-firma .firma-location--section .firma-location--address .elementor-heading-title {*/
    /*    color: #000000;*/
    /*    font-size: 20px;*/
    /*    font-weight: 600;*/
    /*    font-family: "Montserrat", sans-serif;*/
    /*}*/
    
    /*.jfwp-firma .firma-location--section .firma-location--address .elementor-heading-title,*/
    /*.jfwp-firma .firma-location--section .firma-location--quote {*/
    /*    margin-bottom: 0;*/
    /*}*/

    /*.jfwp-firma .firma-location--section .firma-location--address {*/
    /*    width: initial;*/
    /*    margin: 0 auto;*/
    /*}*/

    /*.jfwp-firma .firma-location--section .firma-location--quote .elementor-heading-title {*/
    /*    margin-bottom: 38px;*/
    /*    color: #000000;*/
    /*    font-size: 36px;*/
    /*    font-weight: 700;*/
    /*    line-height: 44px;*/
    /*    text-align: center;*/
    /*    font-family: "Montserrat", sans-serif;*/
    /*}*/

    /*.jfwp-firma .firma-location--section .firma-location--map {*/
    /*    margin-top: 50px;*/
    /*}*/

</style>
<section
        class="firma-location--section has_eae_slider elementor-section elementor-top-section elementor-element elementor-element-17d03772 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
        data-id="17d03772" data-element_type="section"
        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="has_eae_slider elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-7d197f20"
                 data-id="7d197f20" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <section
                                class="has_eae_slider elementor-section elementor-inner-section elementor-element elementor-element-68dda73 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                data-id="68dda73" data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                    <div class="has_eae_slider elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-6ac3d6ea"
                                         data-id="6ac3d6ea" data-element_type="column">
                                        <div class="elementor-column-wrap elementor-element-populated">
                                            <div class="elementor-widget-wrap">
                                                <div class="firma-location--quote elementor-element elementor-element-714a86d0 elementor-widget elementor-widget-heading"
                                                     data-id="714a86d0" data-element_type="widget"
                                                     data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <?php if ($quote = get_sub_field('quote')) { ?>
                                                            <h2 class="elementor-heading-title elementor-size-default"><?= $quote ?></h2>
                                                        <? } ?>
                                                    </div>
                                                </div>
                                                <div class="firma-location--address elementor-element elementor-element-3f9756f9 elementor-widget__width-initial titleh3Bewirb elementor-widget elementor-widget-heading"
                                                     data-id="3f9756f9" data-element_type="widget"
                                                     data-widget_type="heading.default">
                                                    <div class="elementor-widget-container">
                                                        <?php if ($address = get_sub_field('address')) { ?>
                                                            <h3 class="elementor-heading-title elementor-size-default"><?= $address ?></h3>
                                                        <? } ?>
                                                    </div>
                                                </div>
                                                <div class="firma-location--map elementor-element elementor-element-3945af1d elementor-widget elementor-widget-google_maps"
                                                     data-id="3945af1d" data-element_type="widget"
                                                     data-widget_type="google_maps.default">
                                                    <div class="elementor-widget-container">
                                                        <div class="elementor-custom-embed">

                                                            <?php if ($map = get_sub_field('google_map')): ?>
                                                                <div class="acf-map" data-zoom="14">
                                                                    <div class="marker" data-lat="<?php echo esc_attr($map['lat']); ?>" data-lng="<?php echo esc_attr($map['lng']); ?>"></div>
                                                                </div>
                                                            <?php endif; ?>
                                                            
                                                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1QGepSCqyWiTuaPuyn1N1V3uO9Lk2stU&callback=Function.prototype"></script>
                                                            <script type="text/javascript">
                                                                (function( $ ) {

                                                                    /**
                                                                     * initMap
                                                                     *
                                                                     * Renders a Google Map onto the selected jQuery element
                                                                     *
                                                                     * @date    22/10/19
                                                                     * @since   5.8.6
                                                                     *
                                                                     * @param   jQuery $el The jQuery element.
                                                                     * @return  object The map instance.
                                                                     */
                                                                    function initMap( $el ) {

                                                                        // Find marker elements within map.
                                                                        var $markers = $el.find('.marker');

                                                                        // Create gerenic map.
                                                                        var mapArgs = {
                                                                            zoom        : $el.data('zoom') || 16,
                                                                            mapTypeId   : google.maps.MapTypeId.ROADMAP
                                                                        };
                                                                        var map = new google.maps.Map( $el[0], mapArgs );

                                                                        // Add markers.
                                                                        map.markers = [];
                                                                        $markers.each(function(){
                                                                            initMarker( $(this), map );
                                                                        });

                                                                        // Center map based on markers.
                                                                        centerMap( map );

                                                                        // Return map instance.
                                                                        return map;
                                                                    }

                                                                    /**
                                                                     * initMarker
                                                                     *
                                                                     * Creates a marker for the given jQuery element and map.
                                                                     *
                                                                     * @date    22/10/19
                                                                     * @since   5.8.6
                                                                     *
                                                                     * @param   jQuery $el The jQuery element.
                                                                     * @param   object The map instance.
                                                                     * @return  object The marker instance.
                                                                     */
                                                                    function initMarker( $marker, map ) {

                                                                        // Get position from marker.
                                                                        var lat = $marker.data('lat');
                                                                        var lng = $marker.data('lng');
                                                                        var latLng = {
                                                                            lat: parseFloat( lat ),
                                                                            lng: parseFloat( lng )
                                                                        };

                                                                        // Create marker instance.
                                                                        var marker = new google.maps.Marker({
                                                                            position : latLng,
                                                                            map: map
                                                                        });

                                                                        // Append to reference for later use.
                                                                        map.markers.push( marker );

                                                                        // If marker contains HTML, add it to an infoWindow.
                                                                        if( $marker.html() ){

                                                                            // Create info window.
                                                                            var infowindow = new google.maps.InfoWindow({
                                                                                content: $marker.html()
                                                                            });

                                                                            // Show info window when marker is clicked.
                                                                            google.maps.event.addListener(marker, 'click', function() {
                                                                                infowindow.open( map, marker );
                                                                            });
                                                                        }
                                                                    }

                                                                    /**
                                                                     * centerMap
                                                                     *
                                                                     * Centers the map showing all markers in view.
                                                                     *
                                                                     * @date    22/10/19
                                                                     * @since   5.8.6
                                                                     *
                                                                     * @param   object The map instance.
                                                                     * @return  void
                                                                     */
                                                                    function centerMap( map ) {

                                                                        // Create map boundaries from all map markers.
                                                                        var bounds = new google.maps.LatLngBounds();
                                                                        map.markers.forEach(function( marker ){
                                                                            bounds.extend({
                                                                                lat: marker.position.lat(),
                                                                                lng: marker.position.lng()
                                                                            });
                                                                        });

                                                                        // Case: Single marker.
                                                                        if( map.markers.length == 1 ){
                                                                            map.setCenter( bounds.getCenter() );

                                                                            // Case: Multiple markers.
                                                                        } else{
                                                                            map.fitBounds( bounds );
                                                                        }
                                                                    }

// Render maps on page load.
                                                                    $(document).ready(function(){
                                                                        $('.acf-map').each(function(){
                                                                            var map = initMap( $(this) );
                                                                        });
                                                                    });

                                                                })(jQuery);
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
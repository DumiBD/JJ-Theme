<section
        class="benefits--section has_eae_slider elementor-section elementor-top-section elementor-element elementor-element-dacccc2 sectionAttraktiven elementor-section-boxed elementor-section-height-default elementor-section-height-default"
         data-element_type="section"
         style="<?= get_sub_field('background_image')
                ? "background-image: url(" . get_sub_field('background_image')['url'] . ");"
                : '' ?>"
>
    <div class="elementor-background-overlay"></div>
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class=" has_eae_slider elementor-column elementor-col-100 elementor-top-column elementor-element" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="benefits--heading">
                            <div class="benefits--title elementor-element elementor-widget elementor-widget-heading" data-element_type="widget" data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <h2 class="elementor-heading-title elementor-size-default">Unsere attraktiven Mitarbeitervorteile</h2>
                                </div>
                            </div>

                            <div class="benefits--subtitle elementor-element elementor-element-6098c14d elementor-widget__width-initial titleh3Attraktive elementor-widget elementor-widget-heading"
                                 data-id="6098c14d" data-element_type="widget" data-widget_type="heading.default">
                                <div class="elementor-widget-container">
                                    <h3 class="elementor-heading-title elementor-size-default">DAS ERWARTET DICH BEI UNS</h3></div>
                            </div>
                        </div>

                        <style>
                            /*.jfwp-firma .benefits--section {*/
                            /*    background-color: #3E3E3E;*/
                            /*    background-position: top center;*/
                            /*    background-repeat: no-repeat;*/
                            /*    background-size: cover;*/
                            /*    padding: 84px 20px 70px 20px;*/
                            /*}*/

                            /*.jfwp-firma .benefits--heading {*/
                            /*    text-align: center;*/
                            /*    margin: 0 auto;*/
                            /*}*/
                            /*.jfwp-firma .benefits--title .elementor-heading-title,*/
                            /*.jfwp-firma .benefits--title {*/
                            /*    margin-bottom: 0;*/
                            /*}*/
                            /*.jfwp-firma .benefits--title .elementor-widget-container {*/
                            /*    margin-bottom: 30px;*/
                            /*}*/

                            /*.jfwp-firma .benefits--title .elementor-heading-title {*/
                            /*    font-family: "Montserrat", sans-serif;*/
                            /*    color: #FFFFFF;*/
                            /*    font-size: 36px;*/
                            /*    font-weight: 700;*/
                            /*    line-height: 44px;*/
                            /*}*/

                            /*.jfwp-firma .benefits--subtitle {*/
                            /*    text-align: center;*/
                            /*    width: initial;*/
                            /*    max-width: initial;*/
                            /*    display: inline-block;*/
                            /*}*/

                            /*.jfwp-firma .benefits--subtitle .elementor-heading-title {*/
                            /*    font-family: "Montserrat", sans-serif;*/
                            /*    margin-bottom: 0;*/
                            /*    color: #FFFFFF;*/
                            /*    font-size: 20px;*/
                            /*    font-weight: 600;*/
                            /*}*/

                            /*.jfwp-firma .benefits--list {*/
                            /*    margin-top: 60px;*/
                            /*}*/
                        </style>

                        <section
                                class="benefits--list has_eae_slider elementor-section elementor-inner-section elementor-element elementor-section-boxed elementor-section-height-default elementor-section-height-default"
                                 data-element_type="section">
                            <div class="elementor-container elementor-column-gap-default">
                                <div class="elementor-row">
                                    <div class="has_eae_slider elementor-column elementor-col-100 elementor-inner-column elementor-element columnItemAttraktiven"
                                         data-element_type="column"
                                         data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                                        <div class="elementor-column-wrap elementor-element-populated">
                                            <div class="elementor-widget-wrap benefits--list__wrap">

                                                <?php
                                                if( have_rows('benefits_list') ):
                                                    while( have_rows('benefits_list') ) : the_row();

                                                        get_template_part("template-parts/firma/content/section/benefits", 'item');
                                                    endwhile;
                                                endif;
                                                ?>
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
<section class="jfwp-firma-header has_eae_slider elementor-section elementor-top-section elementor-element elementor-element-5dd99c15 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
         style="<?= get_sub_field('firma_wide_image')
             ? "background-image: url(" . get_sub_field('firma_wide_image')['url'] . ");"
             : '' ?>"
         data-id="5dd99c15"
         data-element_type="section"
         data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
    <div class="elementor-background-overlay"></div>
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row">
            <div class="has_eae_slider elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-15575af" data-id="15575af" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="firma-header--wrap elementor-element elementor-element-1956a7fe elementor-widget__width-initial elementor-widget elementor-widget-heading" data-id="1956a7fe" data-element_type="widget" data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <?php if ($title = get_sub_field('firma_title')) { ?>
                                    <h1 class="firma-header--title elementor-heading-title elementor-size-default"><?= $title ?></h1>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
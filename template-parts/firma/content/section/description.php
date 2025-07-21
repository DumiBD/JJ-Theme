<?php
?>

<section
    class="jfwp-firma-description has_eae_slider elementor-section elementor-top-section elementor-element elementor-element-6f0bcf92 elementor-section-boxed elementor-section-height-default elementor-section-height-default"
    data-id="6f0bcf92" data-element_type="section">
    <div class="elementor-container elementor-column-gap-default">
        <div class="elementor-row elementor-container">

            <div class="firma-description__img has_eae_slider elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-2ed20862"
                 data-id="2ed20862" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="elementor-element elementor-element-7daedf53 elementor-hidden-mobile elementor-widget elementor-widget-image"
                             data-id="7daedf53" data-element_type="widget"
                             data-widget_type="image.default">
                            <div class="elementor-widget-container">
                                <?php if ($side_image_or_video = get_sub_field('side_image_or_video')) { ?>
                                    <?= $side_image_or_video; ?>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="firma-description__content has_eae_slider elementor-column elementor-col-50 elementor-top-column elementor-element elementor-element-12e4eb9"
                 data-id="12e4eb9" data-element_type="column">
                <div class="elementor-column-wrap elementor-element-populated">
                    <div class="elementor-widget-wrap">
                        <div class="firma-description__title elementor-element elementor-element-778bff5d elementor-widget__width-initial elementor-widget elementor-widget-heading"
                             data-id="778bff5d" data-element_type="widget"
                             data-widget_type="heading.default">
                            <div class="elementor-widget-container">
                                <?php if ($description_title_bold = get_sub_field('description_title_bold')) { ?>
                                    <h2 class="elementor-heading-title elementor-size-default">
                                        <?= $description_title_bold; ?>
                                    </h2>
                                <? } ?>
                            </div>
                        </div>
                        <div class="firma-description__text elementor-element elementor-element-7ca9acc6 elementor-widget elementor-widget-text-editor"
                             data-id="7ca9acc6" data-element_type="widget"
                             data-widget_type="text-editor.default">
                            <div class="elementor-widget-container">
                                <div class="elementor-text-editor elementor-clearfix">
                                    <?php if ($main_description = get_sub_field('main_description')) { ?>
                                        <?= $main_description; ?>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

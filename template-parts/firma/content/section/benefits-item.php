<div class="benefit--item elementor-element elementor-element-7b0bfafc elementor-position-top itemAttraktiven elementor-view-default elementor-mobile-position-top elementor-vertical-align-top elementor-widget elementor-widget-icon-box"
     data-id="7b0bfafc" data-element_type="widget"
     data-widget_type="icon-box.default">
    <div class="elementor-widget-container">
        <div class="elementor-icon-box-wrapper">
            <div class="elementor-icon-box-icon">
                <?php if ($icon = get_sub_field('icon')) { ?>
                    <span class="benefit--icon elementor-icon elementor-animation-">
				        <img src="<?= $icon['url'] ?>" alt="<?= $icon['alt']?>">
                    </span>
                <? } ?>
            </div>
            <div class="elementor-icon-box-content">
                <?php if ($benefit = get_sub_field('benefit')) { ?>
                    <h3 class="benefit--title elementor-icon-box-title">
					    <span><?= $benefit ?></span>
                    </h3>
                <? } ?>

            </div>
        </div>
    </div>
</div>
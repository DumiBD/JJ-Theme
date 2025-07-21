<?php

$term = $args['term'];

$firma_city = get_term_meta($term->term_id, 'firma_city', true);
$firma_region = get_term_meta($term->term_id, 'firma_region', true);
$firma_job_types = get_term_meta($term->term_id, 'firma_job_types', true);
$firma_logo_id = get_term_meta($term->term_id, 'firma_logo', true);
?>

<div class="home-featured__item">
    <div class="home-featured__content">
        <a href="<?= get_term_link($term->term_id, 'firma') ?>">
            <div class="home-featured__logo">
                <?= wp_get_attachment_image($firma_logo_id, 'medium') ?>
            </div>
        </a>

        <a class="home-featured__title" href="<?= get_term_link($term->term_id, 'firma') ?>">
            <h5><?= esc_html($term->name) ?></h5>
        </a>
    </div>

    <div class="home-featured__location">
        <?php if (@$firma_city): ?>
            <span class="home-featured__location--city"><?= @$firma_city ?><?= (@$firma_city && @$firma_region) ? ',' : '' ?></span>
        <?php endif; ?>
        <?php if (@$firma_region): ?>
            <span class="home-featured__location--additional"><?= @$firma_region ?></span>
        <?php endif; ?>
        <?php if (@$firma_job_types): ?>
            <span class="home-featured__location--additional"><span>-</span> <?= @$firma_job_types ?></span>
        <?php endif; ?>
    </div>
</div>
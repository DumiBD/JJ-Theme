<?php

$terms = $args['terms'];
$gridViewType = $args['gridViewType'];
?>

<div class="home-featured-wrap">
    <?= jobsListViewActions() ?>

    <div class="home-featured<?= ' view-' . $gridViewType ?>">
        <?php
        if ($terms && !is_wp_error($terms)):
            foreach ($terms as $term) {

                switch ($gridViewType) {
                    case 'grid':
                        get_template_part('template-parts/firma/item/view', 'grid', ['term' => $term]);
                        break;
                    case 'list':
                        get_template_part('template-parts/firma/item/view', 'list', ['term' => $term]);
                        break;
                    case 'expanded':
                        get_template_part('template-parts/firma/item/view', 'expanded', ['term' => $term]);
                        break;
                    default:
                        get_template_part('template-parts/firma/item/view', 'grid', ['term' => $term]);
                }

            }
        endif;
        ?>
    </div>
</div>

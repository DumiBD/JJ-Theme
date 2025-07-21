<?php

$term = $args['term'];
?>

<div class="jfwp-firma entry-content clear" itemprop="text">
    <div data-elementor-type="page" data-elementor-id="19450" class="elementor elementor-19450">
        <div class="elementor-inner">
            <div class="elementor-section-wrap">
                <?php
//                var_dump(have_rows("firma_content"));
                if (have_rows("firma_content", $term)) :

                    while (have_rows("firma_content", $term)) : the_row();
                        if ($layout = get_row_layout()) {

                            get_template_part("template-parts/firma/content/section/" . $layout, null );
                        }
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>


</div>

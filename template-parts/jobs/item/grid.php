<?php
/*
	Small job preview template


	VSRIABLES:
	
	$post_id
	$btn_name
	$position_title
	$job_location
	$employment_type
	$permalink
	$preview_location
	$preview_employment_type
	$custom_message
*/

$permalink = $args['permalink'];
$target = $args['target'];
$btn_name = $args['btn_name'];
$info = $args['info'];

$custom_message_el = $args['custom_message_el'];
$position_title = $args['position_title'];

$firmaLogoWithLink = $args['view_button'];
$cta_button = $args['cta_button'];

?>

<div class="job-item item-grid job-preview clearfix" >
    <div class="job-content">
        <a class="job-item-title" href="<?= $permalink ?>" target="<?= $target ?>">
            <h5>
                <span><?= $position_title ?></span>
            </h5>
        </a>

        <div class="job-additional-information">
            <?= $info ?>
            <?= $custom_message_el ?? '' ?>
        </div>

        <a href="<?= $permalink ?>" target="<?= $target ?>" class="job-apply"><?= $btn_name ?></a>
    </div>

    <?= $firmaLogoWithLink; ?>
</div>
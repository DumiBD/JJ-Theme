<?php
$currentPageWithQuery = $args['urlWithQuery'];

$viewType = $_SESSION['grid-view'];
?>

<div class="grid-view-actions-container">
    <div class="grid-view-actions">
        <a class="gva-item" href="<?= esc_url(add_query_arg(['grid-view' => 'grid'], $currentPageWithQuery)) ?>" title="<?php _e('View as grid', 'jetztjob2') ?>">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="<?= $viewType === 'grid' ? '#D02130' : 'black' ?>" d="M0 8.25V0H8.25V8.25H0ZM0 18V9.75H8.25V18H0ZM9.75 8.25V0H18V8.25H9.75ZM9.75 18V9.75H18V18H9.75ZM1.5 6.75H6.75V1.5H1.5V6.75ZM11.25 6.75H16.5V1.5H11.25V6.75ZM11.25 16.5H16.5V11.25H11.25V16.5ZM1.5 16.5H6.75V11.25H1.5V16.5Z"/>
            </svg>
        </a>
        <a class="gva-item" href="<?= esc_url(add_query_arg(['grid-view' => 'list'], $currentPageWithQuery)) ?>" title="<?php _e('View as list', 'jetztjob2') ?>">
            <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="<?= $viewType === 'list' ? '#D02130' : 'black' ?>" d="M6.75 14.5H18.5V11.075H6.75V14.5ZM1.5 4.925H5.25V1.5H1.5V4.925ZM1.5 9.6H5.25V6.425H1.5V9.6ZM1.5 14.5H5.25V11.075H1.5V14.5ZM6.75 9.6H18.5V6.425H6.75V9.6ZM6.75 4.925H18.5V1.5H6.75V4.925ZM1.5 16C1.1 16 0.75 15.85 0.45 15.55C0.15 15.25 0 14.9 0 14.5V1.5C0 1.1 0.15 0.75 0.45 0.45C0.75 0.15 1.1 0 1.5 0H18.5C18.9 0 19.25 0.15 19.55 0.45C19.85 0.75 20 1.1 20 1.5V14.5C20 14.9 19.85 15.25 19.55 15.55C19.25 15.85 18.9 16 18.5 16H1.5Z"/>
            </svg>
        </a>
        <a class="gva-item" href="<?= esc_url(add_query_arg(['grid-view' => 'expanded'], $currentPageWithQuery)) ?>" title="<?php _e('View as expanded', 'jetztjob2') ?>">
            <svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="<?= $viewType === 'expanded' ? '#D02130' : 'black' ?>" d="M0 16V14.5H18V16H0ZM0 1.5V0H18V1.5H0ZM1.5 11.725C1.1 11.725 0.75 11.575 0.45 11.275C0.15 10.975 0 10.625 0 10.225V5.775C0 5.375 0.15 5.025 0.45 4.725C0.75 4.425 1.1 4.275 1.5 4.275H16.5C16.9 4.275 17.25 4.425 17.55 4.725C17.85 5.025 18 5.375 18 5.775V10.225C18 10.625 17.85 10.975 17.55 11.275C17.25 11.575 16.9 11.725 16.5 11.725H1.5ZM1.5 10.225H16.5V5.775H1.5V10.225Z"/>
            </svg>
        </a>
    </div>
</div>

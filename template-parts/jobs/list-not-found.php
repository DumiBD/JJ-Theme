<?php
$message = _x('Currently no job offers available.', 'job-message', 'job-postings');
if (get_option('jobs_no_jobs_message' . '_' . Job_Postings::$lang) != '') {
    $message = get_option('jobs_no_jobs_message' . '_' . Job_Postings::$lang);
} ?>

<div class="job-listing row clearfix">
    <div class="<?= $args['class'] ?>">
        <div class="no-jobs-available">
            <p><?= (isset($_GET['job-search']) && $_GET['job-search'] != '') ? $_GET['job-search'] . ': ' : '' ?>0 Jobs gefunden</p>
        </div>
    </div>
</div>
<?php
require_once ('../../includes/initialize.php');
if (!$session -> is_logged_in()) { redirect_to("login.php");
}
?>

<?php
// $file = 'log.txt';
// $path = SITE_ROOT . DS . 'PHP' . DS . 'photo_gallery' . DS . 'logs' . DS . $file;

if (isset($_GET['clear']) && $_GET['clear'] == 'true') {
    // clear the log file
    // log the clear action
    $logger -> log_clear($session->user_id);
}

$content = "";
$content = $logger -> log_read();

// if (!file_exists($path) || !is_readable($path)) {
    // $message = "file is not found or is not readable.";
// } else {
    // // read the file content in a var
    // $content = "";
    // if (filesize($path) > 0) {
        // if ($handle = fopen($path, 'r')) {// read
            // $content = fread($handle, filesize($path));
            // fclose($handle);
        // }
    // } else {
        // $message = "Log file is empty";
    // }
// }
?>

<?php include_layout_template('admin_header.php'); ?>

<h2>Log File</h2>

<?php echo output_message($message); ?>
<div>
    <a href="logfile_new.php?clear=true">Clear the log</a>
</div>
<div>
    <a href="index.php">&laquo; Back</a>
</div>

<?php echo nl2br($content); ?>

<?php include_layout_template('admin_footer.php'); ?>


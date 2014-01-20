<?php require_once("../includes/initialize.php");

// 1. the current page number ($current_page)
$page = ! empty ( $_GET ['page'] ) ? ( int ) $_GET ['page'] : 1;

// 2. records per page ($per_page)
$per_page = 3;

// 3. total record count ($total_count)
$total_count = Photograph::count_all ();

// Find all photos
// use pagination instead
// $photos = Photograph::find_all();

$pagination = new Pagination ( $page, $per_page, $total_count );
// Instead of finding all records, just find the records for this page
$sql = "SELECT * FROM photographs ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = Photograph::find_by_sql ( $sql );

$header = new Smarty;
$header->assign('title', ' Public Section');

$body = new Smarty;
$body->assign('photos', $photos);
$body->assign('pagination', $pagination);
$body->assign('page', $page);

$footer = new Smarty;
?>

<?php $header->display('../templates/header.tpl'); ?>

<?php $body->display('../templates/body.tpl');?>

<?php $footer->display('../templates/footer.tpl'); ?>

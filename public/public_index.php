<?php require_once ('../includes/initialize.php'); ?>
<?php $title = "Test version"; ?>
<?php include_layout_template('header.php'); ?>
<?php echo output_message($message); ?>

<?php
$photograph = new Photograph();
$photograph_array = array();
if (isset($_GET['page']) && $_GET['page'] != null) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}
$photograph_array = $photograph->find_by_page($current_page);
?>

<?php foreach ($photograph_array as $photograph_object): ?>    
    <div style="float: left; margin-left: 20px;">
        <a href="photo.php?id=<?php echo $photograph_object->id; ?>"> <img src="images\<?php echo $photograph_object->filename; ?>" width="200" /> </a>
        <p>
            <?php echo $photograph_object->caption; ?>
        </p>
    </div>
<?php endforeach; ?>

<?php
$total_rows = $photograph->count_all();
// $pagination = new Pagenation($total_rows, $current_page, $page_var_name = "page", $qry_str_page_name = "public_index.php");
// $pagination = Pagenation::make($total_rows, $current_page, $page_var_name = "page", $qry_str_page_name = "public_index.php");
$input = array(
    'total_rows' => $total_rows,
    'current_page' => $current_page,
    'page_var_name' => "page",
    'qry_str_page_name' => "public_index.php"
);
$pagination = Pagenation::instantiate_by_record($input);
// echo "<br />";
// var_dump($pagination2);
// echo "<br />";
$ctrl_str = $pagination->construct_pagination_ctrl_str();
?>
<div id="pagination" style="clear: both;"><?php echo $ctrl_str; ?></div>
<?php include_layout_template('footer.php'); ?>
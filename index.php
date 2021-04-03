<?php
session_start();
if (!isset($_SESSION['email'])) {
header("Location: login.php");
}
?>
<?php
error_reporting(E_ALL & ~E_NOTICE);
// core.php holds pagination variables
include_once 'config/core.php';
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/persons.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
$person = new Person($db);
  
$page_title = "Persons List";
include_once "layout_header.php";
  
// query products
$stmt = $person->readAll($from_record_num, $records_per_page);
  
// specify the page where paging is used
$page_url = "index.php?";
  
// count total rows - used for pagination
$total_rows=$person->countAll();
  
// read_template.php controls how the product list will be rendered
include_once "layout_list.php";
  
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>
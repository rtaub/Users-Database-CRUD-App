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
  
// instantiate database and person object
$database = new Database();
$db = $database->getConnection();
  
$person = new Person($db);
  
// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
  
$page_title = "You searched for \"{$search_term}\"";
include_once "layout_header.php";
  
// query persons
$stmt = $person->search($search_term, $from_record_num, $records_per_page);
  
// specify the page where paging is used
$page_url="search.php?s={$search_term}&";
  
// count total rows - used for pagination
$total_rows=$person->countAll_BySearch($search_term);
  
// read_template.php controls how the person list will be rendered
include_once "layout_list.php";
  
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>
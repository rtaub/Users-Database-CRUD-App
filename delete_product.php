<?php
session_start();
if (!isset($_SESSION['email'])) {
header("Location: login.php");
}
?>
<?php
error_reporting(E_ALL & ~E_NOTICE);
// check if value was posted
if($_POST){
  
    // include database and object file
    include_once 'config/database.php';
    include_once 'objects/persons.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $person = new person($db);
      
    // set product id to be deleted
    $person->id = $_POST['object_id'];
      
    // delete the product
    if($person->delete()){
        echo "Object was deleted.";
    }
      
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>
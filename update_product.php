<?php
session_start();
if (!isset($_SESSION['email'])) {
header("Location: login.php");
}
?>
<?php
error_reporting(E_ALL & ~E_NOTICE);
// get ID of the person to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/persons.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare objects
$person = new Person($db);
  
// set ID property of person to be edited
$person->id = $id;
  
// read the details of person to be edited
$person->readOne();
  
// set page header
$page_title = "Update Person";
include_once "layout_header.php";
  
echo "<div class='right-button-margin'>
          <a href='index.php' class='btn btn-default pull-right'>Read Persons</a>
     </div>";
  
?>
<?php 
// if the form was submitted
if($_POST){
  
    // set person property values
    $person->role = $_POST['role'];
    $person->fname = $_POST['fname'];
    $person->lname = $_POST['lname'];
    $person->email = $_POST['email'];
    $person->phone = $_POST['phone'];
    $person->address = $_POST['address'];
    $person->address2 = $_POST['address2'];
    $person->city = $_POST['city'];
    $person->state = $_POST['state'];
    $person->zip_code = $_POST['zip_code'];
  
    // update the person
    if($person->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Person was updated.";
        echo "</div>";
    }
  
    // if unable to update the person, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update person.";
        echo "</div>";
    }
}
?>
  
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
  
    <tr>
            <td>Role</td>
            <td><!--<input type='text' name='role' class='form-control' />--> 
                <select name='role'>
                    <option value='Admin' disabled>Admin</option>
                    <option value='User' selected>User</option>
                </select>
            </td>
    </tr>
  
        <tr>
            <td>First Name</td>
            <td><input type='text' name='fname' value='<?php echo $person->fname; ?>' class='form-control' /></td>
        </tr>
        
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='lname' value='<?php echo $person->lname; ?>' class='form-control' /></td>
        </tr>
        
        <tr>
            <td>Email</td>
            <td><input type='text' name='email' value='<?php echo $person->email; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Phone</td>
            <td><input type='text' name='phone' value='<?php echo $person->phone; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Address</td>
            <td><input type='text' name='address' value='<?php echo $person->address; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Address2</td>
            <td><input type='text' name='address2' value='<?php echo $person->address2; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>City</td>
            <td><input type='text' name='city' value='<?php echo $person->city; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>State</td>
            <td><input type='text' name='state' value='<?php echo $person->state; ?>' class='form-control' /></td>
        </tr>

        <tr>
            <td>Zip Code</td>
            <td><input type='text' name='zip_code' value='<?php echo $person->zip_code; ?>' class='form-control' /></td>
        </tr>
        
              
 <?php
 //$stmt = $category->read();?>

            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
  
    </table>
</form>
<?php
// set page footer
include_once "layout_footer.php";
?>
<?php
error_reporting(E_ALL & ~E_NOTICE);
// include database and object files
include_once 'config/database.php';
include_once 'objects/persons.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$person = new Person($db);
$page_title = "Create Person";
include_once "layout_header.php";
  
echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Back to list</a>
    </div>";
  
?>
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set properties to $_POST values
    $person->role = $_POST['role'];
    $person->fname = $_POST['fname'];
    $person->lname = $_POST['lname'];
    $person->email = $_POST['email'];
    $person->phone = $_POST['phone'];
    $salt = MD5(microtime(true));
    $person->password_hash = MD5($_POST['password'].$salt);
    $person->password_salt = $salt;
   
    //$dbvalue = password_hash
    //$dbsalt = $password_salt
    //$usereneteredloginpassword = $_POST['password']
    //check to see if $dbvalue == MD5($_POST['password'].$dbsalt)
    
    $person->address = $_POST['address'];
    $person->address2 = $_POST['address2'];
    $person->city = $_POST['city'];
    $person->state = $_POST['state'];
    $person->zip_code = $_POST['zip_code'];

  
    // create the product
    if($person->create()){
        echo "<div class='alert alert-success'>Person was created.</div>";
    }
  
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create person.</div>";
    }
}
?>
  
<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

  
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Role</td>
            <td><!--<input type='text' name='role' class='form-control' />--> 
                <select name='role'>
                    <option value='Admin'>Admin</option>
                    <option value='User' selected>User</option>
                </select>
            </td>
        </tr>
        <tr><td>First</td><td><input type='text' name='fname' class='form-control' /></td></tr>
        <tr><td>Last</td><td><input type='text' name='lname' class='form-control' /></td></tr>
        <tr><td>Email</td><td><input type='text' name='email' class='form-control' /></td></tr>
        <tr><td>Phone</td><td><input type='text' name='phone' class='form-control' /></td></tr>
        <tr><td>Password</td><td><input type='password' name='password' class='form-control' /></td></tr>
        <!--
        <tr><td>password_hash</td><td><input type='text' name='password_hash' class='form-control' /></td></tr>
        <tr><td>password_salt</td><td><input type='text' name='password_salt' class='form-control' /></td></tr>
        -->
        <tr><td>address</td><td><input type='text' name='address' class='form-control' /></td></tr>
        <tr><td>address2</td><td><input type='text' name='address2' class='form-control' /></td></tr>
        <tr><td>City</td><td><input type='text' name='city' class='form-control' /></td></tr>
        <tr><td>State</td><td><input type='text' name='state' class='form-control' /></td></tr>
        <tr><td>Zip Code</td><td><input type='text' name='zip_code' class='form-control' /></td></tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
  
    </table>
</form>
<?php
  
// footer
include_once "layout_footer.php";
?>
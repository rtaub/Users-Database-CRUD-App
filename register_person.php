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
$page_title = "Register Person";
include_once "layout_header.php";
  
echo "<div class='right-button-margin'>
        <a href='login.php' class='btn btn-default pull-right'>Back to login</a>
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
    $person->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $person->password_salt = $salt;
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
        echo "<div class='alert alert-danger'>Unable to create person, only admins can create new persons.</div>";
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
        <tr><td>First</td><td><input type='text' name='fname' placeholder="John" class='form-control' /></td></tr>
        <tr><td>Last</td><td><input type='text' name='lname' placeholder="Doe" class='form-control' /></td></tr>
        <tr><td>Email</td><td><input type='text' name='email' placeholder="email@email.com" class='form-control' /></td></tr>
        <tr><td>Phone</td><td><input type='text' name='phone' placeholder="(XXX) XXX-XXXX" class='form-control' /></td></tr>
        <tr><td>Password</td><td><input type='password' name='password' placeholder="Secure-Pa33word1" class='form-control' /></td></tr>
        <tr><td>Confirm Password</td><td><input type='password' name='cpassword' placeholder="Secure-Pa33word1" class='form-control' /></td></tr>
        <tr><td>address</td><td><input type='text' name='address' placeholder="123 ABC st" class='form-control' /></td></tr>
        <tr><td>address2</td><td><input type='text' name='address2' placeholder="123 ABC ave" class='form-control' /></td></tr>
        <tr><td>City</td><td><input type='text' name='city' placeholder="ABC City" class='form-control' /></td></tr>
        <tr><td>State</td><td><input type='text' name='state' placeholder="MI" class='form-control' /></td></tr>
        <tr><td>Zip Code</td><td><input type='text' name='zip_code' placeholder="12345" class='form-control' /></td></tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Register</button>
            </td>
        </tr>
  
    </table>
</form>
<?php
  
// footer
include_once "layout_footer.php";
?>
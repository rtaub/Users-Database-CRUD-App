<?php
session_start();
if (!isset($_SESSION['email'])) {
header("Location: login.php");
}
?>
<?php
error_reporting(E_ALL & ~E_NOTICE);
// search form
echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type person name or description...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
 
// create person button
echo "<div class='right-button-margin'>";
    echo "<a href='create_person.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create Person";
    echo "</a>";
echo "</div>";

// create logout button
echo "<div class='right-button-margin'>";
    echo "<a href='logout.php' class='btn btn-primary pull-right'>";
        echo "Logout";
    echo "</a>";
echo "</div>";
  
// display the persons if there are any
if($total_rows>0){
  
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Last Name</th>";
            echo "<th>First Name</th>";
            echo "<th>Email</th>";
            echo "<th>Role</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$lname}</td>";
                echo "<td>{$fname}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$role}</td>";
                    
                echo "</td>";
  
                echo "<td>";
  
                    // read product button
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";
                    
                    // edit product button
                    echo "<a href='update_person.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
  
                    // delete product button
                    echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
  
                echo "</td>";
  
            echo "</tr>";
  
        }
  
    echo "</table>";
  
    // paging buttons
    include_once 'paging.php';
}
  
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No products found.</div>";
}
?>
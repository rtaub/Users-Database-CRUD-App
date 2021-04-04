<?php
    session_start();
    //if login.php is called using submit button, check user input
    $errMsg='';
    if (isset($_POST['login'])
        && !empty($_POST['email'])
        && !empty($_POST['password'])) {
        //prevent sql injection
        $_POST['email'] = htmlspecialchars($_POST['email']);
        $_POST['password'] = htmlspecialchars($_POST['password']);
            
            //check database for legit email and password
            include_once 'config/database.php';
            $database = new Database();
            $pdo = $database->getConnection();
            $sql = "SELECT * FROM persons "
                    . "WHERE email=? "
                    . "LIMIT 1"
                    ;
            $query=$pdo->prepare($sql);
            $query->execute(Array($_POST['email']));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            //if the user typed valid login, set $_SESSION
            if ($result) {
                if(password_verify($_POST['password'], $result['password_hash'])){
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['password'] = $result['password_hash'];
                    $_SESSION['role'] = $result['role'];
                    header('Location: index.php');//redirect
                }
                
            }
            else
                $errMsg='Login Failure: wrong email or password';
          
    }
?>
<!DOCTYPE html>
<html lang="en-US">
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
   
    <!-- our custom CSS -->
    <link rel="stylesheet" href="libs/css/custom.css" />
    
    <p style="color: red;"><?php echo $errMsg; ?></p>
    <head>
        <title>Crud Applet with Login</title>
        <meta charset="utf-8" />
    </head>

    <body>
        
        <div class="container">
            <h1>Crud Applet with Login</h1>
            <h2>Login</h2>
            <form action="" method="post">
                <h3>Email</h3>
                <input type="text" class="form-control"
                name="email" placeholder="admin@admin.com"
                required autofocus /><br />
                <h3>Password</h3>
                <input type="password" class="form-control"
                name="password" placeholder="admin"
                required autofocus /><br />
                <button class="btn btn-lg btn-primary btn-block"
                type="submit" name="login">Login</button>
                
                <button class="btn btn-lg btn-secondary btn-block"
                onclick="window.location.href = 'register_person.php' ;"
                type="button" name="join">Join</button>
            </form>
        </div>
    </body>

</html>

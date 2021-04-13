<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect them to welcome page
if (isset($_SESSION["loggedin"])) {
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "includes/config.inc.php";
require_once "includes/db-classes.inc.php";
require_once "includes/helpers.inc.php";


$login_err="";

try {
    $conn = DatabaseHelper::createConnection(array(DBCONNSTRING, DBUSER, DBPASS));
    if (isset($_POST['login'])) {

        $email=$_POST["email"];
        $password=$_POST["password"];

        $userObj = new UsersDB($conn);
        $row1 = $userObj->getUser($email, $password);
        if($userObj->getUser($email,$password)){
            
            $_SESSION["loggedin"]=true;
            $_SESSION["user_id"]=$row1->id;
            header("location: index.php");
            exit();
        }
        else{
            $login_err="Email or Password is incorrect";
        }
    } 
} catch (Exception $e) {
    die($e->getMessage());
}


?>

<!DOCTYPE html>
<html lang=en>

<head>
    <title>Login</title>
    <meta charset=utf-8>
    <link rel="stylesheet" href="styling/index.css">
    <link rel="stylesheet" href="styling/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp -->
</head>

<?php
$check = isset($_SESSION["loggedin"]);
displayNav(false, $check);
?>

<body>
    
        <h2>Sign In</h2>
    </div>

    <!-- <form action="" method="post" class="register-form">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control">
          
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
           
        </div>
        <div class="form-group">
            <input type="submit" name="login" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? <a href="comingSoon.php">Sign up now</a>.</p>
    </form>
    </div> -->
    <form class="form" method="post" action="">
            <div id="errormessage">
    <?php
    if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
    }
    ?>
    </div>
      <input type="text" name="email" placeholder="email"/>
      <input type="password" name="password" placeholder="password"/>
      <button type="submit" name="login" value="Login">login</button>
      <p class="message">Not registered? <a href="comingSoon.php">Create an account</a></p>
    </form>
  </div>
    
</body>

<script src="javascript/index.js"></script>
<script src="javascript/login.js"></script>

</html>
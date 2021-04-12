<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect them to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "includes/config.inc.php";
require_once "includes/db-classes.inc.php";
require_once "includes/helpers.inc.php";
 

?>

<!DOCTYPE html>
<html lang=en>

<head>
  <title>Login</title>
  <meta charset=utf-8>
  <link rel="stylesheet" href="styling/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp -->
</head>

<?php
displayNav(false);
?>

<body>
  <div class="container">
    <h2>Sign In</h2>
    <p>Please fill in your credentials to login.</p>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="">Username/Email</label>
                    <input type="text" name="username" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control"/>
                </div>
                <div class="form-group">
                    <input type="submit" name="btnLogin" class="btn btn-primary" value="Login"/>
                </div>
            </form>
        </div>
    </div>

</div> 
</body>

<script src="javascript/index.js"></script>
<script src="javascript/login.js"></script>
</html>
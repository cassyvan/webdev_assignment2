<?php
session_start();
require_once 'includes/config.inc.php';
require_once 'includes/helpers.inc.php';
require_once 'includes/db-classes.inc.php';
  
?>

<!DOCTYPE html>
<html lang=en>

<head>
  <title>Stock Browser</title>
  <meta charset=utf-8>
  <link rel="stylesheet" href="styling/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp -->
</head>

<?php
$check = isset($_SESSION["loggedin"]);
displayNav(true, $check);
?>

<body>
  <h2 class="stockBrowser">Stock Browser</h2>
  <div class="container">
    <?php displayAbout();
    displayCompanies();
    //if a user is logged in, display links to portfolio, favorites, profile pages, and option to logout. 
    if (isset($_SESSION["loggedin"])){
      displayPortfolio();
      displayFavs();
      displayProfile();
      displayLogout();
    } else {
      //if user not logged in, display login and sign up option
      displayLogin();
      displaySignup();
    }
    
   
   ?>
  </div>
</body>
<script src="javascript/index.js"></script>
</html>
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

$check = false;
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
  $check = $_SESSION["loggedin"];
} 

displayNav(false, $check);

echo "<h1 class='about'>About Us</h1>";
echo "<p id='aboutDescription>
      This site is created for Mount Royal University's COMP 3512 (Web Development II) Assignment #2. <br>
      Professor: Randy Connolly <br>
      Winter 2021 </p>
      <h3>Technologies Used</h3>
      <p>Logo maker: https://www.freelogodesign.org</p>
      <p>Login form: https://codepen.io/colorlib/pen/rxddKy</p>
      <h3> Group Members </h3>
      <p id='aboutDescription'>
      <a href='https://github.com/larte834'>Lidiya Artemenko</a><br>
      <a href='https://github.com/mbao019'>Minh Bao</a><br>
      <a href='https://github.com/landyram'>Randy Lam</a><br>
      <a href='https://github.com/cassyvan'>Cassy Van</a><br>
      <p>
      <p id='aboutDescription'>
      The main assignment github repo can be found <a href='https://github.com/cassyvan/webdev_assignment2'>here</a>
</p>"; 
?>

<body>
  <div class="container">
  </div>
</body>

<script src="javascript/index.js"></script>

</html>
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
    <link rel='stylesheet' href='styling/index.css'>
    <!-- The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>

<?php
$check = isset($_SESSION["loggedin"]);
displayNav(false, $check);
?>

<body>
    <h1>Companies</h1>
    <div class="filter">
        <label> Filter:</label>
        <input type="text" id="searchBox" placeholder="Search..">
        <input id="resetButton" type="reset" value="Reset"></input>
    </div>
    <div id='loader1' class='lds-ring'>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class='companiesDisplay'>
        <ul class="companiesList"></ul>
    </div>
</body>

<script src="javascript/index.js"></script>
<script src="javascript/list.js"></script>

</html>
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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>

<?php
$check = isset($_SESSION["loggedin"]);
displayNav(false, $check);
//much of the functionality of this page is handled by JS
?>

<body>
    <h1> Company </h1>
    <div class="singleCompany"></div>
    <div class="button"></div> 
</body>

<script src="javascript/index.js"></script>
<script src="javascript/single-company.js"></script>

</html>
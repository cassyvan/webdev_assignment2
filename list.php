<?php
require_once 'includes/config.inc.php';
require_once 'includes/helpers.inc.php';
require_once 'includes/db-classes.inc.php';

displayNav(false);

?>
<!DOCTYPE html>
<html lang=en>

<head>
    <title>Stock Browser</title>
    <meta charset=utf-8>
    <link rel='stylesheet' href='styling/index.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>

<body>
    <h2>hi</h2>
    <div id='loader1' class='lds-ring'>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div class='companiesDisplay'>
        <ul class='companiesList'></ul>
    </div>
</body>
<script src="javascript/index.js"></script>
<script src="javascript/list.js"></script>

</html>
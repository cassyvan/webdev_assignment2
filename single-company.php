<?php
require_once 'includes/config.inc.php';
require_once 'includes/helpers.inc.php';
require_once 'includes/db-classes.inc.php';
?>

<!DOCTYPE html>
<html lang=en>

<head>
    <title>Stock Browser</title>
    <meta charset=utf-8>
    <link rel='stylesheet' href='styling/singleList.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>

<?php
displayNav(false);

echo "<div class='singleCompanyContent'>";
echo "</div>";
echo "this is a single company page";
?>

<script src="javascript/index.js"></script>
<script src="javascript/single-company.js"></script>

</html>
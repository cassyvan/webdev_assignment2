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
  <link rel="stylesheet" href="styling/index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp -->
</head>

<?php
displayNav(false);

try {
  
  $conn = DatabaseHelper::createConnection(array(DBCONNSTRING,DBUSER, DBPASS));
  session_start();

  if(isset($_GET["id"])){
    $portfolioGateway = new PortfolioDB($conn);
    $id = $portfolioGateway->getPortfolio($_GET["id"]);
    getPortfolio($id);
  } else {
    $userId = null;
  } 
} catch (Exception $e) {
  die($e->getMessage());
}

function getPortfolio($id) {
  echo "<h1> Portfolio </h1>";
  //create table and caption row
  echo "<table class=portfolio><tr class='row'>";
  $tableHeader = array("Symbol", "Name", "# Shares", "Close ($)", "Value ($)");
  foreach($tableHeader as $head) {
    echo "<th>" . $head . "</th>" ;
  }
  echo "</tr>";

  //loop through data and populate table
  foreach ($id as $key => $value) {
    echo "<tr class='row'>";
    foreach ($value as $data) {
      if ($data == $value["symbol"]) {
        echo "<td>" . $data . "</td>";
      } else if ($data == $value["name"]) {
        echo "<td>" . $data . "</td>";
      } else if ($data == $value["amount"]) {
        echo "<td>" . $data . "</td>";
      } else if ($data == $value["close"]) {
        echo "<td>" . $data . "</td>";
      } else {
        echo "<td>" . $data . "</td>";
      } 
    }
    echo "</tr>";
  }
  echo "</table>";
}
?>

<body>
  <div class="container">
    <!-- <?php getPortfolio($userId) ?> -->
  </div>
</body>

<script src="javascript/index.js"></script>

</html>
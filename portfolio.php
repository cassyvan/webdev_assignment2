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
  $conn = DatabaseHelper::createConnection(array(
    DBCONNSTRING,
    DBUSER, DBPASS
  ));
  session_start();

  if (isset($_GET["user_id"]) && isset($_SESSION["loggedin"])) {
    $portfolioGateway = new PortfolioDB($conn);
    $id = $portfolioGateway->getPortfolio($_GET["user_id"]);
    getPortfolio($id);
  } else {
    $id = null;
    echo "<p>Please log in/sign up to view your portfolio</p>";
  }
} catch (Exception $e) {
  die($e->getMessage());
}

function getPortfolio($id)
{
  echo "<h1> Portfolio </h1>";
  //create table and caption row
  echo "<table class=portfolio><tr class='row'>";
  $tableHeader = array("Symbol", "Name", "# Shares", "Close ($)", "Value ($)");
  foreach ($tableHeader as $head) {
    echo "<th>" . $head . "</th>";
  }
  echo "</tr>";

  //loop through data and populate table
  $total = 0;
  foreach ($id as $key => $value) {

    echo "<tr class='row'>";
    foreach ($value as $data) {

      if ($data == $value["symbol"]) {
        echo "<td><img src='logos/$data.svg'/><a href='single-company.php?symbol=$data'>" . $data . "</a></td>";
      } else if ($data == $value["name"]) {
        echo "<td><a href='single-company.php?symbol=" . $value['symbol'] . "'>" . $data . "<a/></td>";
      } else if ($data == $value["amount"]) {
        echo "<td>" . $data . "</td>";
      } else if ($data == $value["close"]) {
        echo "<td>" . round($data, 2) . "</td>";
      } else {
        echo "<td>" . round($data, 2) . "</td>";
        $total += $data;
      }
    }
    echo "</tr>";
  }
  echo "</table>";
  //calculate total portfolio value
  echo "<p>Total Portfolio Value: $" . round($total, 2) . "</p>";
}
?>

<body>
  <div class="container">

  </div>
</body>

<script src="javascript/index.js"></script>

</html>
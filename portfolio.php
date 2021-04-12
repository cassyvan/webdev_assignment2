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
    // $userGateway = new UsersDB($conn);
    $portfolioGateway = new PortfolioDB($conn);
    // $userId = $userGateway->getAll();
    $id = $portfolioGateway->getPortfolio($_GET["id"]);
    displayPortfolio($id);
  } else {
    $userId = null;
    echo "NULL";
  } 
} catch (Exception $e) {
  die($e->getMessage());
}

function getPortfolio($user) {
  echo "<h1> Portfolio </h1>";
  //create table and caption row
  echo "<table class=portfolio><tr class='row'>";
  $tableHeader = array("Symbol", "Name", "# Shares", "Close ($)", "Value ($)");
  foreach($tableHeader as $head) {
    echo "<th>" . $head . "</th>" ;

  }
  echo "</tr>";

  //loop through data and populate table
  foreach ($user as $key => $value) {
    echo "<tr class='row'>";
 
    foreach ($value as $data)
    echo "<td>" . $data . "</td>";
    echo "</tr>";
  }
  echo "</table>";
}
?>

<body>
  <div class="container">
    <!-- <?php displayPortfolio(); ?> -->
  </div>
</body>

<script src="javascript/index.js"></script>

</html>
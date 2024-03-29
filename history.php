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

<body>

<?php
 $check = isset($_SESSION["loggedin"]);
 displayNav(false, $check);

      
    try {
      $conn = DatabaseHelper::createConnection(array(
        DBCONNSTRING,
        DBUSER, DBPASS
      ));
      //retrieve the company history from the database based on the query string given
      if (isset($_GET['symbol'])) {
        if (isset($_GET['sort'])) {
          $historyGateway = new HistoryDB($conn);
          $history = $historyGateway->getSortedCompany($_GET['symbol'], $_GET['sort']);
        } else { 
          $historyGateway = new HistoryDB($conn);
          $history = $historyGateway->getAllCompanySymbol($_GET['symbol']);
        }
      
        displayTable($history);
        
      } else {
        $history = null;
      }
    } catch (Exception $e) {
      die($e->getMessage());
    }

    //output the history data as a table
    function displayTable($history) {

      echo "<h1> Monthly Data </h1>";
      echo "<table class=stockData><tr class='row'>";

      $tableHeader = array("Date", "Open", "High", "Low", "Close", "Volume");
      foreach ($tableHeader as $head) {
        echo "<th><a href=history.php?symbol=" .$_GET['symbol'] . "&sort=" . $head . " class='tableheader'>" . $head . "</th>" ;
      }
      echo "</tr>";

      foreach ($history as $key => $value) {
        echo "<tr class='row'>";
        foreach ($value as $data) {
          
          if ($data == $value["date"]) {
            echo "<td>" . $data . "</td>";
          } else if ($data == $value["volume"]) {
            $vol = number_format($data);
            echo "<td>" . $vol . "</td>";
          } else {
            $num = number_format((float)$data, 2);
            echo "<td>$" . $num . "</td>";
          }
        }
        echo "</tr>";
      }
      echo "</table>";
    }
    
    ?>


  <!-- </div> -->
</body>
<script src="javascript/index.js"></script>
</html>
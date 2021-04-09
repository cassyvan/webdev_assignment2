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
  <link rel="stylesheet" href="styling/history.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp -->
</head>

<?php
displayNav(false);
echo "this is the history page"; 
?>

<body>
  <div class="container">
    <h1> Monthly Data </h1>
    <div class="stockData"> 
      <div class="date">
        <h2> Date </h2>
      </div>
      <div class="open">
        <h2> Open </h2>
        </div>
      <div class="high">
        <h2> High </h2>
      </div>
      <div class="low">
        <h2> Low </h2>
      </div>
      <div class="Close">
        <h2> Close </h2>
      </div>
      <div class="volume">
        <h2> Volume </h2>
      </div>
    </div>


    <?php

    // echo $_GET['symbol'];


    $company = "api-companies.php?symbol=" . $_GET['symbol'] . "</br>";
    echo $company;
      
      try {
        $conn = DatabaseHelper::createConnection(array(
          DBCONNSTRING,
          DBUSER, DBPASS
        ));
        if (isset($_GET['symbol'])) {
          $historyGateway = new HistoryDB($conn);
          $history = $historyGateway->getAllCompanySymbol($_GET['symbol']);

          // echo $history;

          foreach ($history as $key => $value) {
            foreach ($value as $data) {
              echo $key . ": " . $data . "</br>";
            }
          }

        } else {
          $history = null;
        }
      } catch (Exception $e) {
        die($e->getMessage());
      }
    



    ?>


  </div>
</body>

<!-- <script src="javascript/history.js"></script> -->

</html>
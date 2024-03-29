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
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $check = isset($_SESSION["loggedin"]);
} else {
  $check = false;
}
displayNav(false, $check);

?>

<body>
  <div class="favContainer">
    <h1> Favorites </h1>
    <div class="favorites">
      <ul>
        <?php
        if ($check) {
          try {
            $conn = DatabaseHelper::createConnection(array(
              DBCONNSTRING,
              DBUSER, DBPASS
            ));
            $url = 'Location: favorites.php';
            //check to see if "remove all" is set, if it is, then destroy the old session for favorites
            //unset method documentation found on https://www.php.net/manual/en/function.session-unset.php
            if (isset($_GET['destroy'])) {
              unset($_SESSION['favorites']);
              header($url);
            }
            if (isset($_GET['company'])) {
              //check to see if we favorites stored yet, if not start a new list 
              if (!isset($_SESSION['favorites'])) {
                $_SESSION['favorites'] = [];
              }
              $companyGateway = new CompaniesDB($conn);
              $company = $companyGateway->getSingleCompany($_GET['company']);
              $company = $company[0];
              //checks to see if the company already exists in the session array
              if (!in_array($company, $_SESSION['favorites'])) {
                $fav = $_SESSION["favorites"];
                $fav[] = $company;
                $_SESSION['favorites'] = $fav;
              }
            }
            //if we have a favorites session set, then we output it, otherwise display a message saying no favorites is set
            if (isset($_SESSION['favorites'])) {
              echo "<form method='post' action='favorites.php?destroy='>";
              echo "<button class='button' id='remAllButton' type='submit' value='all'>Remove All</button>";
              echo "</form>";
              $fav = $_SESSION["favorites"];
              //updates and stores the companies into session favorites and then outputs it
              foreach ($fav as $f => $value) {
                echo "<li id='fav'>";
                echo "<img src='logos/" . $value['symbol'] . ".svg' id='favLogo'>";
                echo "<div id='favNameSymbol'><a href ='single-company.php?symbol=" . $value['symbol'] . "'>" . $value['symbol'] . " </a>";
                echo "<a href='single-company.php?symbol=" . $value['symbol'] . "'>" . $value['name'] . "</a></div>";
                echo "<form method='get' action='favorites.php?remove='>";
                echo "<button class='button' id='remButton' type='submit' name='remove'" . " value='" . $value['symbol'] . "'>Remove</button>";
                echo "</form>";
                echo "</li>";
              }
            } else {
              echo "<p>You have no favorites set</p>";
            }
            //checks for query string for "remove" 
            if (isset($_GET['remove'])) {
              //check to see if there's only 1 company in the session to remove, if so, we restart the session
              if (count($fav) == 1) {
                unset($_SESSION['favorites']);
                header($url);
              }
              //loop through the session array to find company to remove
              foreach ($_SESSION["favorites"] as $key  => $value) {
                if ($value['symbol'] == $_GET['remove']) {
                  //this was found on https://board.phpbuilder.com/d/10345796-resolved-remove-item-from-session-array/4
                  unset($_SESSION['favorites'][$key]);
                  //if more than 1 company in the session favorites, we close the session and refresh the page
                  session_write_close();
                  header($url);
                }
              }
            }

          } catch (Exception $e) {
            die($e->getMessage());
          }
        } else {
          echo "<p>Please login to view/set favorites </p>";
        }
        ?>
      </ul>
    </div>
  </div>
</body>

<script src="javascript/index.js"></script>

</html>
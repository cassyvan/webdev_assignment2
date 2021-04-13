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
?>

<body>
  <div class="favContainer">
    <h1> Favorites </h1>
    <div class="favorites">
      <ul>
        <?php
        try {
          $conn = DatabaseHelper::createConnection(array(
            DBCONNSTRING,
            DBUSER, DBPASS
          ));
          $url = 'Location: favorites.php';
          session_start();
          if (isset($_GET['destroy'])) {
            session_destroy();
            header($url);
          } else {
            if (!isset($_SESSION['favorites'])) {
              $_SESSION['favorites'] = [];
              echo "<p>You have no favorites set</p>";
            } else {
              echo "<form method='post' action='favorites.php?destroy='>";
              echo "<button class='button' type='submit' value='all'>Remove All</button>";
              echo "</form>";
              $fav = $_SESSION["favorites"];
              if (isset($_GET['company'])) {
                $companyGateway = new CompaniesDB($conn);
                $company = $companyGateway->getSingleCompany($_GET['company']);
                $company = $company[0];
                if (!in_array($company, $_SESSION['favorites'])) {
                  $fav[] = $company;
                }
              }
              if (isset($_GET['remove'])) {
                foreach ($_SESSION["favorites"] as $key  => $value) {

                  if ($value['symbol'] == $_GET['remove']) {
                    unset($_SESSION['favorites'][$key]);
                    if (count($fav) == 1) {
                      session_destroy();
                      header($url);
                    }
                    session_write_close();
                    header($url);
                  }
                }
              }
              $_SESSION["favorites"] = $fav;
              foreach ($fav as $f => $value) {
                echo "<li id='fav'>";
                echo "<img src='logos/" . $value['symbol'] . ".svg' id='favLogo'>";
                echo "<div id='favNameSymbol'>" . $value['symbol'] . " ";
                echo $value['name'] . "</div>";
                echo "<form method='get' action='favorites.php?remove='>";
                echo "<button class='button' type='submit' name='remove'" . " value='" . $value['symbol'] . "'>Remove</button>";
                echo "</form>";
                echo "</li>";
              }
            }
          }
        } catch (Exception $e) {
          die($e->getMessage());
        }
        ?>
      </ul>
    </div>
  </div>
</body>

<script src="javascript/index.js"></script>

</html>
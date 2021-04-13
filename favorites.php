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
$check = isset($_SESSION["loggedin"]);
displayNav(false, $check);

?>

<body>
  <div class="container">
    <h1> Favorites </h1>
    <div class="favorites">
      <ul>
        <?php
        try {
          $conn = DatabaseHelper::createConnection(array(
            DBCONNSTRING,
            DBUSER, DBPASS
          ));
          if (isset($_POST['all'])) {
            session_destroy();
          }
          session_start();
          if (isset($_SESSION['favorites'])) {
            echo "<form method='post' action='favorites.php?destroy='>";
            echo "<button class='button' type='submit' value='all'>Remove All</button>";
          }
          if (!isset($_SESSION['favorites'])) {
            $_SESSION['favorites'] = [];
            echo "You have no favorites set";
          }
          $fav = $_SESSION["favorites"];
          if (isset($_GET['company'])) {
            $companyGateway = new CompaniesDB($conn);
            $company = $companyGateway->getSingleCompany($_GET['company']);
            $company = $company[0];
            if (!in_array($company, $_SESSION['favorites'])) {
              $fav[] = $company;
            }
          }
          $_SESSION["favorites"] = $fav;
          foreach ($fav as $f => $value) {
            echo "<li>";
            echo "<img src='logos/" . $value['symbol'] . ".svg'>";
            echo $value['symbol'] . " ";
            echo $value['name'];
            echo "<form method='post' action='favorites.php?'>";
            echo "<button class='button' type='submit' value= '" . $value['symbol'] . "'>Remove</button>";
            echo "</li>";
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
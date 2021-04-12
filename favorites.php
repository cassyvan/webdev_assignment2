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
  <div class="container">
    <h1> Favorites </h1>
    <div class="favorites">
      <?php 
      try {
        $conn = DatabaseHelper::createConnection(array(
          DBCONNSTRING,
          DBUSER, DBPASS
        ));
        if (isset($_GET['company'])) {
            $companyGateway = new CompaniesDB($conn);
            $company = $companyGateway->getSingleCompany($_GET['company']);
            session_start();
            if(!isset($_SESSION['favorites'])){
              //check to see if we have a favorites array already, if not, we initiate it
              $_SESSION["favorites"] = [];
            }
            //retrieve any existing favorites
            $fav = $_SESSION["favorites"];
            //pass product id to the array
            $fav = $company[0]['name'];
            // //resume modified array back to the session state
            $_SESSION["favorites"] = $fav;
            
            // foreach($fav as $f){
            //   echo $f;
            // }
            echo $_SESSION["favorites"];
        
        } else {
          $company = null;
        }
      } catch (Exception $e) {
        die($e->getMessage());
      }


?>
    </div>
  </div>
</body>

<script src="javascript/index.js"></script>

</html>
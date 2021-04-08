<?php

require_once 'includes/config.inc.php';
require_once 'includes/helpers.inc.php';
require_once 'includes/db-classes.inc.php';

// now retrieve galleries 
// try {
//   $conn = DatabaseHelper::createConnection(array(
//     DBCONNSTRING,
//     DBUSER, DBPASS
//   ));
//   $galleryGateway = new GalleryDB($conn);
//   $galleries = $galleryGateway->getAll();
//   if (isset($_GET['museum']) && $_GET['museum'] > 0) {
//     $paintGateway = new PaintingDB($conn);
//     $paintings = $paintGateway->getAllForGallery($_GET['museum']);
//   } else {
//     $paintings = null;
//   }
// } catch (Exception $e) {
//   die($e->getMessage());
// }
// // now retrieve  paintings ... either all or a subset based on querystring
// try {
//   $conn = DatabaseHelper::createConnection(array(
//     DBCONNSTRING,
//     DBUSER, DBPASS
//   ));
//   $paintingGateway = new PaintingDB($conn);
//   $AllPaintings = $paintingGateway->getTopTwentyPaintings();
// } catch (Exception $e) {
//   die($e->getMessage());
// }


?>
<!-- <!DOCTYPE html>
<html lang=en>

<head>
  <title>Lab 14</title>
  <meta charset=utf-8>
  <link rel="stylesheet" href="styling/styling.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp
</head> -->
<?php 
createHead();
displayNav() ?>
<body>
    <div class="container">
    </div>


</body>
    <script src="index.js"></script>
</html>
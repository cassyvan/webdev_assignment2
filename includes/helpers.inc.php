<?php

function createHead(){
    echo "<!DOCTYPE html>
            <html lang=en>
            <head>
            <title>Stock Browser</title>
  <meta charset=utf-8>";
  echo "<link rel='stylesheet' href='styling/styling.css'>";
  echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
  //The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp
echo "</head>";
}

function displayNav() {

    $navList = ["about", "portfolio", "favorites", "profile", "login", "logout"];

    echo "<nav class='nav'>";
    echo "<img src='images/mru_logo.jpg' class='logo'>";
    echo "<button class='hamburgerIcon'><i class='fa fa-bars'></i></button>";
    echo "<div id='navLinks'>";
    echo "<a href='index.php'>Home</a>";
    echo "<a href='list.php'>Companies</a>";

    foreach($navList as $link){
        echo "<a href='" . $link . ".php'>" . $link . "</a>";       
    }

    echo "</div>";
    echo "</nav>";
}


?>
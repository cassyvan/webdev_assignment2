<?php

function createHead(){
    echo "<!DOCTYPE html>
            <html lang=en>
            <head>
            <title>Stock Browser</title>
  <meta charset=utf-8>";
  echo "<link rel='stylesheet' href='styling/styling.css'>";
//   echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
  //The hamburger menu was found on https://www.w3schools.com/howto/howto_js_mobile_navbar.asp
echo "</head>";
}

function displayNav($isHome) {

    echo "<nav class='nav'>";
    echo "<img src='images/mru_logo.jpg' class='logo'>";
    echo "<div class='hamburgerIcon'><div></div><div></div><div></div></i></div>";
    echo "<div id='navLinks'>";
    if (!$isHome) {
        echo "<a href='index.php'>Home</a>";
    }
    echo "<a href='about.php'>About</a>";
    echo "<a href='list.php'>Companies</a>";
    echo "<a href='portfolio.php'>Portfolio</a>";
    echo "<a href='comingSoon.php'>Profile</a>";
    echo "<a href='favorites.php'>Favorites</a>";
    //this should be displayed differently depending on if the user is already logged in or not
    echo "<a href='list.php'>Login/Logout</a>";
    echo "</div>";
    echo "</nav>";


}

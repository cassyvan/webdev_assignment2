<?php

function getCompanySQL()
{
  $sql = 'SELECT symbol, name, sector, subindustry, address, exchange, website, description, latitude, longitude, financials FROM companies';
  $sql .= " ORDER BY name";
  return $sql;
}

function displayNav($isHome, $check) {
  echo "<nav class='nav'>";
  echo "<a href='index.php'><img src='images/logo.png' class='logo'></a>";
  echo "<div class='hamburgerIcon'><div></div><div></div><div></div></i></div>";
  echo "<div id='navLinks'>";
  if (!$isHome) {
    echo "<a href='index.php'>Home</a>";
  }
  echo "<a href='about.php'>About</a>";
  echo "<a href='list.php'>Companies</a>";
  //this should be displayed differently depending on if the user is already logged in or not
  if ($check){
    echo "<a href='portfolio.php'>Portfolio</a>";
    echo "<a href='comingSoon.php'>Profile</a>";
    echo "<a href='favorites.php'>Favorites</a>";
    echo "<a href='logout.php'>Logout</a>";
  } else{
    echo "<a href='login.php'>Login</a>";
    echo "<a href='comingSoon.php'>Sign Up</a>";
  }
  echo "</div>";
  echo "</nav>";
}

function displayAbout(){
  echo "<a href='about.php'><div class='homeButton'><p>About</p></div></a>";
}
function displayCompanies(){
  echo "<a href='list.php'><div class='homeButton'><p>Companies</p></div></a>";
}
function displayLogin(){
  echo "<a href='login.php'><div class='homeButton'><p>Log In</p></div></a>";
}
function displaySignup(){
  echo "<a href='comingSoon.php'><div class='homeButton'><p>Sign Up</p></div></a>";
}
function displayPortfolio(){
  echo "<a href='portfolio.php'><div class='homeButton'><p>Portfolio</p></div></a>";
}
function displayFavs(){
  echo "<a href='favorites.php'><div class='homeButton'><p>Favourites</p></div></a>";
}
function displayProfile(){
  echo "<a href='profile.php'><div class='homeButton'><p>Profile</p></div></a>";
}
function displayLogout(){
  echo "<a href='logout.php'><div class='homeButton'><p>Logout</p></div></a>";
}
<?php

function getCompanySQL()
{
  $sql = 'SELECT symbol, name, sector, subindustry, address, exchange, website, description, latitude, longitude, financials FROM companies';
  $sql .= " ORDER BY name";
  return $sql;
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
  echo "<a href='login.php'>Login/Logout</a>";
  echo "</div>";
  echo "</nav>";
}
<?php
// include the session.php file
include 'session.php';
include 'dbcon.php';
?>
<html>
<head>
    <title>Main</title>
</head>
<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="style.css">
<body>

<div class="container">
  <!-- The banner row -->
  <div class="banner">
  <img src="banner.jpg" alt="Banner Image"></img>
    <!-- topnav -->
    <div class="topnav">
    <a href="main page admin.php">UTAMA</a>
    <a class="active" href="import.php">IMPORT JENIS</a>
    <a href="Senarai.php">SENARAI ITEM</a>
    <a href="laporan.php">LAPORAN</a>       
  </div> 
  </div>

  <!-- The left column -->
  <div class="column-left">
    <input type="button" onclick="location.href='keluar.php';" value="keluar" />
  </div>
  <!-- The right column -->
  <div class="column-right">

  </div>  
 
</div>
</body>
</html>

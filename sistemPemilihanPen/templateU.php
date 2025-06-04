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
    <a href="main page user.php">UTAMA</a>
    <a class="active" href="kemaskiniAkaun.php">KEMASKINI AKAUN</a>
    <a href="pemilihan.php">PEMILIHAN</a>    
  </div> 
  </div>

  <!-- The left column -->
  <div class="column-left">
  <form method="post">
    <?php
    // query the database to get the pen types
    $sql = "SELECT DISTINCT nama_jenia FROM jenis";
    $result = mysqli_query($conn, $sql);

    // loop through the pen types and display them as radio buttons
    while ($row = mysqli_fetch_assoc($result)) {
        $pen_type = $row['nama_jenia'];
        echo "<input type='radio' name='nama_jenia' value='$pen_type'> $pen_type<br>";
    }
    ?>
    <input type="submit" name="submit" value="Cari">
    </form>
    <input type="button" onclick="location.href='keluar.php';" value="keluar" />
  </div>
  <!-- The right column -->
  <div class="column-right">

  </div>  
 
</div>
</body>
</html>

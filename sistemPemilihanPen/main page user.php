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
<link rel="stylesheet" type="text/css" href="radio.css">
<body>

<div class="container">
  <!-- The banner row -->
  <div class="banner">
  <img src="banner.jpg" alt="Banner Image"></img>
    <!-- topnav -->
    <div class="topnav">
    <a class="active" href="main page user.php">UTAMA</a>
    <a href="kemaskiniAkaun.php">KEMASKINI AKAUN</a>
    <a href="pemilihan.php">PEMILIHAN</a>    
    <a href="shopcart.php">LAPORAN</a>
    <a href="keluar.php" style="float: right;">KELUAR</a> 
  </div> 
  </div>

  <!-- The left column -->
  <div class="column-left">
    
  <div class="forma">
  <form method="post" action="pemilihan.php">
  JENIS:<br>
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
  </div>
  </div>
  <!-- The right column -->
  <div class="column-right">
  <br>
  <br>
  <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-align: center"> SELAMAT DATANG KE SISTEM PEMILIHAN PEN</h1>
  <br><h2 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-align: center"><=-=Sistem ini membantu pengguna membuat pemilihan pan berdasarkan jenis dan perbandingan harga.=-=></h2>
  <br><h3 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;text-align: center">~KOID ZHE WHUAI~</h3>  

  </div>  
 
</div>
</body>
</html>

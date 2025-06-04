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
<link rel="stylesheet" type="text/css" href="cardd.css">
<body>

<div class="container">
  <!-- The banner row -->
  <div class="banner">
  <img src="banner.jpg" alt="Banner Image"></img>
    <!-- topnav -->
    <div class="topnav">
    <a class="active" href="main page admin.php">UTAMA</a>
    <a href="import.php">IMPORT JENIS</a>
    <a href="Senarai.php">SENARAI ITEM</a>
    <a href="laporan.php">LAPORAN</a>
   <a href="keluar.php" style="float: right;">KELUAR</a>
     
  </div> 
  </div>

  <!-- The left column -->
  <div class="column-left">
    
  <div class="forma">
  JENIS:
  <form method="post" action="senarai.php">

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
  <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;text-align: center">~ SELAMAT DATANG TUAN ~</h1>

  <div style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-align:left ; margin-left: 20px;">
  <h2 style="font-size:40px;">Memilih Pen yang Tepat: Faktor-Faktor yang Perlu Dipertimbangkan</h2>
  <h2 style="font-size:30px;">1) Harga pen</h2>
  <h2 style="font-size:30px;">2) Jenis pen :</h2>
  <div class="product-list">
  <div class="card">
      Gel Pen:   
      <img src="gel.jpg" width="200" height="100" style="display: block; margin: auto auto;"></img> 
      <p>Dakwat gel berasaskan air yang pekat dan tidak tembus cahaya untuk menulis dengan lancar.</p>
        <form method="post" action="senarai.php">
    <input type="hidden" name="nama_jenia" value="Gel Pen">
    <input type="submit" name="submit" value="Cari">
    </form>  
  </div>
  <div class="card">
      Fountain Pen:   
      <img src="fountain.jpg" width="200" height="100"style="display: block; margin: auto auto;"></img> 
      <p>Menggunakan nib untuk mengawal aliran dakwat bagi pengalaman menulis klasik dan elegan</p> 
        <form method="post" action="senarai.php">
    <input type="hidden" name="nama_jenia" value="Fountain Pen">
    <input type="submit" name="submit" value="Cari">
    </form>  
      </div>
  <div class="card">
      Ballpoint Pen:  
      <img src="ball.jpg"  width="200" height="100"style="display: block; margin: auto auto;"></img> 
      <p>Dakwat berasaskan minyak yang mengalir melalui bola kecil yang berputar di hujung pen.</p>
        <form method="post" action="senarai.php">
    <input type="hidden" name="nama_jenia" value="Ball Pen">
    <input type="submit" name="submit" value="Cari">
    </form>  
      </div>
  <div class="card">
      Rollerball Pen:   
      <img src="rollerball.jpg"  width="200" height="100"style="display: block; margin: auto auto;"></img> 
      <p>Dakwat cecair berasaskan air untuk menulis dengan lebih lancar.</p>
        <form method="post" action="senarai.php">
    <input type="hidden" name="nama_jenia" value="Rollerball Pen">
    <input type="submit" name="submit" value="Cari">
    </form>  
      </div>
  <div class="card">
      Marker Pen:   
      <img src="marker.jpg" width="200" height="100" style="display: block; margin: auto auto;"></img> 
      <p>Dakwat berasaskan alkohol yang kering cepat dan tahan.</p>
        <form method="post" action="senarai.php">
    <input type="hidden" name="nama_jenia" value="Marker Pen">
    <input type="submit" name="submit" value="Cari">
    </form>  

  </div>
</div>

  <h2 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;text-align: center">ANDA BOLEH...</h2>
  <a href="import.php" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-decoration: none; color: black; text-align: center; display: block;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"><~  IMPORT JENIS  ~></a>
  <a href="senarai.php" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-decoration: none; color: black; text-align: center; display: block;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"><~  KEMASKINI MAKLUMAT PEN DAN PADAM REKOD PEN  ~></a>
  <a href="laporan.php" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-decoration: none; color: black; text-align: center; display: block;" onmouseover="this.style.color='blue'" onmouseout="this.style.color='black'"><~  CETAK LAPORAN SENARAI PEN IKUT CARIAN ANDA  ~></a>
<br><br>
</div>


 
</div>
</body>
</html>
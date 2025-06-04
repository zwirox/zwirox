<?php
// include the session.php file
include 'session.php';
include 'dbcon.php';
if (isset($_POST['add'])) {
$nama_pen = $_POST['nama_pen'];
$harga = $_POST['harga'];
$image = file_get_contents($_FILES['image']['tmp_name']);
$escapedImageData = mysqli_real_escape_string($conn, $image);
$nama_jenis = $_POST['nama_jenis'];

$sql = "INSERT INTO pen (nama_pen, harga, image, ID_jenis)
        VALUES ('$nama_pen', '$harga', '$escapedImageData', '$nama_jenis')";

// Execute the query
if(mysqli_query($conn, $sql)) {
    // Redirect back to the form page
    header("Location: senarai.php");
    exit;
}
}
?>
<html>
<head>
    <title>Main</title>
</head>
<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="formkone.css">
<body>

<div class="container">
  <!-- The banner row -->
  <div class="banner">
  <img src="banner.jpg" alt="Banner Image"></img>
    <!-- topnav -->
    <div class="topnav">
    <a href="main page admin.php">UTAMA</a>
    <a href="import.php">IMPORT JENIS</a>
    <a href="Senarai.php">SENARAI ITEM</a>
    <a href="laporan.php">LAPORAN</a>  
    <a href="keluar.php" style="float: right;">KELUAR</a>      
  </div> 
  </div>

  <!-- The left column -->
  <div class="column-left">
  </div>
  <!-- The right column -->
  <div class="column-right">
  <form method="post" enctype="multipart/form-data">
  <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;-webkit-text-fill-color: blue;">BORANG TAMBAH PEN</h1>

    <label for="nama_pen">Nama Pen:</label><br>
    <input type="text" id="nama_pen" name="nama_pen" ><br>
    <label for="harga">Harga:</label><br>
    <input type="text" id="harga" name="harga" ><br>
    <label for="image">Gambar:</label><br>
    <input type="file" id="image" name="image"><br>
    <label for="nama_jenia"></label><br>
    <select id="nama_jenia" name="nama_jenis">
        <?php
        // query the database to get the pen types
        $sql = "SELECT*FROM jenis";
        $result = mysqli_query($conn, $sql);

        
        while ($jenis = mysqli_fetch_assoc($result)) {
            $selected = $jenis['ID_jenis'] == $row['ID_jenis'] ? 'selected' : '';
            echo "<option value=\"{$jenis['ID_jenis']}\" $selected>{$jenis['nama_jenia']}</option>";
        }
        ?>
    </select><br><br>
    <input type="submit" name="add" value="TAMBAH">
</form>
  </div>  
 
</div>
</body>
</html>

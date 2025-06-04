<?php
// include the session.php file
include 'session.php';
include 'dbcon.php';
// Retrieve product ID from query string
if (isset($_POST['ID_pen'])) {
  $ID_pen = $_POST['ID_pen'];

  // Query database to retrieve product information
  $stmt = $conn->prepare("SELECT * FROM pen WHERE ID_pen = ?");
  $stmt->bind_param("i", $ID_pen);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $stmt->close();
}
if (isset($_POST['update'])) {

  if (isset($_POST['nama_pen']) && isset($_POST['onama_pen'])) {
      $ID_pen = $_POST['ID_pen'];
      $nama_pen = $_POST['nama_pen'];
      $original_nama_pen = $_POST['onama_pen'];
    
      // Compare the original and new values
      if ($nama_pen !== $original_nama_pen) {
         // Update the value in the database
         $sql = "UPDATE pen SET nama_pen = ? WHERE ID_pen = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("ss", $nama_pen, $ID_pen);
         $stmt->execute();
      }
    }
    if (isset($_POST['harga']) && isset($_POST['oharga'])) {
      $ID_pen = $_POST['ID_pen'];
      $harga = $_POST['harga'];
      $original_harga = $_POST['oharga'];
    
      // Compare the original and new values
      if ($harga !== $original_harga) {
         // Update the value in the database
         $sql = "UPDATE pen SET harga = ? WHERE ID_pen = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("ss", $harga, $ID_pen);
         $stmt->execute();
      }
    }

    // Check if the 'image' file is uploaded and the 'ID_pen' value is set
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 ) {
      $ID_pen = $_POST['ID_pen'];
      $image = $_FILES['image'];
      $original_image_name = $_POST['oimage'];
    
      // Validate and process the uploaded image
      // ...
    
      // Compare the original and new values
      if ($image !== $original_image_name) {
          // Update the value in the database
          $sql = "UPDATE pen SET image = ? WHERE ID_pen = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("ss", $image_data, $ID_pen);

          // Read the image data from the file
          $image_data = file_get_contents($image['tmp_name']);

          // Execute the query
          $stmt->execute();
      }
    }      
 // Check if the 'nama_jenis' and 'original_nama_jenis' values are set
if (isset($_POST['nama_jenis']) && isset($_POST['ojenis'])) {
  $ID_pen = $_POST['ID_pen'];
  $nama_jenis = $_POST['nama_jenis'];
  $original_nama_jenis = $_POST['ojenis'];

  // Compare the original and new values
  if ($nama_jenis !== $original_nama_jenis) {
     // Update the value in the database
     $sql = "UPDATE pen SET ID_jenis = ? WHERE ID_pen = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("ss", $nama_jenis, $ID_pen);
     $stmt->execute();
  }
}

  // Redirect back to the form page
header("Location: senarai.php");
exit;

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
  <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;-webkit-text-fill-color: blue;">BORANG KEMASKINI PEN</h1>
    <input type="hidden" name="ID_pen" value="<?php echo $row['ID_pen']; ?>">
    <input type="hidden" name="onama_pen" value="<?php echo $row['nama_pen']; ?>">
    <input type="hidden" name="oharga" value="<?php echo $row['harga']; ?>">
    <input type="hidden" name="ojenis" value="<?php echo $row['ID_jenis']; ?>">
    <input type="hidden" name="oimage" value="<?php echo base64_encode($row['image']); ?>">

    <label for="nama_pen">Nama Pen:</label><br>
    <input type="text" id="nama_pen" name="nama_pen" value="<?php echo $row['nama_pen']; ?>"><br>
    <label for="harga">Harga:</label><br>
    <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>"><br>
    <label for="image">Gambar:</label><br>
    <input type="file" id="image" name="image"><br>
    <label for="nama_jenia">Jenis:</label><br>
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
    <input type="submit" name="update" value="kemaskini">
</form>
  </div>  
 
</div>
</body>
</html>

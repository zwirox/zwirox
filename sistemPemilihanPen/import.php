<?php
// include the session.php file
include 'session.php';
include 'dbcon.php';
if (isset($_POST['delete'])) {
  $pen_id = $_POST['pen_id'];
  $sql = "DELETE FROM jenis WHERE ID_jenis = '$pen_id'";
  mysqli_query($conn, $sql);
  // redirect to the same page to refresh the table
  header("Location: import.php");
  exit();
}

// check if the form has been submitted
if(isset($_POST["submit"])){
  // get the uploaded file
  $file = $_FILES['file']['tmp_name'];
  
  // open the file for reading
  $handle = fopen($file, "r");
  $c = 0;
  
  // loop through each row in the file
  while(($csvData = fgetcsv($handle, 1000, ",")) !== false){
      // extract the data from the row
      $ID_jenis = $csvData[0];
      $nama_jenis = $csvData[1];
      
      // insert the data into the database
      $sql = "INSERT INTO jenis (ID_jenis, nama_jenia) VALUES ('$ID_jenis', '$nama_jenis')";
      $result = mysqli_query($conn, $sql);
      
      // check if the insert was successful
      if($result){
          // show success message in an alert box
          echo "<script>alert('$ID_jenis berjaya ditambah');</script>";
      } else {
          // show error message in an alert box
          echo "<script>alert('$ID_jenis tidak dapat ditambah: " . mysqli_error($conn) . "');</script>";
      }
      
      $c++;
  }
  
  // close the file handle
  fclose($handle);
}
?>
<html>
<head>
    <title>Main</title>
</head>
<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="radio.css">
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
    <!-- The import form -->
    <h2>Import Jenis</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <input type="submit" name="submit" value="Import">
            </form>
            <!-- The table of items -->
             <h2>Senarai Jenis</h2>
             <table>
                 <thead>
                     <tr>
                         <th>ID Jenis</th>
                         <th>Nama Jenis</th>
                         <th>Tindakan</th>
                     </tr>
                 </thead>
                 <tbody>
                 <?php
                 // select all items from the jenis table
                 $sql = "SELECT * FROM jenis ";
                 $result = mysqli_query($conn, $sql);
             
                 // loop through each item and display it in a row
                 while($row = mysqli_fetch_assoc($result)){
                     echo "<tr>";
                     echo "<form method=\"post\">";
                     echo "<td>" . $row['ID_jenis'] . "</td>";
                     echo "<td>" . $row['nama_jenia'] . "</td>";
                     echo "<td><input type=\"hidden\" name=\"pen_id\" value=\"" . $row['ID_jenis'] . "\"/>";
                     echo "<input type=\"submit\" name=\"delete\" value=\"padam\"/></td>";
                     echo "</form>";
                     echo "</tr>";
                 }
                 ?>
             </tbody>
             </table>
  </div>  
</div>
</body>
</html>

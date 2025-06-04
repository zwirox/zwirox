<?php
// include the session.php file
include 'session.php';
include 'dbcon.php';
if (isset($_POST['delete'])) {
    $pen_id = $_POST['pen_id'];
    $sql = "DELETE FROM pen WHERE ID_pen = '$pen_id'";
    mysqli_query($conn, $sql);
    // redirect to the same page to refresh the table
    header("Location: Senarai.php");
    exit();
  }
?>
<!DOCTYPE html>
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
    <a href="import.php">IMPORT JENIS</a>
    <a class="active" href="Senarai.php">SENARAI ITEM</a>
    <a href="laporan.php">LAPORAN</a>      
    <a href="keluar.php" style="float: right;">KELUAR</a> 
  </div> 
  </div>
  <!-- The left column -->
  <div class="column-left">
    <div class="forma">
    <form method="post">
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
    <form action="add.php">
    <input type="submit" name="submit" value="TAMBAH">
  </form>
  </div>
  </div>
  <!-- The right column -->
  <div class="column-right">
  <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;-webkit-text-fill-color: blue;">SENARAI PRODUK</h1>
         <table>
             <tr>
                 <th>GAMBAR</th>
                 <th>NAMA</th>
                 <th>HARGA</th>
                 <th>TINDAKAN</th>
             </tr>
             <?php
             // Set default pen type
             $pen_type = "";

             // Check if a pen type was selected
             if (isset($_POST['nama_jenia'])) {
                 $pen_type = $_POST['nama_jenia'];
             }

             // Generate SQL query based on selected pen type
             if ($pen_type != "") {
                 $sql = "SELECT * FROM jenis AS table1 INNER JOIN pen AS table2 ON table1.ID_jenis = table2.ID_jenis WHERE table1.nama_jenia = '$pen_type' ORDER BY table1.nama_jenia ASC;";
             } else {
                 $sql = "SELECT * FROM pen";
             }

             // retrieve products from the database based on the SQL query
             $result = mysqli_query($conn, $sql);

             // loop through the products and display them in a table
             while ($row = mysqli_fetch_assoc($result)) {
             ?>
             <tr>
               <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" alt="<?php echo $row['nama_pen']; ?>"></td>
               <td><?php echo $row['nama_pen']; ?></td>
               <td><?php echo $row['harga']; ?></td>

               
               <form method="post" action="update.php">
               <input type="hidden" name="ID_pen" value="<?php echo $row['ID_pen']; ?>">
               <td><input type="submit" value="kemaskini" /></td>
               </form>



               <form method="post">
               <input type="hidden" name="pen_id" value="<?php echo $row['ID_pen']; ?>">
               <td><input type="submit" name="delete" value="padam"/></td>
               </form>
               </td>
             </tr>
             <?php } ?>
         </table>
  </div>  
 
</div>
</body>
</html>

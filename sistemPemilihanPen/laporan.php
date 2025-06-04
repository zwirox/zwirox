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
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="form.css">
<link rel="stylesheet" href="print.css" media="print">

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
    <a class="active" href="laporan.php">LAPORAN</a>  
    <a href="keluar.php" style="float: right;">KELUAR</a>     
  </div> 
  </div>

  <!-- The left column -->
  <div class="column-left">
  <div class="form">
        <form method="post"> 
            <input type="text" id="sp" name="sp" placeholder="mencari ikut nama pen">
            <input type="submit" value="CARI PEN"><br>

            <input type="text" id="sh" name="sh" placeholder="mencari ikut harga">
            <input type="submit" value="CARI HARGA"><br>

            <select id="sj" name="sj">
                <?php
                // query the database to get the pen types
                $sql = "SELECT*FROM jenis";
                $result = mysqli_query($conn, $sql);

        
                while ($jenis = mysqli_fetch_assoc($result)) {
                    $selected = $jenis['ID_jenis'] == $row['ID_jenis'] ? 'selected' : '';
                    echo "<option value=\"{$jenis['ID_jenis']}\" $selected>{$jenis['nama_jenia']}</option>";
                }
                ?>
            </select>
            <br><input type="submit" value="CARI JENIS"><br><br>
            <input type="submit" name="ss" value="PAPAR SEMUA">
        </form>
  </div>
  </div>
  <!-- The right column -->
  <div class="column-right">
      
        <table>
             <tr>
                 <th>Gambar</th>
                 <th>Nama</th>
                 <th>Harga</th>
                 <th>Jenis</th>
                 <th>Pengguna</th>

             </tr>
             <?php
             // Set default 
             $carip = "";
             $carih = "";
             $carij = "";
             

             // Check if a pen type was selected
             if (isset($_POST['sp'])) {
                 $carip = $_POST['sp'];
             }
             if (isset($_POST['sj'])) {
                $carij = $_POST['sj'];
            }
            if (isset($_POST['sh'])) {
                $carih = $_POST['sh'];
            }
            if (isset($_POST['ss'])) {
                $carip = "";
                $carih = "";
                $carij = "";
            }

             // Generate SQL query based on selected pen type
             if ($carip != "") {
                echo"Laporan berdasarkan carian: ",$carip;
                 $sql = "SELECT * FROM jenis AS table1 INNER JOIN pen AS table2 ON table1.ID_jenis = table2.ID_jenis WHERE table2.Nama_pen LIKE '%$carip%' ORDER BY table2.nama_pen ASC;";

             }
            else if ($carih != "") {
                echo"Laporan berdasarkan carian: ",$carih;
                $sql = "SELECT * FROM jenis AS table1 INNER JOIN pen AS table2 ON table1.ID_jenis = table2.ID_jenis WHERE table2.harga LIKE '%$carih%' ORDER BY table2.nama_pen ASC;";
            }
            else if ($carij != "") {
                $cari="SELECT nama_jenia FROM jenis WHERE ID_jenis='{$carij}'";
                $hi = mysqli_query($conn,$cari);
                // Check if the query was successful
                if ($hi) {
                    // Fetch the data from the result set
                    $hii = mysqli_fetch_assoc($hi);

                    // Output the data to the page
                    echo "Laporan berdasarkan carian: " . $hii['nama_jenia'];
                } 
                $sql = "SELECT * FROM jenis AS table1 INNER JOIN pen AS table2 ON table1.ID_jenis = table2.ID_jenis WHERE table2.ID_jenis = '$carij' ORDER BY table2.nama_pen ASC;";

            }
             else {
                echo"Laporan";
                 $sql = "SELECT * FROM jenis AS table1 INNER JOIN pen AS table2 ON table1.ID_jenis = table2.ID_jenis ORDER BY table2.nama_pen ASC;";

             }

             // retrieve products from the database based on the SQL query
             $result = mysqli_query($conn, $sql);

             // loop through the products and display them in a table
             while ($row = mysqli_fetch_assoc($result)) {
                    $count ="SELECT COUNT(ID_pengguna) FROM pemilihan WHERE ID_pen = '{$row['ID_pen']}';";
                    /// execute the count query and fetch the result
                   $countResult = mysqli_query($conn, $count);
                   $countRow = mysqli_fetch_array($countResult);
                   //echo"$count"
             ?>
             <tr>
               <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" alt="<?php echo $row['nama_pen']; ?>"></td>
               <td><?php echo $row['nama_pen']; ?></td>
               <td><?php echo $row['harga']; ?></td>
               <td><?php echo $row['nama_jenia'];?></td>
              <td><?php echo $countRow[0];?></td>
             </tr>
             <?php } ?>
         </table>
         <div class="button">
         <button onclick="window.print()">Print</button>
             </div>
  </div>  
 
</div>
</body>
</html>

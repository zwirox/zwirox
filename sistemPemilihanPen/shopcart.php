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
<link rel="stylesheet" href="print.css" media="print">
<link rel="stylesheet" type="text/css" href="formkone.css">
<body>

<div class="container">
  <!-- The banner row -->
  <div class="banner">
  <img src="banner.jpg" alt="Banner Image"></img>
    <!-- topnav -->
    <div class="topnav">
    <a href="main page user.php">UTAMA</a>
    <a href="kemaskiniAkaun.php">KEMASKINI AKAUN</a>
    <a href="pemilihan.php">PEMILIHAN</a>   
    <a class="active" href="shopcart.php">LAPORAN</a>
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
                <option value="">-----</option>
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
            <input type="submit" value="CARI JENIS"><br>
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

             // Generate SQL query based on selected pen type
             if ($carip != "") {
                echo"PEMILIHAN berdasarkan carian: ",$carip;
                 $sql = "SELECT * FROM pemilihan AS table1 
                 INNER JOIN pen AS table2 ON table1.ID_pen = table2.ID_pen 
                 INNER JOIN jenis AS table3 ON table2.ID_jenis = table3.ID_jenis 
                 INNER JOIN pengguna AS table4 ON table1.ID_pengguna = table4.ID_pengguna
                 WHERE table2.Nama_pen LIKE '%$carip%' AND table4.username = '{$_SESSION['username']}'  
                 ORDER BY table3.nama_jenia ASC;";
             }
            else if ($carih != "") {
                echo"PEMILIHAN berdasarkan carian: ",$carih;
                $sql = "SELECT * FROM pemilihan AS table1 
                INNER JOIN pen AS table2 ON table1.ID_pen = table2.ID_pen 
                INNER JOIN jenis AS table3 ON table2.ID_jenis = table3.ID_jenis 
                INNER JOIN pengguna AS table4 ON table1.ID_pengguna = table4.ID_pengguna
                WHERE table2.harga LIKE '%$carih%' AND table4.username = '{$_SESSION['username']}'  
                ORDER BY table3.nama_jenia ASC;";
            }
            else if ($carij != "") {
                $sql = "SELECT * FROM pemilihan AS table1 
                INNER JOIN pen AS table2 ON table1.ID_pen = table2.ID_pen 
                INNER JOIN jenis AS table3 ON table2.ID_jenis = table3.ID_jenis 
                INNER JOIN pengguna AS table4 ON table1.ID_pengguna = table4.ID_pengguna
                WHERE table2.ID_jenis LIKE '%$carij%' AND table4.username = '{$_SESSION['username']}'  
                ORDER BY table3.nama_jenia ASC;";
                $cari="SELECT nama_jenia FROM jenis WHERE ID_jenis='{$carij}'";
                                $hi = mysqli_query($conn,$cari);
                                // Check if the query was successful
                                if ($hi) {
                                    // Fetch the data from the result set
                                    $hii = mysqli_fetch_assoc($hi);
                
                                    // Output the data to the page
                                    echo "PEMILIHAN: " . $hii['nama_jenia'];
                                } 
            }
            
             else {
                $sql = "SELECT * FROM pemilihan AS table1 
                 INNER JOIN pen AS table2 ON table1.ID_pen = table2.ID_pen 
                 INNER JOIN jenis AS table3 ON table2.ID_jenis = table3.ID_jenis 
                 INNER JOIN pengguna AS table4 ON table1.ID_pengguna = table4.ID_pengguna 
                 WHERE table4.username = '{$_SESSION['username']}'
                 ORDER BY table3.nama_jenia ASC;";
                 echo"PEMILIHAN";
             }
             //echo"$sql";
             // retrieve products from the database based on the SQL query
             $result = mysqli_query($conn, $sql);

             // loop through the products and display them in a table
             while ($row = mysqli_fetch_assoc($result)) {
             ?>
             <tr>
               <td><img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" alt="<?php echo $row['nama_pen']; ?>"></td>
               <td><?php echo $row['nama_pen']; ?></td>
               <td><?php echo $row['harga']; ?></td>
               <td>
                <?php echo $row['nama_jenia'];?></td>
             </tr>
             <?php } ?>
         </table>
         <div class="button">
         <button onclick="window.print()">Cetak</button>
             </div>
  </div>  
 
</div>
</body>
</html>


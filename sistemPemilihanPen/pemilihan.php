<?php
// include the session.php file
include 'session.php';
include 'dbcon.php';
if (isset($_POST['pilih'])) {
  // Retrieve values from form or query string
  $ID_pen = $_POST['ID_pen'];
  $username= $_SESSION['username'];

  // Retrieve ID_pengguna from the database based on the logged-in user's username
  $stmt = $conn->prepare("SELECT ID_pengguna FROM pengguna WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $result->num_rows > 0) {
    // Fetch the first row of the result set and extract the ID_pengguna value
    $row = $result->fetch_assoc();
    $ID_pengguna = $row['ID_pengguna'];
  } else {
    // Handle the case where no matching user was found
    // For example, redirect the user to an error page
    exit("No matching user found.");
  }

  $ID_admin = 1; // Replace with actual ID of admin

  // Prepare SQL statement
  $stmt = $conn->prepare("INSERT INTO pemilihan (ID_pen, ID_pengguna, ID_admin) VALUES (?, ?, ?)");
  $stmt->bind_param("sii", $ID_pen, $ID_pengguna, $ID_admin);
  $stmt->execute();
  $stmt->close();
}

?>
<html>
<head>
    <title>Main</title>
</head>
<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="card.css">
<link rel="stylesheet" type="text/css" href="form.css">
<body>

<div class="container">
  <!-- The banner row -->
  <div class="banner">
  <img src="banner.jpg" alt="Banner Image"></img>
    <!-- topnav -->
    <div class="topnav">
    <a href="main page user.php">UTAMA</a>
    <a href="kemaskiniAkaun.php">KEMASKINI AKAUN</a>
    <a class="active" href="pemilihan.php">PEMILIHAN</a>    
    <a href="shopcart.php">LAPORAN</a>
    <a href="keluar.php" style="float: right;">KELUAR</a>
  </div> 
  </div>

  <!-- The left column -->
  <div class="column-left">
    <div class="form">
  <form method="post">
  <h2 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;-webkit-text-fill-color: blue;">CARI</h2>
  <input type="text" id="sp" name="sp" placeholder="mencari ikut nama pen">
            <input type="submit" value="CARI PEN"><br>

            <input type="text" id="sh" name="sh" placeholder="mencari ikut harga">
            <input type="submit" value="CARI HARGA"><br>
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
  <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;-webkit-text-fill-color: blue;">  SENARAI PRODUK</h1>
            <div class="product-list">
                <?php
                // Set default pen type
                $pen_type = "";
                // Set default 
             $carip = "";
             $carih = "";

             

             // Check if a pen type was selected
             if (isset($_POST['sp'])) {
                 $carip = $_POST['sp'];
             }
            if (isset($_POST['sh'])) {
                $carih = $_POST['sh'];
            }
            if (isset($_POST['ss'])) {
                $carip = "";
                $carih = "";
                $pen_type = "";
            }
            // Check if a pen type was selected
            if (isset($_POST['nama_jenia'])) {
              $pen_type = $_POST['nama_jenia'];
          }

             // Generate SQL query based on selected pen type
             if ($carip != "") {
                 $sql = "SELECT * FROM jenis AS table1 INNER JOIN pen AS table2 ON table1.ID_jenis = table2.ID_jenis WHERE table2.Nama_pen LIKE '%$carip%' ORDER BY table1.nama_jenia ASC;";
             }
            else if ($carih != "") {
                $sql = "SELECT * FROM jenis AS table1 INNER JOIN pen AS table2 ON table1.ID_jenis = table2.ID_jenis WHERE table2.Harga LIKE '%$carih%' ORDER BY table1.nama_jenia ASC;";
            }

                // Generate SQL query based on selected pen type
                else if ($pen_type != "") {
                    $sql = "SELECT * FROM jenis AS table1 INNER JOIN pen AS table2 ON table1.ID_jenis = table2.ID_jenis WHERE table1.nama_jenia = '$pen_type' ORDER BY table1.nama_jenia ASC;";
                } else {
                    $sql = "SELECT * FROM pen";
                }

                // retrieve products from the database based on the SQL query
                $result = mysqli_query($conn, $sql);

                // loop through the products and display them in product cards
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="card">
                    <img src="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" alt="<?php echo $row['nama_pen']; ?>">
                    <h2 style="  -webkit-text-fill-color: blue;"><?php echo $row['nama_pen'] ?></h2>
              <p style="  -webkit-text-fill-color: blue;">HARGA: <?php echo $row['harga']; ?></p>
              <form method="post" class="no-style">
                <input type="hidden" name="ID_pen" value="<?php echo $row['ID_pen']; ?>">
                <input type="submit" name="pilih" value="PILIH" >
              </form>
            </div>
            <?php } ?>

  </div>  
 
</div>
</body>
</html>

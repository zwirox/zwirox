<?php
// include the session.php file
include 'session.php';
include 'dbcon.php';

if (isset($_POST['update'])) {

  if (isset($_POST['username']) && isset($_POST['ousername'])) {

      $username = $_POST['username'];
      $original_username = $_POST['ousername'];
    
      // Compare the original and new values
      if ($username !== $original_username) {
         // Update the value in the database
         $sql = "UPDATE pengguna SET username = ? WHERE username = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("ss", $username, $original_username);
         $stmt->execute();
      }
    }
    if (isset($_POST['password_']) && isset($_POST['opassword_'])) {
      $original_username = $_POST['ousername'];
      $password_ = $_POST['password_'];
      $original_password_ = $_POST['opassword_'];
    
      // Compare the original and new values
      if ($password_ !== $original_password_) {
         // Update the value in the database
         $sql = "UPDATE pengguna SET password_ = ? WHERE username = ?";
         $stmt = $conn->prepare($sql);
         $stmt->bind_param("ss", $password_, $original_username);
         $stmt->execute();
      }
    }


  // Redirect back to the form page
header("Location: main page user.php");
exit;

}
?>
<html>
<head>
    <title>Main</title>
</head>
<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="formktwo.css">
<link rel="stylesheet" type="text/css" href="radio.css">
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
  <div class="form">
  <form method="post" >
            <input type="hidden" name="ousername" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" name="opassword_" value="<?php echo $_SESSION['password_']; ?>">
            <label for="username">Nama:</label><br>
            <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>"><br>
            <label for="password_">Kata Laluan:</label><br>
            <input type="text" id="password_" name="password_" value="<?php echo $_SESSION['password_']; ?>"><br>
            <input type="submit" name="update" value="kemaskini">
        </form>
  </div>
  </div>  
 
</div>
</body>
</html>

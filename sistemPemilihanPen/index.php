<?php
// establish a database connection
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'pen';

$conn = mysqli_connect($servername, $username, $password, $dbname);

// check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // retrieve the username and password from the form data
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check the id is admin or user
  $pengguna = mysqli_query($conn,"SELECT * FROM pengguna WHERE username = '$username' AND password_ = '$password'");
  $admin = mysqli_query($conn,"SELECT * FROM admin_ WHERE username = '$username' AND password_ = '$password'");

  //User login
  if(mysqli_num_rows($pengguna) > 0){
    $row = mysqli_fetch_assoc($pengguna);

    if($row['username'] === $username && $row['password_'] === $password){
      session_start();
      $_SESSION['username'] = $row['username'];
      $_SESSION['password_'] = $row['password_'];
      echo '<script>alert("Tahniah,anda telah berjaya log masuk!"); window.location.href = "main page user.php";</script>';

    }else{
      echo "<script> alert('sila masukkan kata laluan anda');</script>";
    }

  }elseif(mysqli_num_rows($admin) > 0){
    //admin login
    $row = mysqli_fetch_assoc($admin);

    if($row['username'] === $username && $row['password_'] === $password){
      session_start();
      $_SESSION['username'] = $row['username'];
      $_SESSION['password_'] = $row['password_'];
      echo '<script>alert("Tahniah,anda telah berjaya log masuk!"); window.location.href = "main page admin.php";</script>';

    }else{
      echo "<script> alert('sila masukkan kata laluan anda');</script>";
    }
  }else{
    echo "<script> alert('sila masukkan kata laluan anda');</script>";
  }
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
  <title>Page Title</title>

</head>
<link rel="stylesheet" type="text/css" href="index.css">
<body>
  <div class="container">
  <!-- Banner row -->
  <div class="toppane">
    <img src="banner.jpg" alt="Banner Image">
  </div>

    <!-- Right column -->
    <div class="middlepane">
    <button id="color-button" class="toggle">TUKAR WARNA</button>

      <div class="login-box">
        <form method="post" action="">
          <h2>LOG MASUK</h2>
          <label for="username">NAMA:</label>
          <input type="text" id="username" name="username" placeholder="zhe whuai" pattern="([A-Za-z ]{1,})"  
          oninvalid="setCustomValidity(this.validity.valueMissing ? 'Sila masukkan nama anda' :
           'Nama anda tidak boleh mengandungi nombor')" oninput="setCustomValidity('')">
         
          <label for="password">KATA LALUAN:</label>
          <input type="password" id="password" name="password" placeholder="123456" pattern="([0-9A-Za-z ]{4,20})" 
          oninvalid="setCustomValidity(this.validity.valueMissing ? 'sila massukkan kata laluan anda' :
           'Kata Laluan mesti mengandungi minimum 6 aksara,maximum 20 aksara dan hanya mengandungi huruf, nombor, dan ruang sahaja.')" 
           oninput="setCustomValidity('')">
          <div id="lower">
            <a href="daftar.php">Daftar</a><br>
            <input type="submit" value="Login">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
<script>
    var button = document.getElementById("color-button");
    var middlepane = document.querySelector('.middlepane');

    function toggleBackgroundColor() {
        if (button.classList.contains("yellow")) {
            button.classList.remove("yellow");
            button.classList.add("red");
            middlepane.style.backgroundColor = "yellow";
        } else if (button.classList.contains("red")) {
            button.classList.remove("red");
            button.classList.add("green");
            middlepane.style.backgroundColor = "red";
        } else if (button.classList.contains("green")) {
            button.classList.remove("green");
            button.classList.add("blue");
            middlepane.style.backgroundColor = "green";
        } else if (button.classList.contains("blue")){
            button.classList.remove("blue");
            button.classList.add("yellow");
            middlepane.style.backgroundColor = "blue";
        } else {
            button.classList.remove("blue");
            button.classList.add("yellow");
            middlepane.style.backgroundColor = "blue";
        }    
    }

    button.addEventListener("click", toggleBackgroundColor);
</script>
</html>

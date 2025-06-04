<?php
// include the session.php file
include 'dbcon.php';

?>
<!DOCTYPE html>
<html>

<head>
  <title>Page Title</title>
</head>
<link rel="stylesheet" type="text/css" href="daftar.css">
<body>
  <div class="container">
  <!-- Banner row -->
  <div class="toppane">
    <img src="banner.jpg" alt="Banner Image">
  </div>

    <!-- Right column -->
    <div class="middlepane">

      <div class="login-box">
        <form method="post" action="register.php" >
          <h2>Register</h2>
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" placeholder="zhe whuai" pattern="([A-Za-z ]{1,})" 
          oninvalid="setCustomValidity(this.validity.valueMissing ? 'Sila masukkan nama anda' : 
          'Nama anda tidak boleh mengandungi nombor')" 
          oninput="setCustomValidity('')">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" placeholder="123456" pattern="([1-9A-Za-z ]{6,20})" 
          oninvalid="setCustomValidity(this.validity.valueMissing ? 'Sila masukkan Kata Laluan anda' : 
          'Kata Laluan mesti mengandungi minimum 6 aksara,maximum 20 aksara dan hanya mengandungi huruf, nombor, dan ruang sahaja.')" oninput="setCustomValidity('')">
          <label for="confirm_password">Confirm Password:</label>
          <input type="password" id="confirm_password" name="confirm_password" placeholder="123456" pattern="([1-9A-Za-z ]{6,20})" 
          oninvalid="setCustomValidity(this.validity.valueMissing ? 'Sila memasti Kata Laluan anda sekali lagi' : 
          'Kata laluan anda tidak sama')" oninput="setCustomValidity('')">
          <div id="lower">
            <button type="submit" name="register_btn">Register</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>

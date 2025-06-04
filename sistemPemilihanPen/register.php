<?php
session_start();
$username = "";
$role = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'pen');

// Check connection
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

// REGISTER USER
if (isset($_POST['register_btn'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $confirm_password = mysqli_real_escape_string($db, $_POST['confirm_password']);
  // check if password and confirm password match
if ($password != $confirm_password) {
  array_push($errors, "The two passwords do not match");
}
  // register user if there are no errors
  if (count($errors) == 0) {
    $query = "INSERT INTO pengguna (username, password_) VALUES('$username', '$password')";
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "Tahniah,anda telah berjaya daftar!";
    echo '<script>alert("Tahniah,anda telah berjaya daftar!"); window.location.href = "index.php";</script>';
  }
  if (count($errors) == 1) {
    $error_message = implode("\n", $errors);
    echo "<script>alert('".$error_message."'); window.location = 'daftar.php';</script>";

    
  }

}
?>

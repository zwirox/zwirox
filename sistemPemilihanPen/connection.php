<?php
session_start();
$conn = new mysqli("localhost", "root", "", "sistem-pemilihan-komputer-riba");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//login check
if (!(isset($_SESSION['user']) || isset($_SESSION['admin'])) && (basename($_SERVER['PHP_SELF'], '.php') != 'login') && (basename($_SERVER['PHP_SELF'], '.php') != 'index') && (basename($_SERVER['PHP_SELF'], '.php') != 'mendaftar')) {
  echo "<script>alert('Sila log masuk.')</script><meta http-equiv='refresh' content='0; url=login.php'>"; // redirect to the login page
}

function isValidEmail($email) {
  // Regular expression tech I don't understand
  if (empty($email) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
    echo "<br><hr><span>Emel ini tidak sah.</span>";
    return false;
  } else {
    return true;
  }
}
?>
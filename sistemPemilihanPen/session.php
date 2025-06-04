<?php

if (session_status() == PHP_SESSION_NONE) {
  // Start a new session
  session_start();
}

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit();
}

?>

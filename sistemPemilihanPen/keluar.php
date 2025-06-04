<?php
// start the session
session_start();

// unset all session variables
$_SESSION = array();

// delete the session cookie
if (isset($_COOKIE[session_name()])) {
   setcookie(session_name(), '', time()-42000, '/');
}

// destroy the session
session_destroy();
?>
<html>
    <head>
        <title>main</title>
    </head>
     <style>
        .container {
        width: 100%;
        height: 100vh;
      }
      .toppane {
        width: 100%;
        height: 250px;
        background-color: #ffffff;
        border:1px solid black
      }
      .middlepane{
            background-image:url('wp1.png');
            background-attachment:fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .middlepane {
        width: 100%;
        height: 100vh;
        background-color: rgb(255, 255, 255);
        border:1px solid black
      } 
        
     </style>
    <body>
      <div class="container">
        <div class="toppane"><img src="banner.jpg" height="100%" width="100%"></img></div>
        <div class="middlepane" style="text-align: center;">
          <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;-webkit-text-fill-color: crimson;">=======================================</h1>
          <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">--TERIMA KASIH MENGGUNAKAN SISTEM INI--</h1>
        <h1 style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;-webkit-text-fill-color: crimson;">=======================================</h1>  
        <button onclick="location.href='index.php';">TERIMA KASIH</button>
        </div>
     </div>
    </body>
</html>



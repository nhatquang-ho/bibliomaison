<?php
session_start();
?>

<html>
<head>
<title>User Login</title>
<link rel="stylesheet" type="text/css" href="../css/mainpage.css">
</head>
<body>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

<form name="frmUser" method="post" action="" align="center">
<div class="error"><?php if($message!="") { echo $message; } ?></div>
<h3 align="center">Enter Login Details</h3>
 Username:<br>
 <input type="text" name="user_name">
 <br>
 Password:<br>
<input type="password" name="password">
<br><br>
<input type="submit" name="submit" value="Submit">
<a href="creatacc.php"><button type="button">Create your account</button></a>
</form>
   <center><p>default account -  tipou:tipou</p></center>
</body>
</html>

<?php

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

$message="";
#Connect to the database
if(isset($_POST['submit'])) {
   $con = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS'],$_ENV['DB_NAME']) or die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
   $db_selected = mysql_select_db($_ENV['DB_NAME'], $con) or die('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');

   #Check if username and password are correct
   $result = mysql_query("SELECT * FROM login_user WHERE user_name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'") or die ('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');;
   $row  = mysql_fetch_array($result);
   if(is_array($row)) {
      $_SESSION["name"] = $row['name'];
      $_SESSION["username"]=$row['user_name'];
   } else {
      $message = "Invalid Username or Password!";
      echo '<script>console.log("Username or password incorrect")</script>';
   }
}
if(isset($_SESSION["name"])) {
   echo '<script>window.top.location="../index.php";</script>';
}
?>
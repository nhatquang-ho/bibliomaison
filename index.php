<?php
session_start();
?>
<html>
<head>
<title>HOME PAGE</title>
<link rel="stylesheet" type="text/css" href="/css/mainpage.css">
</head>
<body>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<a href="/pages/options.php"><button type="button">Parameters</button></a>
  <hgroup>
   <h1>Home library</h1>
   <h2>Books App</h2>
  </hgroup>

    <menu>
      <li><a href="/pages/listBooks.php"><button type="button">List all books</button></a></li>
    </menu>

</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/footer.php";
?>

</html>


<?php
}else{
include $_SERVER['DOCUMENT_ROOT']."/include/start_page.php";
} 
?>


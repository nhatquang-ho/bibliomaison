<?php
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

#search and delete all books
$books = mysql_query("SELECT isbn,title,year FROM $name") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
while ($row = mysql_fetch_assoc($books)) {
  $isbn=$row["isbn"];
  $deleteallbooks = mysql_query('DELETE FROM '.$name.' WHERE isbn="'.$isbn.'"') or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
}


echo '<script>alert("All books deleted");</script>';
echo '<script>console.log("All books deleted")</script>';
echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/listBooks.php"} , 0);</script>';
?>
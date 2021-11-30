<?php #display chosen book
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

#get the book
$isbn = $_GET['isbn'];
$getbook = mysql_query("SELECT * FROM $name WHERE isbn='$isbn'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
$book = mysql_fetch_assoc($getbook);
if(!$book){
    #echo '<script>alert("Sách không tìm thấy");</script>';
    echo '<script>console.log("Book not found")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="javascript:history.go(-1)"} , 0);</script>';
}

$title = $book['title'];
$category = $book['category'];
$year = $book['year'];
$edition = $book['edition'];
$authors = $book['authors'];
$summary = $book['summary'];
$last_modification = $book['last_modification'];

?>
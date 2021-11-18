<?php #Add a new book
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

#set conditions for input values
$isbn=$title=$category=$year=$authors=$summary="";
$isbnErr=$titleErr=$yearErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn=$title=$year="";
    $isbnErr=$titleErr=$yearErr="";
    if (empty($_POST["year"])) {
        $year=NULL;
    } else {
        $year = $_POST["year"];
        // check year valid
        if (!preg_match("/^[0-9]*$/",$year) || (int)$year > (int)date("Y") || (int)$year <= 1900) {
        $yearErr = "incorrect year (1901 - ". date("Y") ." allowed)";
        }
    }
    if (empty($_POST["isbn"])) {
        $isbnErr = "ISBN is required";
    } else {
        $isbn = $_POST["isbn"];
        // check isbn valid
        if (!preg_match("/^[a-zA-Z0-9]*$/",$isbn)) {
        $isbnErr = "incorrect isbn";
        }
    }
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
    } else {
        $title = $_POST["title"];
    }
    if (empty($_POST["authors"])) {
        $authors="";
    } else {
        $authors = $_POST["authors"];
    }
    if (empty($_POST["summary"])) {
        $summary="";
    } else {
        $summary = $_POST["summary"];
    }
    if (empty($_POST["category"])) {
        $category="Unknown";
    } else {
        $category = $_POST["category"];
    }
}


#insert a new book
if(isset($_POST['creatbook']) && $isbnErr=="" && $yearErr=="" && $titleErr==""){
    
    include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

    #count books
    $count = mysql_query("SELECT COUNT(*) FROM $name");
    $count = mysql_fetch_assoc($count);
    $num = ((int)$count['COUNT(*)'])+1;

    $last_modification = date('Y-m-d H:i:s');

    #Check to see if the book wanted to add exists
    $existbook = mysql_query("SELECT isbn FROM $name where isbn='$isbn'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    if(mysql_fetch_assoc($existbook)){
        die('<script>alert("Book existed!");</script>');
        echo '<script>console.log("Book existed")</script>';
    }

    #add the book to the database
    $addbook = mysql_query("INSERT INTO $name(num,isbn,title,category,year,authors,summary,last_modification) VALUES('$num','$isbn','$title','$category','$year','$authors','$summary','$last_modification')") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

    echo '<script>alert("Your book is successfully added");</script>';
    echo '<script>console.log("Book added")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/listBooks.php"} , 0);</script>';
}
?>
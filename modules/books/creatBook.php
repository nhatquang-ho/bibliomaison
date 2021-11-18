<?php #Add a new book
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

#set conditions for input values
$isbn=$title=$year="";
$isbnErr=$titleErr=$yearErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn=$title=$year="";
    $isbnErr=$titleErr=$yearErr="";
    if (empty($_POST["year"])) {
        $yearErr = "Year is required";
    } else {
        $year = $_POST["year"];
        // check year valid
        if (!preg_match("/^[0-9]*$/",$year) || (int)$year > (int)date("Y") || (int)$year <= 1000) {
        $yearErr = "incorrect year (1000 - ". date("Y") ." allowed)";
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
    }
}


if(isset($_POST['creatbook']) && $isbnErr=="" && $yearErr=="" && $titleErr==""){
    
    include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

    #insert a new book
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $year = $_POST['year'];

    #Check to see if the book wanted to add exists
    $existbook = mysql_query("SELECT isbn FROM $name where isbn='$isbn'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    if(mysql_fetch_assoc($existbook)){
        die('<script>alert("Book existed!");</script>');
        echo '<script>console.log("Book existed")</script>';
    }

    #add the book to the database
    $addbook = mysql_query("INSERT INTO $name(isbn,title,year) VALUES('$isbn','$title','$year')") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

    echo '<script>alert("Your book is successfully added");</script>';
    echo '<script>console.log("Book added")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/listBooks.php"} , 0);</script>';
}
?>
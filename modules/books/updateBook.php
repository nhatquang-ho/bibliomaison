<?php #update a book
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

#set conditions for input values
$year="";
$yearErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn=$title=$year="";
    $isbnErr=$titleErr=$yearErr="";
    if (!empty($_POST["year"])) {
        $year = $_POST["year"];
        // check year valid
        if (!preg_match("/^[0-9]*$/",$year) || (int)$year > (int)date("Y") || (int)$year < 1000) {
        $yearErr = "incorrect year (1000 - ". date("Y") ." allowed)";
        }
    }
}

if(isset($_POST['updbook']) && $yearErr==""){
    include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $year = $_POST['year'];

    #get the book via isbn and update its information
    $update_book = mysql_query("UPDATE $name SET title='$title', year='$year' WHERE isbn='$isbn'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    echo '<script>alert("Your book is successfully updated");</script>';
    echo '<script>console.log("Book isgn-' . $isbn . ' created")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/listBooks.php"} , 0);</script>';
}
?>
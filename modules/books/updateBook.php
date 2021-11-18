<?php #update a book
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

#set conditions for input values
$year=$title="";
$yearErr=$titleErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn=$title=$year="";
    $isbnErr=$titleErr=$yearErr="";
    if (!empty($_POST["year"])) {
        $year = $_POST["year"];
        // check year valid
        if (!preg_match("/^[0-9]*$/",$year) || (int)$year > (int)date("Y") || (int)$year <= 1900) {
        $yearErr = "incorrect year (1901 - ". date("Y") ." allowed)";
        }
    }
    if (empty($_POST["title"])) {
        $titleErr = "Title is required";
    }
}

if(isset($_POST['updbook']) && $titleErr=="" && $yearErr==""){
    include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $year = $_POST['year'];
    $authors = $_POST['authors'];
    $summary = $_POST['summary'];

    $last_modification = date('Y-m-d H:i:s');

    #get the book via isbn and update its information
    $update_book = mysql_query("UPDATE $name SET title='$title', category='$category', year='$year', authors='$authors', summary='$summary', last_modification='$last_modification' WHERE isbn='$isbn'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    echo '<script>alert("Your book is successfully updated");</script>';
    echo '<script>console.log("Book isgn-' . $isbn . ' updated")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/listBooks.php"} , 0);</script>';
}
?>
<?php #update a book
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
    echo '<script>alert("Book not found");</script>';
    echo '<script>console.log("Book not found")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/listBooks.php"} , 0);</script>';
}

$title = $book['title'];
$category = $book['category'];
$year = $book['year'];
$edition = $book['edition'];
$authors = $book['authors'];
$summary = $book['summary'];


#set conditions for input values
$yearErr=$titleErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn=$title=$year="";
    $isbnErr=$titleErr=$yearErr="";
    if (!empty($_POST["year"])) {
        $year = $_POST["year"];
        // check year valid
        if (!preg_match("/^[0-9]*$/",$year) || (int)$year > (int)date("Y") || (int)$year <= 1900) {
        $yearErr = "Năm không hợp lệ (Chỉ cho phép từ 1901 đến ". date("Y") .")";
        }
    }
    if (empty($_POST["title"])) {
        $titleErr = "Vui lòng điền tựa đề sách";
    }
    if($_POST["category"] == "Khac"){
        if (empty($_POST["category-other"])) {
            $category="Unknown";
        }
        else {
            $category = $_POST["category-other"];
        }
    } else {
        $category = $_POST['category'];
    }
}

if(isset($_POST['updbook']) && $titleErr=="" && $yearErr==""){

    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $year = $_POST['year'];
    $edition = $_POST['edition'];
    $authors = $_POST['authors'];
    $summary = $_POST['summary'];

    $last_modification = date('Y-m-d H:i:s');

    #get the book via isbn and update its information
    $update_book = mysql_query("UPDATE $name SET title='$title', category='$category', year='$year', edition='$edition', authors='$authors', summary='$summary', last_modification='$last_modification' WHERE isbn='$isbn'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    echo '<script>console.log("Book isgn-' . $isbn . ' updated")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="javascript:history.go(-2)"} , 0);</script>';
}
?>
<?php #Add test books
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

$quantity = $_GET["quantity"];

for ($n = 0; $n < $quantity; $n++) {

    $count = mysql_query("SELECT COUNT(*) FROM $name");
    $count = mysql_fetch_assoc($count);

    $num = ((int)$count['COUNT(*)'])+1;
    $isbn = "testbook" . $num;
    $title = "Test Book Title " . $num;
    $category = "Unknown";
    $year = "2021";
    $edition = "Unknown";
    $authors = "[authors]";
    $summary = "This is the summary of testbook" .$num;
    $last_modification = date('Y-m-d H:i:s');


    #add the test book to the database
    $addbook = mysql_query("INSERT INTO $name(num,isbn,title,category,year,edition,authors,summary,last_modification) 
                            VALUES('$num','$isbn','$title','$category','$year','$edition','$authors','$summary','$last_modification')") 
                            or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
}

echo '<script>alert("Added!");</script>';
echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/listBooks.php"} , 0);</script>';
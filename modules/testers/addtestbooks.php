<?php #Add test books
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

#function return random string (isbn generator)
function generateRandomString($length) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$name=$_SESSION["username"];

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

$quantity = $_GET["quantity"];

for ($n = 0; $n < $quantity; $n++) {

    $isbn = generateRandomString(13) . $n;
    $title = "Test Book Title " . ($n + 1);
    $category = "Unknown";
    $year = "2021";
    $edition = "Unknown";
    $authors = "[authors]";
    $summary = "This is the summary of testbook" . ($n + 1);
    $last_modification = date('Y-m-d H:i:s');


    #add the test book to the database
    $addbook = mysql_query("INSERT INTO $name(isbn,title,category,year,edition,authors,summary,last_modification) 
                            VALUES('$isbn','$title','$category','$year','$edition','$authors','$summary','$last_modification')") 
                            or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
}

echo '<script>alert("Added!");</script>';
echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/listBooks.php"} , 0);</script>';
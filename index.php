<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>HOMEPAGE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

<?php
if($_SESSION["username"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

    <hgroup>
        <h1>Home library</h1>
        <h2>Feel free to add your books</h2>
    </hgroup>

    <menu>
        <li><a href="/pages/listBooks.php"><button type="button">List all books</button></a></li>
    </menu>

<?php
if($_SESSION["username"] == "tipou") {
?>
    <h2>For testers:</h2>
    <menu>
        <li><a href="/modules/testers/addtestbooks.php?quantity=10"><button type="button">Add 10 books</button></a></li>
        <li><a href="/modules/testers/addtestbooks.php?quantity=100"><button type="button">Add 100 books</button></a></li>
    </menu>

<?php
}
?>


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
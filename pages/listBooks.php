<?php
session_start();
?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>YOUR BOOKS</title>
</head>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<body>

<?php
if($_SESSION["name"]) {
?>

    <h1>Public Library: List all books</h1>

    <form action="" method="post">
        <input type="text" name="isbn">
        <input type="submit" name="search_isbn" value="Search book isbn">
        <input type="text" name="title">
        <input type="submit" name="search_name" value="Search book name">
    </form>

    <?php #display books table
    include $_SERVER['DOCUMENT_ROOT']."/modules/books/listBooks.php" 
    ?>

    <br>
    <a href="/pages/createBook.php"><button type="button">Add a new book</button></a>
    <a href="/modules/books/deleteAllBooks.php" onclick="return Confirm()"><button type="button">Delete all
            books</button></a>
    <br><br>
    <nav><a href="/index.php">Back to main menu</a></nav>

    <script type="text/javascript">
    function Confirm() {
        if (confirm('Do you want to delete all books?')) {
            return true;
        } else {
            return false;
        }
    }
    </script>

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
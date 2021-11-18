<?php include $_SERVER['DOCUMENT_ROOT']."/modules/books/creatBook.php" ?>

<html>

<head>
    <title>ADD BOOK</title>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
</head>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<body>

<?php
if($_SESSION["name"]) {
?>

    <h1>Public Library: Create a new book:</h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        <label>ISBN: <input type="text" name="isbn" /></label>
        <span class="error">* <?php echo $isbnErr;?></span>
        <br><br>
        <label>Title: <input type="text" name="title" /></label>
        <span class="error">* <?php echo $titleErr;?></span>
        <br><br>
        <label>Year: <input type="text" name="year" /></label>
        <span class="error">* <?php echo $yearErr;?></span>
        <br><br>
        <button type="submit" name="creatbook" value="submit">Save</button><br>
    </form>

    <nav><a href="/index.php">Back to main menu</a></nav>

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
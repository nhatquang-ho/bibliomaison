<?php include $_SERVER['DOCUMENT_ROOT']."/modules/books/updateBook.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>UPDATE_BOOK</title>
</head>

<body>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

    <h1>Public Library: Update a book record</h1>
    <form method="post" action="">
        <label>ISBN: <input type="text" name="isbn" readonly="readonly" value="<?php echo $_GET['isbn']; ?>" /></label>
        <br><br>
        <label>Title: <input type="text" name="title" value="<?php echo $_GET['title']; ?>" /></label>
        <br><br>
        <label>Year: <input type="text" name="year" value="<?php echo $_GET['year']; ?>" /></label>
        <span class="error"><?php echo $yearErr;?></span>
        <br><br>
        <button type="submit" name="updbook" value="submit">Save Changes</button>
    </form>

    <br>
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
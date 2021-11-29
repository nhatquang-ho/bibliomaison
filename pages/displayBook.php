<?php include $_SERVER['DOCUMENT_ROOT']."/modules/books/displayBook.php" ?>

<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>DISPLAY BOOK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<body>
    <h1>
        <a href="javascript:history.go(-1)"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        Book - ISBN: <?php echo $isbn; ?>
        <a href="/pages/listBooks.php?delbook=<?php echo $isbn; ?>" onclick="return ConfirmDeleteOne(<?php echo $isbn; ?>)"><input class="icon-button" type="image" src="/assets/images/delete.png" /></a>
        <a href="/pages/updateBook.php?isbn=<?php echo $isbn; ?>"><input class="icon-button" type="image" src="/assets/images/update.png" /></a>
    </h1>
    
    <h3>Title</h3>
    <p><?php echo $title; ?></p>
    <h3>Category</h3>
    <p><?php echo $category; ?></p>
    <h3>Year</h3>
    <p><?php echo $year; ?></p>
    <h3>Edition</h3>
    <p><?php if($edition!="") {echo $edition;} else {echo "Unknown";} ?></p>
    <h3>Author(s)</h3>
    <p><?php if($authors!="") {echo $authors;} else {echo "Unknown";} ?></p>
    <h3>Summary</h3>
    <p><?php if($summary!="") {echo $summary;} else {echo "No summary";} ?></p>
    <h3>Last modification</h3>
    <p><?php echo $last_modification; ?></p>


    <script>
        function ConfirmDeleteOne(isbn) {
        if (confirm('Do you want to delete this book? (ISBN: '+ isbn +')')) {
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
<?php
session_start();
?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>YOUR BOOKS</title>
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
        <a href="/index.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        List all books in your library
    </h1>

    <p><button id="show-search-form-button" onclick="ShowSearchForm()">Search Books v</button></p>
    <form id="search-form" style="display:none;" action="" method="post">
        <input type="text" name="isbn">
        <input type="submit" name="search_isbn" value="Search isbn">
        <br>
        <input type="text" name="title">
        <input type="submit" name="search_title" value="Search title">
        <br>
        <select name="category" onchange="otherCheck(this);">
            <option value="">--Choose a category--</option>
            <option value="Unknown">Unknown</option>
            <option value="Politics">Politics</option>
            <option value="Science - Economy">Science - Economy</option>
            <option value="Literature - Art">Literature - Art</option>
            <option value="Culture - Society - History">Culture - Society - History</option>
            <option value="Education">Education</option>
            <option value="Story, Novel">Story, Novel</option>
            <option value="Psychology, spirituality, religion">Psychology, spirituality, religion</option>
            <option value="Children">Children</option>
            <option value="Other">Other</option>
        </select>
        <input type="text" id="category-other" style="display:none;" name="category-other" maxlength="30" />
        <input type="submit" name="search_category" value="Search category">
    </form>

    <br>
    <a href="/pages/createBook.php"><button type="button">Add a new book</button></a>
    <a href="/modules/books/deleteAllBooks.php" onclick="return ConfirmDeleteAll()"><button type="button">Delete all books</button></a>
    <br>
    <p></p>
    
    <?php #display books table
    include $_SERVER['DOCUMENT_ROOT']."/modules/books/listBooks.php" 
    ?>

    <script type="text/javascript">
    function ConfirmDeleteAll() {
        if (confirm('Do you want to delete all books?')) {
            return true;
        } else {
            return false;
        }
    }
    function otherCheck(that){
            if(that.value == "Other"){
                var x = document.getElementById("category-other");
                x.style.display = "block";
            }
            else {
                var x = document.getElementById("category-other");
                x.style.display = "none";
            }
    }
    function ShowSearchForm() {
            var x = document.getElementById("search-form");
            if (x.style.display == "none"){
                x.style.display = "block";
                document.getElementById("show-search-form-button").innerHTML = "Search Books ᴧ";
            }
            else {
                x.style.display = "none";
                document.getElementById("show-search-form-button").innerHTML = "Search Books v";
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
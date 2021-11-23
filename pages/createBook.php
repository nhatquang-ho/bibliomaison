<?php include $_SERVER['DOCUMENT_ROOT']."/modules/books/creatBook.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>ADD BOOK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<body>

    <?php
if($_SESSION["name"]) {
?>

    <h1>Add a new book:</h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        <label>ISBN: <input type="text" name="isbn" maxlength="30" /></label>
        <span class="error">* <?php echo $isbnErr;?></span>
        <br><br>
        <label>Title: <input type="text" name="title" maxlength="50" /></label>
        <span class="error">* <?php echo $titleErr;?></span>
        <br><br>
        <label>Category:
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
        <input type="text" id="category-other" style="visibility:hidden;" name="category-other" maxlength="30" />
        </label>
        <br><br>
        <label>Year: <input type="text" name="year" maxlength="4" /></label>
        <span class="error"><?php echo $yearErr;?></span>
        <br><br>
        <label>Edition: <input type="text" name="edition" maxlength="30" /></label>
        <br><br>
        <label>Authors: <input type="text" name="authors" maxlength="50" /></label>
        <br><br>
        <label>Summary: <textarea name="summary" rows="5" cols="40" maxlength="1500"></textarea></label>
        <br><br>
        <input type="submit" name="creatbook" value="Save"><br>
    </form>

    <script>
        function otherCheck(that){
            if(that.value == "Other"){
                var x = document.getElementById("category-other");
                x.style.visibility = "visible";
            }
            else {
                var x = document.getElementById("category-other");
                x.style.visibility = "hidden";
            }
        }
    </script>

    <nav><a href="/pages/listBooks.php">Back to list books</a></nav>

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
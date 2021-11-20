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
        <select name="category">
            <option value="">--Choose a category--</option>
            <option value="Unknown">Unknown</option>
            <option value="Biographies and Memoirs">Biographies and Memoirs</option>
            <option value="Literature and Fiction">Literature and Fiction</option>
            <option value="Children's">Children's</option>
            <option value="Mystery and Suspense">Mystery and Suspense</option>
            <option value="Education and Reference">Education and Reference</option>
            <option value="Religion and Spirituality">Religion and Spirituality</option>
            <option value="History">History</option>
            <option value="Other">Other</option>
        </select>
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
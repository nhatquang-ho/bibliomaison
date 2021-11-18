<?php include $_SERVER['DOCUMENT_ROOT']."/modules/books/updateBook.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>UPDATE BOOK</title>
</head>

<body>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

    <h1>Public Library: Update a book</h1>
    <form method="post" action="">
        <label>ISBN: <input type="text" name="isbn" readonly="readonly" value="<?php echo $_GET['isbn']; ?>" /></label>
        <br><br>
        <label>Title: <input type="text" name="title" value="<?php echo $_GET['title']; ?>" maxlength="30" /></label>
        <span class="error"><?php echo $titleErr;?></span>
        <br><br>
        <label>Category:
        <select name="category">
            <option value="<?php echo $_GET['category']; ?>"><?php echo $_GET['category']; ?></option>
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
        <label>Year: <input type="text" name="year" value="<?php echo $_GET['year']; ?>"  maxlength="4" /></label>
        <span class="error"><?php echo $yearErr;?></span>
        <br><br>
        <label>Authors: <input type="text" name="authors" value="<?php echo $_GET['authors']; ?>" maxlength="50" /></label>
        <br><br>
        <label>Summary: <input type="text" name="summary" value="<?php echo $_GET['summary']; ?>" maxlength="200" /></label>
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
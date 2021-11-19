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
        <label>ISBN: <input type="text" name="isbn" readonly="readonly" value="<?php echo $isbn ?>" /></label>
        <br><br>
        <label>Title: <input type="text" name="title" value="<?php echo $title; ?>" maxlength="30" /></label>
        <span class="error"><?php echo $titleErr;?></span>
        <br><br>
        <label>Category:
        <select id="mySelect" name="category">
            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
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
        <label>Year: <input type="text" name="year" value="<?php echo $year; ?>"  maxlength="4" /></label>
        <span class="error"><?php echo $yearErr;?></span>
        <br><br>
        <label>Authors: <input type="text" name="authors" value="<?php echo $authors; ?>" maxlength="50" /></label>
        <br><br>
        <label>Summary: <textarea name="summary" rows="5" cols="40" maxlength="200"><?php echo $summary; ?></textarea></label>
        <br><br>
        <input type="submit" name="updbook" value="Save Changes">
    </form>

    <script>
        var selectobject = document.getElementById("mySelect");
        for (var i=1; i<selectobject.options.length; i++) {
            if (selectobject.options[i].value == "<?php echo $category; ?>")
                selectobject.removeChild(selectobject.options[i]);
        }
    </script>

    <br>
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
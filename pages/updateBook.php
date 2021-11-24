<?php include $_SERVER['DOCUMENT_ROOT']."/modules/books/updateBook.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>UPDATE BOOK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
        <label>Title: <input type="text" name="title" value="<?php echo $title; ?>" maxlength="50" /></label>
        <span class="error"><?php echo $titleErr;?></span>
        <br><br>
        <label>Category:
        <select id="mySelect" name="category" onchange="otherCheck(this);">
            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
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
        <label>Year: <input type="text" name="year" value="<?php echo $year; ?>"  maxlength="4" /></label>
        <span class="error"><?php echo $yearErr;?></span>
        <br><br>
        <label>Edition: <input type="text" name="edition" value="<?php echo $edition; ?>"  maxlength="30" /></label>
        <br><br>
        <label>Authors: <input type="text" name="authors" value="<?php echo $authors; ?>" maxlength="50" /></label>
        <br><br>
        <label>Summary: <textarea name="summary" rows="5" cols="40" maxlength="1500"><?php echo $summary; ?></textarea></label>
        <br><br>
        <input type="submit" name="updbook" value="Save Changes">
    </form>

    <script>
        var selectobject = document.getElementById("mySelect");
        for (var i=1; i<selectobject.options.length; i++) {
            if (selectobject.options[i].value == "<?php echo $category; ?>")
                selectobject.removeChild(selectobject.options[i]);
        }

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

    <br>
    <nav><a href="javascript:history.go(-1)">Back</a></nav>

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
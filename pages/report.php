<?php include $_SERVER['DOCUMENT_ROOT']."/modules/sendreport.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>REPORT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
$_SERVER["lang"] = "EN";
$path = "/vn" . $_SERVER['REQUEST_URI'];
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button"><b>EN</b> ↔ VN </button></a>
<br>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <h1>
        <a href="javascript:history.go(-1)"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        Please enter the information below
    </h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        Name: <input type="text" name="name" maxlength="30">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        E-mail: <input type="text" name="email" maxlength="30">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Comment: <textarea name="comment" rows="5" cols="40" maxlength="2000"></textarea>
        <span class="error">* <?php echo $commentErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Send">
    </form>

</body>

</html>
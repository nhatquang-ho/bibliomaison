<?php include $_SERVER['DOCUMENT_ROOT']."/modules/accounts/recoverPass.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>RECOVERY PASSWORD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
$path = "/vn" . $_SERVER['REQUEST_URI'];
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button"><b>EN</b> ↔ VN </button></a>
<br>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
    <br><br><br>
    <center>
    <h3>Please enter the information below to recover your password:</h3>
    <form name="frmUser" method="post" action="">
        Username:<br>
        <input id="username-input" type="text" name="username" maxlength="30"><br>
        <span class="error"><?php echo $usernameErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <a href="/pages/login.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>

    </center>
</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/footer.php";
?>

</html>
<?php include $_SERVER['DOCUMENT_ROOT']."/modules/accounts/creatAcc.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>SIGN UP</title>
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
        <a href="/pages/login.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        Fill the form below to create your account
    </h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        <label>Name: <input type="text" name="name" maxlength="30" /></label>
        <span class="error">* <?php echo $nameErr;?></span><br><br>
        <label>Username: <input type="text" name="username" maxlength="30"/></label>
        <span class="error">* <?php echo $usrnameErr;?></span><br><br>
        <label>Email: <input type="text" name="email" maxlength="30" /></label>
        <span class="error">* <?php echo $emailErr;?></span><br><br>
        <label>Language: 
            <input type="radio" id="lang-VN" name="language" value="VN" >
            <label for="lang-VN">Vietnamese</label>
            <input type="radio" id="lang-EN" name="language" value="EN" checked>
            <label for="lang-EN">English</label>
        </label>
        <br><br>
        <input type="submit" name="creatacc" value="Submit"></p>
    </form>

</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/footer.php";
?>

</html>
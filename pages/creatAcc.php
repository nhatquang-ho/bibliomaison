<?php include $_SERVER['DOCUMENT_ROOT']."/modules/accounts/creatAcc.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>SIGN UP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
$path = "/vn" . $_SERVER['REQUEST_URI'];
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button">EN ↔ VN </button></a>
<br>

<body>

    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <h1>Fill the form below to create your account</h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        <label>Name: <input type="text" name="name" maxlength="30" /></label>
        <span class="error">* <?php echo $nameErr;?></span><br><br>
        <label>Username: <input type="text" name="username" maxlength="30"/></label>
        <span class="error">* <?php echo $usrnameErr;?></span><br><br>
        <label>Email: <input type="text" name="email" maxlength="30" /></label>
        <span class="error">* <?php echo $emailErr;?></span><br><br>
        <label>Ngôn ngữ: 
            <input type="radio" name="language" value="VN" checked>
            <input type="radio" name="language" value="EN" >
        </label>
        <br><br>
        <input type="submit" name="creatacc" value="Submit"></p>
    </form>

    <nav><a href="/pages/login.php">Back to main menu</a></nav>

</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/footer.php";
?>

</html>
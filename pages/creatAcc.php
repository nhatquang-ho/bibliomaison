<?php include $_SERVER['DOCUMENT_ROOT']."/modules/accounts/creatAcc.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>SIGN UP</title>
</head>

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
        <input type="submit" name="creatacc" value="Submit"></p>
    </form>

    <nav><a href="/pages/login.php">Back to main menu</a></nav>

</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/footer.php";
?>

</html>
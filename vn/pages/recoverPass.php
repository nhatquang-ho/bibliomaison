<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/accounts/recoverPass.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>QUÊN MẬT KHẨU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
$path = substr($_SERVER['REQUEST_URI'],3);
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button">EN ↔ <b>VN</b> </button></a>
<br>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
    <br><br><br>
    <center>
    <h3>Điền thông tin bên dưới để khôi phục mật khẩu của bạn:</h3>
    <form name="frmUser" method="post" action="">
        Tên tài khoản:<br>
        <input id="username-input" type="text" name="username" maxlength="30"><br>
        <span class="error"><?php echo $usernameErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Xác nhận">
    </form>

    <a href="/vn/pages/login.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>

    </center>
</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/footer.php";
?>

</html>
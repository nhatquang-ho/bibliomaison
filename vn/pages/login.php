<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/accounts/logincheck.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>ĐĂNG NHẬP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
$_SERVER["lang"] = "VN";
$path = substr($_SERVER['REQUEST_URI'],3);
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button">EN ↔ <b>VN</b> </button></a>
<br>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <center>
    <h3>Đăng nhập</h3><br>
    <form name="frmUser" method="post" action="">
        <div class="error"><?php if($message!="") { echo $message; } ?></div>
        Tên tài khoản:<br>
        <input type="text" name="user_name" maxlength="30">
        <br>
        Mật khẩu:<br>
        <input type="password" name="password" id="myPassword" maxlength="30" >
        <br>
        <input type="checkbox" onclick="Show_Hide_Pass()">Hiện mật khẩu
        <br><br>
        <input type="submit" name="submit" value="Đăng nhập">
        <a href="/vn/pages/creatAcc.php"><button type="button">Đăng ký</button></a>
    </form>
        <a href="/vn/pages/recoverPass.php">Quên mật khẩu?</a>
        <p>Tài khoản mặc định - tipou:tipou</p>
    </center>
    
    <script>
        function Show_Hide_Pass() {
            var x = document.getElementById("myPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/footer.php";
?>

</html>
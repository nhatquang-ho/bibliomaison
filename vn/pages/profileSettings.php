<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/accounts/profileSettings.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>THÔNG TIN CÁ NHÂN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

<body>
    
    <h1>Thay đổi thông tin tài khoản: </h1>
    <h3>Thông tin cá nhân:</h3>
    <p><span class="error">* bắt buộc</span></p>
    <form method="post" action="">
        <label>Tên của bạn: <input type="text" name="name" value="<?php echo $name; ?>" /></label>
        <span class="error">* <?php echo $nameErr;?></span><br><br>
        <label>Tên tài khoản: <input type="text" name="username" value="<?php echo $username; ?>" /></label>
        <span class="error">* <?php echo $usernameErr;?></span><br><br>
        <label>Email: <input type="text" name="email" value="<?php echo $email; ?>" /></label>
        <span class="error">* <?php echo $emailErr;?></span><br><br>
        <label>Ngôn ngữ: 
            <input type="radio" id="lang-VN" name="language" value="VN" >
            <label for="lang-VN">Tiếng Việt</label>
            <input type="radio" id="lang-EN" name="language" value="EN" >
            <label for="lang-EN">Tiếng Anh</label>
        </label>
        <br><br>
        <input type="submit" name="saveinfo" value="Lưu">
        <br>
    </form>
    <br><br>
    <hr />
    <br>
    <h3>Change your password:</h3>
    <p><span class="error">* bắt buộc</span></p>
    <form method="post" action="">
        <label>New password: <input type="password" name="password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <label>Re-enter your new password: <input type="password" name="re_password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <input type="submit" name="savepass" value="Lưu">
        <br>
    </form>

    <nav><a href="/vn/pages/options.php">Quay lại Cài đặt</a></nav>

    <script>
        document.getElementById("lang-<?php echo $lang; ?>").checked = "true";
    </script>

</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/footer.php";
?>

</html>

<?php
}else{
include $_SERVER['DOCUMENT_ROOT']."/include/start_page.php";
} 
?>
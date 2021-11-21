<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/accounts/changePass.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>ĐỔI MẬT KHẨU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

<body>
    
    <h1>Vui lòng điền mật khẩu mới của bạn: </h1>
    <p><span class="error">* bắt buộc</span></p>
    <form method="post" action="">
        <label>Mật khẩu mới: <input type="password" name="password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <label>Nhập lại mật khẩu mới: <input type="password" name="re_password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <input type="submit" name="savepass" value="Lưu">
        <br>
    </form>

    <nav><a href="/vn/pages/options.php">Quay lại Cài đặt</a></nav>

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
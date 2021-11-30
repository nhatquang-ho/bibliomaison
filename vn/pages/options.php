<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>CÀi ĐẶT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

<body>
    <h1>
        <a href="/vn/index.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        Cài đặt
    </h1>
    <menu>
        <li><a href="/vn/pages/profileSettings.php"><button type="button">Thay đổi thông tin tài khoản</button></a></li>
        <li><a href="/vn/modules/accounts/deleteAcc.php" onclick="return Confirm()"><button style="background-color:#FF856B;" type="button">Xóa tài khoản!</button></a></li>
    </menu>

    <script type="text/javascript">
    function Confirm() {
        if (confirm('Bạn có muốn xóa tài khoản của mình?')) {
            return true;
        } else {
            return false;
        }
    }
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
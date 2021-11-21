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
    <h1>PARAMETERS</h1>
    <menu>
        <li><a href="/vn/modules/accounts/deleteAcc.php" onclick="return Confirm()"><button type="button">Xóa tài khoản!</button></a></li>
        <li><a href="/vn/pages/password.php"><button type="button">Thay đổi mặt khẩu</button></a></li>
    </menu>

    <nav><a href="/vn/index.php">Quay về trang chủ</a></nav>


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
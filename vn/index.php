<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>TRANG CHỦ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

<?php
if($_SESSION["username"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

    <hgroup>
        <h1>Thư viện gia đình</h1>
        <h2>Hãy thêm sách vào thư viện của bạn</h2>
    </hgroup>

    <menu>
        <li><a href="/vn/pages/listBooks.php"><button type="button">Thư viện của bạn</button></a></li>
    </menu>

<?php
if($_SESSION["username"] == "tipou") {
?>
    <h2>Thử nghiệm:</h2>
    <menu>
        <li><a href="/vn/modules/testers/addtestbooks.php?quantity=10"><button type="button">Thêm 10 tựa sách</button></a></li>
        <li><a href="/vn/modules/testers/addtestbooks.php?quantity=100"><button type="button">Thêm 100 tựa sách</button></a></li>
        <li><a href="/vn/modules/testers/addtestbooks.php?quantity=1000"><button type="button">Thêm 1000 tựa sách</button></a></li>
    </menu>

<?php
}
?>


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
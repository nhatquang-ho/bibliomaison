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
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

    <hgroup>
        <h1>Thư viện gia đình</h1>
        <h2>Hãy thêm sách của bạn vào thư viện</h2>
    </hgroup>

    <menu>
        <li><a href="/vn/pages/listBooks.php"><button type="button">Thư viện của bạn</button></a></li>
    </menu>


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
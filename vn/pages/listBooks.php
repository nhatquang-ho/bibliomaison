<?php
session_start();
?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>SÁCH CỦA BẠN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

<body>

<?php
if($_SESSION["name"]) {
?>

    <h1>List all books in your library</h1>

    <form action="" method="post">
        <input type="text" name="isbn">
        <input type="submit" name="search_isbn" value="Tìm ISBN sách">
        <input type="text" name="title">
        <input type="submit" name="search_title" value="Tìm tựa sách">
    </form>

    <?php #display books table
    include $_SERVER['DOCUMENT_ROOT']."/vn/modules/books/listBooks.php" 
    ?>

    <br>
    <a href="/vn/pages/createBook.php"><button type="button">Thêm sách</button></a>
    <a href="/modules/books/deleteAllBooks.php" onclick="return Confirm()"><button type="button">Xóa tất cả sách</button></a>
    <br><br>
    <nav><a href="/index.php">Quay về trang chủ</a></nav>

    <script type="text/javascript">
    function Confirm() {
        if (confirm('Bạn có chắc muốn xóa tất cả sách?')) {
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
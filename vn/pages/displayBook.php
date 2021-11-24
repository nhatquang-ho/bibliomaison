<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/books/displayBook.php" ?>

<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>SÁCH</title>
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
        <a href="/vn/pages/listBooks.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        Sách - ISBN: <?php echo $isbn; ?>
        <a href="/vn/pages/listBooks.php?delbook=<?php echo $isbn; ?>" onclick="return ConfirmDeleteOne(<?php echo $isbn; ?>)"><input class="icon-button" type="image" src="/assets/images/delete.png" /></a>
        <a href="/vn/pages/updateBook.php?isbn=<?php echo $isbn; ?>"><input class="icon-button" type="image" src="/assets/images/update.png" /></a> 
    </h1>
    
    <h3>Tựa đề</h3>
    <p><?php echo $title; ?></p>
    <h3>Thể loại</h3>
    <p><?php echo $category; ?></p>
    <h3>Năm</h3>
    <p><?php echo $year; ?></p>
    <h3>Nhà xuất bản</h3>
    <p><?php if($edition!="") {echo $edition;} else {echo "Trống";} ?></p>
    <h3>Tác giả</h3>
    <p><?php if($authors!="") {echo $authors;} else {echo "Trống";} ?></p>
    <h3>Tóm tắt nội dung</h3>
    <p><?php if($summary!="") {echo $summary;} else {echo "Trống";} ?></p>
    <h3>Lần sửa cuối cùng</h3>
    <p><?php echo $last_modification; ?></p>

    <script>
        function ConfirmDeleteOne(isbn) {
        if (confirm('Bạn có chắc muốn xóa cuốn sách này? (ISBN: '+ isbn +')')) {
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
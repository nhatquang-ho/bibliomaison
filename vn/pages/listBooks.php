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
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

<body>

    <h1>
        <a href="/vn/index.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        Sách của bạn
    </h1>

    <p><button id="show-search-form-button" onclick="ShowSearchForm()">Tìm kiếm v</button></p>
    <form id="search-form" style="display:none;" action="" method="post">
        <input type="text" name="isbn">
        <input type="submit" name="search_isbn" value="Tìm ISBN sách">
        <br>
        <input type="text" name="title">
        <input type="submit" name="search_title" value="Tìm tựa sách">
        <br>
        <select name="category" onchange="otherCheck(this);">
            <option value="">--Thể loại sách--</option>
            <option value="Khong xac dinh">Không xác định</option>
            <option value="Chinh tri">Chính trị</option>
            <option value="Khoa hoc - Kinh te">Khoa học - Kinh tế</option>
            <option value="Van hoc - Nghe thuat">Văn học - Nghệ thuật</option>
            <option value="Van hoa - Xa hoi - Lich su">Văn hóa - Xã hội - Lịch sử</option>
            <option value="Giao duc">Giáo dục</option>
            <option value="Truyen, tieu thuyet">Truyện, tiểu thuyết</option>
            <option value="Tam ly, tam linh, ton giao">Tâm lý, tâm linh, tôn giáo</option>
            <option value="Thieu nhi">Thiếu nhi</option>
            <option value="Khac">Khác</option>
        </select>
        <input type="text" id="category-other" style="display:none;" name="category-other" maxlength="30" />
        <input type="submit" name="search_category" value="Tìm thể loại sách">
    </form>

    <br>
    <a href="/vn/pages/createBook.php"><button type="button">Thêm sách</button></a>
    <a href="/vn/modules/books/deleteAllBooks.php" onclick="return ConfirmDeleteAll()"><button type="button">Xóa tất cả sách</button></a>
    <br>
    <p></p>

    <?php #display books table
    include $_SERVER['DOCUMENT_ROOT']."/vn/modules/books/listBooks.php" 
    ?>

    <script type="text/javascript">
    function ConfirmDeleteAll() {
        if (confirm('Bạn có chắc muốn xóa tất cả sách?')) {
            return true;
        } else {
            return false;
        }
    }
    function otherCheck(that){
            if(that.value == "Khac"){
                var x = document.getElementById("category-other");
                x.style.display = "block";
            }
            else {
                var x = document.getElementById("category-other");
                x.style.display = "none";
            }
    }
    function ShowSearchForm() {
            var x = document.getElementById("search-form");
            if (x.style.display == "none"){
                x.style.display = "block";
                document.getElementById("show-search-form-button").innerHTML = "Search Books ᴧ";
            }
            else {
                x.style.display = "none";
                document.getElementById("show-search-form-button").innerHTML = "Search Books v";
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
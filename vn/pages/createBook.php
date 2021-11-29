<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/books/creatBook.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>THÊM SÁCH</title>
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
        Thêm sách của bạn:
    </h1>
    <p><span class="error">* bắt buộc</span></p>
    <form method="post" action="">
        <label>ISBN: <input type="text" name="isbn" maxlength="30" /></label>
        <span class="error">* <?php echo $isbnErr;?></span>
        <br><br>
        <label>Tựa đề: <input type="text" name="title" maxlength="50" /></label>
        <span class="error">* <?php echo $titleErr;?></span>
        <br><br>
        <label>Thể loại:
        <select name="category" onchange="otherCheck(this);">
            <option value="">--Vui lòng chọn thể loại sách--</option>
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
        <input type="text" id="category-other" style="visibility:hidden;" name="category-other" maxlength="30" />
        </label>
        <br><br>
        <label>Năm: <input type="text" name="year" maxlength="4" /></label>
        <span class="error">* <?php echo $yearErr;?></span>
        <br><br>
        <label>Nhà xuất bản: <input type="text" name="edition" maxlength="30" /></label>
        <br><br>
        <label>Tác giả: <input type="text" name="authors" maxlength="50" /></label>
        <br><br>
        <label>Tóm tắt: <textarea name="summary" rows="5" cols="40" maxlength="1500"></textarea></label>
        <br><br>
        <input type="submit" name="creatbook" value="Lưu"><br>
    </form>

    <script>
        function otherCheck(that){
            if(that.value == "Khac"){
                var x = document.getElementById("category-other");
                x.style.visibility = "visible";
            }
            else {
                var x = document.getElementById("category-other");
                x.style.visibility = "hidden";
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
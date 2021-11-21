<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/books/creatBook.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>THÊM SÁCH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

<body>

    <?php
if($_SESSION["name"]) {
?>

    <h1>Thêm sách của bạn:</h1>
    <p><span class="error">* bắt buộc</span></p>
    <form method="post" action="">
        <label>ISBN: <input type="text" name="isbn" maxlength="30" /></label>
        <span class="error">* <?php echo $isbnErr;?></span>
        <br><br>
        <label>Tựa đề: <input type="text" name="title" maxlength="50" /></label>
        <span class="error">* <?php echo $titleErr;?></span>
        <br><br>
        <label>Thể loại:
        <select name="category">
            <option value="">--Vui lòng chọn thể loại sách--</option>
            <option value="Không xác định">Không xác định</option>
            <option value="Chính trị">Chính trị</option>
            <option value="Khoa học - Kinh tế">Khoa học - Kinh tế</option>
            <option value="Văn học - Nghệ thuật">Văn học - Nghệ thuật</option>
            <option value="Văn hóa - Xã hội - Lịch sử">Văn hóa - Xã hội - Lịch sử</option>
            <option value="Giáo dục">Giáo dục</option>
            <option value="Truyện, tiểu thuyết">Truyện, tiểu thuyết</option>
            <option value="Tâm lý, tâm linh, tôn giáo">Tâm lý, tâm linh, tôn giáo</option>
            <option value="Thiếu nhi">Thiếu nhi</option>
            <option value="Khác">Khác</option>
        </select>
        <input type="text" id="category-other" style="visibility:hidden;" name="category-other" maxlength="30" />
        </label>
        <br><br>
        <label>Năm: <input type="text" name="year" maxlength="4" /></label>
        <span class="error"><?php echo $yearErr;?></span>
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
            if(that.value == "Khác"){
                var x = document.getElementById("category-other");
                x.style.visibility = "visible";
            }
        }
    </script>

    <nav><a href="/vn/pages/listBooks.php">Quay về thư viện</a></nav>

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
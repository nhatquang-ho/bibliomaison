<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/books/updateBook.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>SỬA SÁCH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/header.php";
?>

    <h1>Sửa sách của bạn</h1>
    <form method="post" action="">
        <label>ISBN: <input type="text" name="isbn" readonly="readonly" value="<?php echo $isbn ?>" /></label>
        <br><br>
        <label>Tựa đề: <input type="text" name="title" value="<?php echo $title; ?>" maxlength="50" /></label>
        <span class="error"><?php echo $titleErr;?></span>
        <br><br>
        <label>Thể loại:
        <select id="mySelect" name="category" onchange="otherCheck(this);">
            <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
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
        <label>Năm: <input type="text" name="year" value="<?php echo $year; ?>"  maxlength="4" /></label>
        <span class="error"><?php echo $yearErr;?></span>
        <br><br>
        <label>Nhà xuất bản: <input type="text" name="edition" value="<?php echo $edition; ?>"  maxlength="30" /></label>
        <br><br>
        <label>Tác giả: <input type="text" name="authors" value="<?php echo $authors; ?>" maxlength="50" /></label>
        <br><br>
        <label>Tóm tắt: <textarea name="summary" rows="5" cols="40" maxlength="1500"><?php echo $summary; ?></textarea></label>
        <br><br>
        <input type="submit" name="updbook" value="Lưu">
    </form>

    <script>
        var selectobject = document.getElementById("mySelect");
        for (var i=1; i<selectobject.options.length; i++) {
            if (selectobject.options[i].value == "<?php echo $category; ?>")
                selectobject.removeChild(selectobject.options[i]);
        }

        function otherCheck(that){
            if(that.value == "Other"){
                var x = document.getElementById("category-other");
                x.style.visibility = "visible";
            }
        }
    </script>

    <br>
    <nav><a href="/pages/listBooks.php">Quay về thư viện</a></nav>

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
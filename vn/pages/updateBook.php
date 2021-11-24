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

    <br>
    <nav><a href="javascript:history.go(-1)">Quay về</a></nav>

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
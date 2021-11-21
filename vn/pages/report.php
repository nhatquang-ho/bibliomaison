<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/sendreport.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>BÁO CÁO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
$path = substr($_SERVER['REQUEST_URI'],3);
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button">EN ↔ VN </button></a>
<br>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <h2>Vui lòng điền thông tin bên dưới:</h2>
    <p><span class="error">* bắt buộc</span></p>
    <form method="post" action="">
        Tên của bạn: <input type="text" name="name" maxlength="30">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        Email: <input type="text" name="email" maxlength="30">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Báo cáo: <textarea name="comment" rows="5" cols="40" maxlength="2000"></textarea>
        <span class="error">* <?php echo $commentErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Gửi">
    </form>

    <nav><a href="/vn/index.php">Quay về trang chủ</a></nav>

</body>

</html>
<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/sendreport.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>BÁO CÁO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
$_SERVER["lang"] = "VN";
$path = substr($_SERVER['REQUEST_URI'],3);
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button">EN ↔ <b>VN</b> </button></a>
<br>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <h1>
        <a href="javascript:history.go(-1)"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        Vui lòng điền thông tin bên dưới:
    </h1>
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

</body>

</html>
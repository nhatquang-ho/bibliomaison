<?php include $_SERVER['DOCUMENT_ROOT']."/vn/modules/accounts/creatAcc.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>ĐĂNG KÝ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <h1>Vui lòng điền thông tin của bạn</h1>
    <p><span class="error">* bắt buộc</span></p>
    <form method="post" action="">
        <label>Tên của bạn: <input type="text" name="name" maxlength="30" /></label>
        <span class="error">* <?php echo $nameErr;?></span><br><br>
        <label>Tên tài khoản: <input type="text" name="username" maxlength="30"/></label>
        <span class="error">* <?php echo $usrnameErr;?></span><br><br>
        <label>Email: <input type="text" name="email" maxlength="30" /></label>
        <span class="error">* <?php echo $emailErr;?></span><br><br>
        <label>Ngôn ngữ: 
            <input type="radio" name="language" value="VN" checked>
            <input type="radio" name="language" value="EN" >
        </label>
        <br><br>
        <input type="submit" name="creatacc" value="Tạo"></p>
    </form>

    <nav><a href="/vn/pages/login.php">Quay về</a></nav>

</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/vn/include/footer.php";
?>

</html>
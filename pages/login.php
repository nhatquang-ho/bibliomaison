<?php include $_SERVER['DOCUMENT_ROOT']."/modules/accounts/logincheck.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
$path = "/vn" . $_SERVER['REQUEST_URI'];
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button">EN ↔ VN </button></a>
<br>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <center>
    <form name="frmUser" method="post" action="">
        <div class="error"><?php if($message!="") { echo $message; } ?></div>
        <h3>Login</h3>
        Username:<br>
        <input type="text" name="user_name" maxlength="30">
        <br>
        Password:<br>
        <input type="password" name="password" id="myPassword" maxlength="30" >
        <br>
        <input type="checkbox" onclick="Show_Hide_Pass()">Show Password
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <a href="/pages/creatAcc.php"><button type="button">Create your account</button></a>
    </form>
        <p>default account - tipou:tipou</p>
    </center>
    
    <script>
        function Show_Hide_Pass() {
            var x = document.getElementById("myPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/footer.php";
?>

</html>
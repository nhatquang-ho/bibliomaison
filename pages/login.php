<?php include $_SERVER['DOCUMENT_ROOT']."/modules/accounts/logincheck.php" ?>

<html>

<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
</head>

<body>
    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <form name="frmUser" method="post" action="" align="center">
        <div class="error"><?php if($message!="") { echo $message; } ?></div>
        <h3 align="center">Enter Login Details</h3>
        Username:<br>
        <input type="text" name="user_name">
        <br>
        Password:<br>
        <input type="password" name="password" id="myPassword">
        <br>
        <input type="checkbox" onclick="Show_Hide_Pass()">Show Password
        <br><br>
        <input type="submit" name="submit" value="Submit">
        <a href="/pages/creatAcc.php"><button type="button">Create your account</button></a>
    </form>
    <center>
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
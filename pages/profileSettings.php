<?php include $_SERVER['DOCUMENT_ROOT']."/modules/accounts/profileSettings.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>PROFILE SETTINGS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<body>
    
    <h1>
        <a href="/pages/options.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        Profile settings: 
    </h1>
    <h3>Change your information:</h3>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        <label>Name: <input type="text" name="name" value="<?php echo $name; ?>" /></label>
        <span class="error">* <?php echo $nameErr;?></span><br><br>
        <label>Username: <input type="text" name="username" value="<?php echo $username; ?>" /></label>
        <span class="error">* <?php echo $usernameErr;?></span><br><br>
        <label>Email: <input type="text" name="email" value="<?php echo $email; ?>" /></label>
        <span class="error">* <?php echo $emailErr;?></span><br><br>
        <label>Language: 
            <input type="radio" id="lang-VN" name="language" value="VN" >
            <label for="lang-VN">Vietnamese</label>
            <input type="radio" id="lang-EN" name="language" value="EN" >
            <label for="lang-EN">English</label>
        </label>
        <br><br>
        <input type="submit" name="saveinfo" value="Save changes">
        <br>
    </form>
    <br><br>
    <hr />
    <br>
    <h3>Change your password:</h3>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        <label>New password: <input type="password" name="password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <label>Re-enter your new password: <input type="password" name="re_password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <input type="submit" name="savepass" value="Save changes">
        <br>
    </form>

    <script>
        document.getElementById("lang-<?php echo $lang; ?>").checked = "true";
    </script>

</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/footer.php";
?>

</html>

<?php
}else{
include $_SERVER['DOCUMENT_ROOT']."/include/start_page.php";
} 
?>
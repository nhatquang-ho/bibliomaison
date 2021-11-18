<?php include $_SERVER['DOCUMENT_ROOT']."/modules/accounts/changePass.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>CHANGE PASSWORD</title>
</head>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

<body>
    
    <h1>Please enter your new password: </h1>
    <form method="post" action="">
        <label>New password: <input type="password" name="password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <label>Re-enter your new password: <input type="password" name="re_password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <button type="submit" name="savepass" value="submit">Save changes</button><br>
    </form>

    <nav><a href="/index.php">Back to main menu</a></nav>

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
<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>PARAMETERS</title>
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
        <a href="/index.php"><input class="icon-button" type="image" src="/assets/images/back-arrow.png" /></a>
        PARAMETERS
    </h1>
    <menu>
        <li><a href="/pages/profileSettings.php"><button type="button">Change your profile settings</button></a></li>
        <li><a href="/modules/accounts/deleteAcc.php" onclick="return Confirm()"><button type="button">Delete your
                    account!</button></a></li>
    </menu>

    <script type="text/javascript">
    function Confirm() {
        if (confirm('Do you want to delete your account?')) {
            return true;
        } else {
            return false;
        }
    }
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
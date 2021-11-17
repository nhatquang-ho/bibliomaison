<?php
session_start();
?>
<html>

<head>
    <title>OPTIONS</title>
    <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
</head>

<body>

<?php
if($_SESSION["name"]) {
?>

<?php
include "../include/header.php";
?>

    <h1>PARAMETERS</h1>
    <menu>
        <li><a href="../modules/deleteAcc.php" onclick="return clicked()"><button type="button">Delete your
                    account!</button></a></li>
        <li><a href="../pages/password.php"><button type="button">Change your password</button></a></li>
    </menu>

    <nav><a href="../index.php">Back to main menu</a></nav>


    <script type="text/javascript">
    function clicked() {
        if (confirm('Do you want to delete your account?')) {
            return true;
        } else {
            return false;
        }
    }
    </script>

</body>

<?php
include "../include/footer.php";
?>

</html>

<?php
}else{
include "../include/start_page.php";
} 
?>
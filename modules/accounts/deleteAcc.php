<?php #delete user account
session_start();

include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

#check if it's the default account
if ($name == 'tipou'){
    echo '<script>alert("You cannot delete the default account");</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/options.php"} , 0);</script>';
}
#delete this user account
else{
    $delbooktab= mysql_query("DROP TABLE $name") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    $dellogin_user=mysql_query("DELETE FROM login_user WHERE user_name='$name'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

    echo '<script>alert("Your account is successfully deleted");</script>';
    echo '<script>console.log("User deleted")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/logout.php"} , 0);</script>';
}
?>
<?php
session_start();
?>
<?php
if($_SESSION["name"]) {
$name=$_SESSION["username"];
?>

<?php

include 'loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

$link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$link) {
    die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
   die('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
}

#check if it's the default account
if ($name == 'tipou'){
    echo '<script>alert("You cannot delete the default account");</script>';
}
#delete this account
else{
    $deltab= mysql_query("DROP TABLE $name") or die("Erreur SQL : $sql<br/>".mysql_error());
    $dellogin=mysql_query("DELETE FROM login_user WHERE user_name='$name'") or die("Erreur SQL : $sql<br/>".mysql_error());

    echo '<script>alert("Your account is successfully deleted");</script>';
    echo '<script>console.log("User deleted")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="../pages/logout.php"} , 500);</script>';
}

?>


<?php
}else{
?>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
<h1>Please <a href="../pages/login.php">click here</a> to login</h1>
<?php
} 
?>
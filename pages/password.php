<?php
session_start();
?>
<html>

<head>
    <title>CHANGE PASSWORD</title>
    <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
</head>

<body>

<?php
if($_SESSION["name"]) {
    $name=$_SESSION["username"];
?>

<?php

#Set conditions for input values
$pwd = $re_pwd = "";
$pwdErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pwd = $re_pwd = "";
    $pwdErr = "";
    if (empty($_POST["password"])) {
        $pwdErr = "New password is required";
    } else {
        $pwd = $_POST["password"];
        // check if password valid
        if (preg_match("/\s/",$pwd)) {
            $pwdErr = "no space allowed";
        }
    }
    if (empty($_POST["re_password"])) {
        $re_pwdErr = "Re-enter your new password is required";
    } else {
        $re_pwd = $_POST["re_password"];
    }
}
?>


    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
    Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" title="Logout">Logout.</a>

    <h1>Please enter your new password: </h1>
    <form method="post" action="">
        <label>New password: <input type="password" name="password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <label>Re-enter your new password: <input type="password" name="re_password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
        <button type="submit" name="savepass" value="submit">Save changes</button><br>
    </form>

    <nav><a href="../index.php">Back to main menu</a></nav>

    
<?php

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

if(isset($_POST['savepass']) && ($re_pwdErr=="" && $pwdErr=="")){
  $link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
  if (!$link) {
      die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
  }
  echo '<script>console.log("test1")</script>';
  $db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
  if (!$db_selected) {
    die('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
  }
  $pass = $_POST['password'];
  $re_pass = $_POST['re_password'];

  #Check if passwords inputed are identical
  if ($pass != $re_pass){
    die('<script>alert("Your password re-entered is not the same as the previous one");</script>');
  }

  $update_pass = mysql_query("UPDATE login_user SET password='$pass' WHERE user_name='$name'")
    or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

      
  echo '<script>alert("Your password is successfully updated");</script>';
  echo '<script>console.log("Password updated")</script>';
  echo '<script type="text/javascript">setTimeout(function(){window.top.location="options.php"} , 000);</script>';
}
?>


<?php
}else{
?>
    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
    <h1>Please <a href="login.php">click here</a> to login</h1>
    <?php
} 
?>

</body>

</html>
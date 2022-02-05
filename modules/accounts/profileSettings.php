<?php #Change profile settings
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

$session_name=$_SESSION["username"];

$getuser = mysql_query("SELECT * FROM login_user WHERE user_name='$session_name'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
$user = mysql_fetch_assoc($getuser);
$name = $user["name"];
$username = $user["user_name"];
$email = $user["email"];
$lang = $user["language"];

#Set conditions for input values
$pwd = $re_pwd = "";
$nameErr=$usernameErr=$emailErr=$pwdErr ="";

if (isset($_POST['savepass'])) {
    $pwd = $re_pwd = "";
    $pwdErr = "";
    if (empty($_POST["password"])) {
        $pwdErr = "New password is required";
    } else {
        $pwd = $_POST["password"];
        // check if password valid
        if (preg_match("/\s/",$pwd) || strlen($pwd) < 6 || strlen($pwd) > 30) {
            $pwdErr = "no space allowed, must be 6 to 30 characters";
        }
    }
    if (empty($_POST["re_password"])) {
        $re_pwdErr = "Re-enter your new password is required";
    } else {
        $re_pwd = $_POST["re_password"];
    }
}

if (isset($_POST['saveinfo'])) {
    $nameErr=$usernameErr=$emailErr="";
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = $_POST["name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = $_POST["username"];
        // check if username only contains letters and numbers
        if (!preg_match("/^[a-zA-Z0-9]*$/",$username) || strlen($username) < 6 || strlen($username) > 30 ) {
            $usernameErr = "Only letters and numbers allowed, must be 6 to 30 characters";
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        if (!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9._-]+\\.[a-z][a-z]+$/",$email)) {
            $emailErr = "Email invalid";
        }
    }
}

if(isset($_POST['savepass']) && ($re_pwdErr=="" && $pwdErr=="")){

    #set new password
    $pass = $_POST['password'];
    $re_pass = $_POST['re_password'];

    #Check if passwords inputed are identical
    if ($pass != $re_pass){
        echo '<script>alert("Your password re-entered is not the same as the previous one");</script>';
    }

    #Check if it's the default account
    else if ($session_name == "tipou"){
        echo '<script>alert("You cannot change the password of the default account");</script>';
    }
    else {
        $update_pass = mysql_query("UPDATE login_user SET password='$pass' WHERE user_name='$username'")
            or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

        echo '<script>alert("Your password is successfully updated");</script>';
        echo '<script>console.log("Password updated")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/options.php"} , 000);</script>';
    }
}

if(isset($_POST['saveinfo']) && ($nameErr=="" && $usernameErr=="" && $emailErr=="")){
    
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $lang = $_POST["language"];

    $existusername = mysql_query("SELECT user_name FROM login_user where user_name='$username'") 
        or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    $existemail = mysql_query("SELECT email FROM login_user where email='$email'") 
        or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

    if ($session_name == "tipou"){
        echo '<script>alert("You cannot change the information of the default account");</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/profileSettings.php"} , 0);</script>';
    }
    elseif(mysql_fetch_assoc($existusername)){
        echo '<script>alert("Username existed, please choose another one!");</script>';
        echo '<script>console.log("Username existed")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/profileSettings.php"} , 0);</script>';
    }
    elseif(mysql_fetch_assoc($existemail)){
        echo '<script>alert("Email is already associated with an account, please use another one!");</script>';
        echo '<script>console.log("Email existed")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/profileSettings.php"} , 0);</script>';
    }
    else {
        $update_info = mysql_query("UPDATE login_user SET name='$name',user_name='$username',email='$email',language='$lang'  WHERE user_name='$session_name'")
            or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

        echo '<script>alert("Your information is successfully updated");</script>';
        echo '<script>console.log("Info updated")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/options.php"} , 000);</script>';
    }
}
?>

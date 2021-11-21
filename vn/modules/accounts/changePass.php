<?php #Change password
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

#Set conditions for input values
$pwd = $re_pwd = "";
$pwdErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pwd = $re_pwd = "";
    $pwdErr = "";
    if (empty($_POST["password"])) {
        $pwdErr = "Vui lòng điền mật khẩu mới của bạn";
    } else {
        $pwd = $_POST["password"];
        // check if password valid
        if (preg_match("/\s/",$pwd) || strlen($pwd) < 6 || strlen($pwd) > 30) {
            $pwdErr = "không hợp lệ: không cho phép khoảng trắng, mật khẩu phải từ 6 đến 30 ký tự";
        }
    }
    if (empty($_POST["re_password"])) {
        $re_pwdErr = "Vui lòng điền lại mật khẩu mới của bạn";
    } else {
        $re_pwd = $_POST["re_password"];
    }
}

if(isset($_POST['savepass']) && ($re_pwdErr=="" && $pwdErr=="")){
    
    include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

    #set new password
    $pass = $_POST['password'];
    $re_pass = $_POST['re_password'];

    #Check if passwords inputed are identical
    if ($pass != $re_pass){
        echo '<script>alert("Mật khẩu điền không trùng khớp");</script>';
    }

    #Check if it's the default account
    else if ($name == "tipou"){
        echo '<script>alert("Bạn không thể thay đổi mật khẩu của tài khoản mặc định");</script>';
    }
    else {
        $update_pass = mysql_query("UPDATE login_user SET password='$pass' WHERE user_name='$name'")
            or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

        echo '<script>alert("Mật khẩu thay đổi thành công");</script>';
        echo '<script>console.log("Password updated")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/vn/pages/options.php"} , 000);</script>';
    }
}
?>
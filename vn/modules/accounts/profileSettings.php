<?php #Change profile settings
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

$session_name=$_SESSION["username"];
$lang=$_SESSION["lang"];

$getuser = mysql_query("SELECT * FROM login_user WHERE user_name='$session_name'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
$user = mysql_fetch_assoc($getuser);
$name = $user["name"];
$username = $user["user_name"];
$email = $user["email"];


#Set conditions for input values
$pwd = $re_pwd = "";
$nameErr=$usernameErr=$emailErr=$pwdErr ="";

if (isset($_POST['savepass'])) {
    $pwd = $re_pwd = "";
    $pwdErr = "";
    if (empty($_POST["password"])) {
        $pwdErr = "Vui lòng điền mật khẩu mới của bạn";
    } else {
        $pwd = $_POST["password"];
        // check if password valid
        if (preg_match("/\s/",$pwd) || strlen($pwd) < 6 || strlen($pwd) > 30) {
            $pwdErr = "Không hợp lệ: không cho phép khoảng trắng, phải từ 6 đến 30 ký tự";
        }
    }
    if (empty($_POST["re_password"])) {
        $re_pwdErr = "Vui lòng nhập lại mật khẩu mới";
    } else {
        $re_pwd = $_POST["re_password"];
    }
}

if (isset($_POST['saveinfo'])) {
    $nameErr=$usernameErr=$emailErr="";
    if (empty($_POST["name"])) {
        $nameErr = "Vui lòng điền tên của bạn";
    } else {
        $name = $_POST["name"];
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Chỉ cho phép các chữ cái và khoảng trắng";
        }
    }
    if (empty($_POST["username"])) {
        $usernameErr = "Vui lòng điền tên tài khoản";
    } else {
        $username = $_POST["username"];
        // check if username only contains letters and numbers
        if (!preg_match("/^[a-zA-Z0-9]*$/",$username) || strlen($username) < 6 || strlen($username) > 30 ) {
            $usernameErr = "Không hợp lệ: chỉ cho phép chữ cái và số, từ 6 đến 30 ký tự";
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Vui lòng điền email của bạn";
    } else {
        $email = $_POST["email"];
        if (!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9._-]+\\.[a-z][a-z]+$/",$email)) {
            $emailErr = "Email không hợp lệ";
        }
    }
}

if(isset($_POST['savepass']) && ($re_pwdErr=="" && $pwdErr=="")){

    #set new password
    $pass = $_POST['password'];
    $re_pass = $_POST['re_password'];

    #Check if passwords inputed are identical
    if ($pass != $re_pass){
        echo '<script>alert("Mật khẩu điền không khớp, xin thử lại");</script>';
    }

    #Check if it's the default account
    else if ($session_name == "tipou"){
        echo '<script>alert("Không thể đổi mật khẩu của tài khoản mặc định!");</script>';
    }
    else {
        $update_pass = mysql_query("UPDATE login_user SET password='$pass' WHERE user_name='$name'")
            or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

        echo '<script>alert("Mật khẩu của bạn đã được thay đổi");</script>';
        echo '<script>console.log("Password updated")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/vn/pages/options.php"} , 000);</script>';
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
        echo '<script>alert("Không thể thay đổi thông tin của tài khoản mặc định!");</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/vn/pages/profileSettings.php"} , 0);</script>';
    }
    elseif(mysql_fetch_assoc($existusername)){
        echo '<script>alert("Tài khoản tồn tại, vui lòng chọn tên tài khoản khác!");</script>';
        echo '<script>console.log("Username existed")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/vn/pages/profileSettings.php"} , 0);</script>';
    }
    elseif(mysql_fetch_assoc($existemail)){
        echo '<script>alert("Email này đã được sử dụng, vui lòng sử dụng email khác!");</script>';
        echo '<script>console.log("Email existed")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/vn/pages/profileSettings.php"} , 0);</script>';
    }
    else {
        $_SESSION["lang"] = $lang;
        $update_info = mysql_query("UPDATE login_user SET name='$name',user_name='$username',email='$email',language='$lang'  WHERE user_name='$session_name'")
            or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

        echo '<script>alert("Thông tin cá nhân cập nhật thành công!");</script>';
        echo '<script>console.log("Info updated")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/vn/pages/options.php"} , 000);</script>';
    }
}
?>
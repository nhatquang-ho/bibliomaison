<?php #Check when user log in

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$message="";
#Connect to the database
if(isset($_POST['submit'])) {
   
    include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

    #Check if username and password are correct
    $users = mysql_query("SELECT * FROM login_user WHERE user_name='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'") or die ('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');;
    $user  = mysql_fetch_array($users);
    if(is_array($user)) {
        $_SESSION["name"] = $user['name'];
        $_SESSION["username"]=$user['user_name'];
        $_SESSION["lang"]=$user['language'];
    } else {
        $message = "Tên tài khoản hoặc mật khẩu sai!";
        echo '<script>console.log("Username or password incorrect")</script>';
    }
}
if(isset($_SESSION["name"])) {
    if($_SESSION["lang"] == "EN") {
        echo '<script>window.top.location="/index.php";</script>';
    }
    else {
        echo '<script>window.top.location="/vn/index.php";</script>';
    }
}
?>
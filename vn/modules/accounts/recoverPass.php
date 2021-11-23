<?php #recovery password

include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

#function return random string (password generator)
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$usernameErr="";
$username="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr="Tên tài khoản bắt buộc!";
    } else {
        $username = $_POST["username"];
        if (!preg_match("/^[a-zA-Z0-9]*$/",$username) || strlen($username) < 6 || strlen($username) > 30 ) {
          $usernameErr = "Tên tài khoản không hợp lệ";
        }
    }
}

if(isset($_POST['submit']) && $usernameErr==""){
    include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

    #get the user
    $getuser = mysql_query("SELECT * FROM login_user WHERE user_name='$username'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    $user = mysql_fetch_assoc($getuser);
    if(!$user){
        echo '<script>alert("Tài khoản không tồn tại!");</script>';
    }
    else {
        $name = $user["name"];
        $email = $user["email"];
        $new_pass = generateRandomString(8);
        
        $update_pass = mysql_query("UPDATE login_user SET password='$new_pass' WHERE user_name='$username'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

        #send password via email
        ini_set("SMTP",$_ENV['SMTP_URL']);
        ini_set("smtp_port",$_ENV['SMTP_PORT']);
        $to = $email;
        $subject = 'bibliomaison.free.fr PASSWORD RESET';
        $message = "Xin chào " . $name . ","
                    . "<br>Mật khẩu của bạn đã được đặt lại!"
                    . "<br>Bạn có thể đăng nhập tại http://bibliomaison.free.fr/vn/pages/login.php với mật khẩu mới bên dưới:"
                    . "<br><br>Tên tài khoản:  " . $username
                    . "<br>Mật khẩu:  " . $new_pass
                    . "<br><br>Bạn có thể đổi mật khẩu của mình sau khi đăng nhập."
                    . "<br>Nếu có gì thắc mắc, vui lòng liên hệ qua email: bibliomaison@free.fr"
                    . "<br><br>ENJOY! :)"
                    . "<br>BIBLIOMAISON Team";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From:' . $_ENV['FROM_NOREPLY'] . "\r\n";
        $headers .= 'Cc: ' . "\r\n";
        $headers .= 'Bcc: ' . "\r\n";
        if (mail($to, $subject, $message, $headers)) {
            echo '<script>
                    console.log("message sent");
                </script>';
        } 
        else {
            echo '<script>
                    console.log("failed to sent message");
                </script>';
        }

        echo '<script>alert("Mật khẩu của bạn đã được đặt lại! Vui lòng kiểm tra email để biết mật khẩu mới");</script>';
        echo '<script>console.log("Password Reset!")</script>';
        echo '<script type="text/javascript">setTimeout(function(){window.top.location="/vn/pages/login.php"} , 0);</script>';
    }

}
?>
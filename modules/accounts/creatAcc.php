<?php #Create User Account

#load .env
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

#Set conditions for input values
$name = $usrname = $email = "";
$nameErr = $usrnameErr = $emailErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $usrname = $pwd = "";
  $nameErr = $usrnameErr = $pwdErr = "";
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
    $usrnameErr = "Username is required";
  } else {
    $usrname = $_POST["username"];
    // check if username only contains letters and numbers
    if (!preg_match("/^[a-zA-Z0-9]*$/",$usrname) || strlen($usrname) < 6 || strlen($usrname) > 30 ) {
      $usrnameErr = "Only letters and numbers allowed, must be 6 to 30 characters";
    }
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = $_POST["email"];
    if (!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9._-]+\\.[a-z][a-z]+$/",$email)) {
      $emailErr = "email invalid";
    }
  }
}


if(isset($_POST['creatacc']) && ($nameErr=="" && $usrnameErr=="" && $emailErr =="")){
    
    include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

    #create user account and its book table
    $name = $_POST['name'];
    $username = $_POST['username'];
    $pass = generateRandomString(8);
    $existacc = mysql_query("SELECT user_name FROM login_user where user_name='$username'") 
        or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    if(mysql_fetch_assoc($existacc)){
        die('<script>alert("Username existed, please choose another one!");</script>');
        echo '<script>console.log("Username existed")</script>';
    }
    $adduser = mysql_query("INSERT INTO login_user(name,user_name,password) VALUES('$name','$username','$pass')") 
        or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

    $creattab = mysql_query("CREATE TABLE $username (
        num INT NOT NULL,
        isbn VARCHAR(30) NOT NULL,
        title VARCHAR(30) NOT NULL,
        category VARCHAR(30) NOT NULL,
        year YEAR,
        authors VARCHAR(50),
        summary TEXT,
        last_modification DATETIME NOT NULL,
        PRIMARY KEY ( `isbn` )
        )") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    

    #send password via email
    ini_set("SMTP",$_ENV['SMTP_URL']);
    ini_set("smtp_port",$_ENV['SMTP_PORT']);
    $to = $_POST['email'];
    $subject = 'bibliomaison.free.fr PASSWORD';
    $message = "Hello " . $_POST['name'] . ","
                . "<br>You can now log in to http://bibliomaison.free.fr/pages/login.php :"
                . "<br><br>Username:  " . $_POST['username']
                . "<br>Password:  " . $pass
                . "<br><br>You can change your password later."
                . "<br> If you have any question, please contact bibliomaison@free.fr"
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

    echo '<script>alert("Your account is successfully created, please verify your email (as well your SPAM) to get your password");</script>';
    echo '<script>console.log("User created")</script>';
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="/pages/login.php"} , 0);</script>';

}
?>
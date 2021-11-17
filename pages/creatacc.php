<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
</head>

<body>
    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>


<?php

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
    if (!preg_match("/^[a-zA-Z0-9]*$/",$usrname) && strlen($usrname) >= 6 && strlen($usrname) <= 30 ) {
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

?>

    <h1>Fill the form below to create your account test</h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        <label>Name: <input type="text" name="name" /></label>
        <span class="error">* <?php echo $nameErr;?></span><br><br>
        <label>Username: <input type="text" name="username" /></label>
        <span class="error">* <?php echo $usrnameErr;?></span><br><br>
        <label>Email: <input type="text" name="email" /></label>
        <span class="error">* <?php echo $emailErr;?></span><br><br>
        <p><button type="submit" name="creatacc" value="submit">Submit</button></p>
    </form>

    <nav><a href="login.php">Back to main menu</a></nav>


</body>

<?php
include "../include/footer.php";
?>

</html>


<?php

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();


function generateRandomString($length) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}


if(isset($_POST['creatacc']) && ($nameErr=="" && $usrnameErr=="" && $emailErr =="")){
  $link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
  if (!$link) {
      die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
  }

  $db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
  if (!$db_selected) {
    die('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
  }
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
    isbn VARCHAR(30) NOT NULL,
    title VARCHAR(30) NOT NULL,
    year YEAR NOT NULL,
    PRIMARY KEY ( `isbn` )
    )") or die("Erreur SQL : $sql<br/>".mysql_error());
  

  #send password via mail
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
  echo '<script type="text/javascript">setTimeout(function(){window.top.location="login.php"} , 500);</script>';

}
?>
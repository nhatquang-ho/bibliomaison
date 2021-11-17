<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
</head>

<body>
    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>


<?php

#Set conditions for input values
$name = $usrname = $pwd = "";
$nameErr = $usrnameErr = $pwdErr = "";
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
    if (!preg_match("/^[a-zA-Z0-9]*$/",$usrname)) {
      $usrnameErr = "Only letters and numbers allowed";
    }
  }
  if (empty($_POST["password"])) {
    $pwdErr = "Password is required";
  } else {
    $pwd = $_POST["password"];
    // check if password content no space
    if (preg_match("/\s/",$pwd)) {
      $pwdErr = "no space allowed";
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
        <label>Password: <input type="password" name="password" /></label>
        <span class="error">* <?php echo $pwdErr;?></span><br><br>
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

if(isset($_POST['creatacc']) && ($nameErr=="" && $usrnameErr=="" && $pwdErr=="")){
  $link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
  if (!$link) {
      die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
  }

  $db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
  if (!$db_selected) {
    die('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
  }
  $name=$_POST['name'];
  $username=$_POST['username'];
  $pass=$_POST['password'];
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
      
  echo '<script>alert("Your account is successfully created");</script>';
  echo '<script>console.log("User created")</script>';
  echo '<script type="text/javascript">setTimeout(function(){window.top.location="login.php"} , 500);</script>';
}
?>
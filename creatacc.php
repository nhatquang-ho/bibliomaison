<html>
<head>
<link rel="stylesheet" type="text/css" href="mainpage.css">
</head>
<body>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

<?php

$name = $usrname = $pwd = "";
$nameErr = $usrnameErr = $pwdErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = $usrname = $pwd = "";
$nameErr = $usrnameErr = $pwdErr = "";
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  if (empty($_POST["username"])) {
    $usrnameErr = "Username is required";
  } else {
    $usrname = $_POST["username"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z]*$/",$usrname)) {
      $usrnameErr = "Only letters allowed";
    }
  }
  if (empty($_POST["password"])) {
    $pwdErr = "Password is required";
  } else {
    $pwd = test_input($_POST["password"]);
    // check if name only contains letters and whitespace
    if (preg_match("/\s/",$usrname)) {
      $pwdErr = "no space allowed";
    }
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h1>Fill the form below to create your account test</h1>
<p><span class="error">* required field</span></p>
<form method="post" action="">
    <label>Name: <input name="name" /></label>
    <span class="error">* <?php echo $nameErr;?></span><br><br>
    <label>Username: <input name="username" /></label>
    <span class="error">* <?php echo $usrnameErr;?></span><br><br>
    <label>Password: <input name="password" /></label>
    <span class="error">* <?php echo $pwdErr;?></span><br><br>
    <p><button type="submit" name="creatacc" value="submit">Submit</button></p>
</form>




<?php

include 'loadenv.php';
$dotenv = new DotEnv('.env');
$loadvars = $dotenv->load();

if(isset($_POST['creatacc']) && ($nameErr=="" && $usrnameErr=="" && $pwdErr=="")){
  $link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$link) {
    die('<br>Connexion database impossible : <br>' . mysql_error());
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
   die ('Impossible de sélectionner la base de données : <br>' . mysql_error());
}
    $name=$_POST['name'];
    $username=$_POST['username'];
    $pass=$_POST['password'];
    $existacc = mysql_query("SELECT user_name FROM login_user where user_name='$username'") or die("Erreur SQL : $sql<br/>".mysql_error());
    if(mysql_fetch_assoc($existacc)){
      die('username existed, please choose another one<br>
        <nav><a href="index.php">Back to main menu</a></nav>
        ');
    }
    $adduser = mysql_query("INSERT INTO login_user(name,user_name,password) VALUES('$name','$username','$pass')") or die("Erreur SQL : $sql<br/>".mysql_error());
    $creattab = mysql_query("CREATE TABLE $username (
      isbn VARCHAR(30) NOT NULL,
      title VARCHAR(30) NOT NULL,
      year YEAR NOT NULL,
      PRIMARY KEY ( `isbn` )
      )") or die("Erreur SQL : $sql<br/>".mysql_error());
    echo "your account is created succesfully, you will be redirected to the login page";
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="login.php"} , 3000);</script>';
}
?>

    <nav><a href="login.php">Back to main menu</a></nav>


    </body>
</html>

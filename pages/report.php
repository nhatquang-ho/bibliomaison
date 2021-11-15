<?php
session_start();
?>

<html>

<head>
    <title>REPORT</title>
    <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
</head>

<body>
    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

<?php
if($_SESSION["name"]) {
$name=$_SESSION["name"];
?>

    Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" title="Logout">Logout.</a><br><br>

    <h2>Please enter the information below</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        Name: <input type="text" name="name">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        E-mail: <input type="text" name="email">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Comment: <textarea name="comment" rows="5" cols="40"></textarea>
        <br><br>
        Gender:
        <input type="radio" name="gender" value="female">Female
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender" value="other">Other
        <span class="error">* <?php echo $genderErr;?></span>
        <br><br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <nav><a href="../index.php">Back to main menu</a></nav>

</body>

</html>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

#Set conditions for input values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<?php

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

#Send report
if (isset($_POST['submit'])) {
    ini_set("SMTP",$_ENV['SMTP_URL']);
    ini_set("smtp_port",$_ENV['SMTP_PORT']);
    $passage_ligne = "\r\n";
    $to = $_ENV['SMTP_TO'];

    $gender = $POST['gender'];

    $subject = $_POST['name'] . ' - ' . $_POST['gender'];

    $from = $_POST['email'];

    $message = 'This is a message from ' . $from . ':' . $passage_ligne . $passage_ligne . $_POST['comment'];

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From:' . $from . ' - ' . $gender . "\r\n";
    $headers .= 'Cc: '.$_ENV['CC_MAIL_1'].', '.$_ENV['CC_MAIL_2'] . "\r\n";
    $headers .= 'Bcc: '.$_ENV['BCC_MAIL']. "\r\n";

    if (mail($to, $subject, $message, $headers)) {
      echo '<script>
              alert("Your message was sent");
              console.log("message sent");
            </script>';
    }
    else {
      echo '<script>
              alert("Failed to send your message");
              console.log("failed to sent message");
            </script>';
    }
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
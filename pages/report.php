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
// define variables and set to empty values
$nameErr = $emailErr = "";
$name = $email = $comment = "";

#Set conditions for input values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = $_POST["name"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
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

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = $_POST["comment"];
  }
}

?>

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
        <input type="submit" name="submit" value="Send">
    </form>

    <nav><a href="../index.php">Back to main menu</a></nav>

</body>

</html>

<?php

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

#Send report
if (isset($_POST['submit']) && $nameErr=="" && $emailErr == "") {
    ini_set("SMTP",$_ENV['SMTP_URL']);
    ini_set("smtp_port",$_ENV['SMTP_PORT']);
    $passage_ligne = "<br>";
    $to = $_ENV['SMTP_TO'];

    $subject = $_POST['name'] . ' FEEDBACK ';

    $email = $_POST['email'];

    $message = 'From: ' . $_POST['name'] . $passage_ligne
              . 'Email: ' . $email . $passage_ligne 
              . $passage_ligne . "Message:" . $passage_ligne . $_POST['comment'];

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From:' . $_ENV['FROM_NOREPLY'] . "\r\n";
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
<?php #get users' message
session_start();

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();


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
    $headers .= 'Cc: ' . $_ENV['CC_MAIL_1'] . ', '.$_ENV['CC_MAIL_2'] . "\r\n";
    $headers .= 'Bcc: ' . $_ENV['BCC_MAIL'] . "\r\n";

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
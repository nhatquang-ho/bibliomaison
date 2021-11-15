<?php
session_start();
?>
<html>
<head>
  <title>ADD BOOK</title>
  <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
</head>
<body>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
<?php
if($_SESSION["name"]) {
$name=$_SESSION["username"];
?>

<?php
$isbn=$title=$year="";
$isbnErr=$titleErr=$yearErr="";

#set conditions for input values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$isbn=$title=$year="";
$isbnErr=$titleErr=$yearErr="";
  if (empty($_POST["year"])) {
    $yearErr = "Year is required";
  } else {
    $year = $_POST["year"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^(19[0-9][0-9]|20(0[0-9]|10))$/",$year)) {
      $yearErr = "incorrect year";
      echo $yearErr;
    }
  }
  if (empty($_POST["isbn"])) {
    $isbnErr = "ISBN is required";
  } else {
    $isbn = $_POST["isbn"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9]*$/",$isbn)) {
      $isbnErr = "incorrect isbn";
      echo $isbnErr;
    }
  }
  if (empty($_POST["title"])) {
    $titleErr = "Title is required";
  } else {
    $title = $_POST["title"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$title)) {
      $titleErr = "incorrect title";
    }
  }
}
?>


  Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" title="Logout">Logout.</a>
  <h1>Public Library: Create a new book:</h1>
  <form method="post" action="">
    <label>ISBN: <input name="isbn" /></label>
    <span class="error">* <?php echo $isbnErr;?></span>
  <br><br>
    <label>Title: <input name="title" /></label>
    <span class="error">* <?php echo $titleErr;?></span>
  <br><br>
    <label>Year: <input name="year" /></label>
    <span class="error">* <?php echo $yearErr;?></span>
  <br><br>
    <button type="submit" name="creatbook" value="submit">Save</button><br>
  </form>

  <nav><a href="../index.php">Back to main menu</a></nav>

</body>
</html>

<?php

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

#if no error
if(isset($_POST['creatbook']) && $isbnErr=="" && $yearErr=="" && $titleErr==""){
$link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$link) {
  die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
  die ('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
}

$isbn = $_POST['isbn'];
$title = $_POST['title'];
$year = $_POST['year'];

#Check to see if the book wanted to add exists
$existbook = mysql_query("SELECT isbn FROM $name where isbn='$isbn'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
    if(mysql_fetch_assoc($existbook)){
      die('<script>alert("Book existed!");</script>');
      echo '<script>console.log("Book existed")</script>';
    }

#add the book to the database
$sql = mysql_query("INSERT INTO $name(isbn,title,year) VALUES('$isbn','$title','$year')") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');

echo '<script>alert("Your book is successfully added");</script>';
echo '<script>console.log("Book added")</script>';
echo '<script type="text/javascript">setTimeout(function(){window.top.location="listBooks.php"} , 500);</script>';

mysql_close($link);
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

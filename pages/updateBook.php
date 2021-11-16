<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
    <title>UPDATE_BOOK</title>
</head>

<body>
    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

<?php
if($_SESSION["name"]) {
$name=$_SESSION["username"];
?>

<?php
#set conditions for input values
$year="";
$yearErr="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $isbn=$title=$year="";
  $isbnErr=$titleErr=$yearErr="";
  if (!empty($_POST["year"])) {
    $year = $_POST["year"];
    // check year valid
    if (!preg_match("/^[0-9]*$/",$year) || (int)$year > (int)date("Y") || (int)$year <= 1000) {
      $yearErr = "incorrect year (1000 - ". date("Y") ." allowed)";
    }
  }
}
?>

    Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" title="Logout">Logout.</a>
    <h1>Public Library: Update a book record</h1>
    <form method="post" action="">
        <label>ISBN: <input type="text" name="isbn" readonly="readonly" value="<?php echo $_GET['isbn']; ?>" /></label>
        <br><br>
        <label>Title: <input type="text" name="title" value="<?php echo $_GET['title']; ?>" /></label>
        <br><br>
        <label>Year: <input type="text" name="year" value="<?php echo $_GET['year']; ?>" /></label>
        <span class="error"><?php echo $yearErr;?></span>
        <br><br>
        <button type="submit" name="updbook" value="submit">Save Changes</button>
    </form>

    <br>
    <nav><a href="../index.php">Back to main menu</a></nav>

</body>

</html>


<?php

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

#Connect to the database
if(isset($_POST['updbook']) && $yearErr==""){
  $link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
  if (!$link) {
    die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
  }
  
  $db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
  if (!$db_selected) {
    die('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
  }

  $isbn = $_POST['isbn'];
  $title = $_POST['title'];
  $year = $_POST['year'];

  #get the book via isbn and update its information
  $sql=mysql_query("UPDATE $name SET title='$title', year='$year' WHERE isbn='$isbn'") or die("Erreur SQL : $sql<br/>".mysql_error());
  echo '<script>alert("Your book is successfully updated");</script>';
  echo '<script>console.log("Book isgn-' . $isbn . ' created")</script>';
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
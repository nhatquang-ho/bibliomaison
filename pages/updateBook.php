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

    Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" title="Logout">Logout.</a>
    <h1>Public Library: Update a book record</h1>
    <form method="post" action="">
        <p><label>ISBN: <input name="isbn" readonly="readonly" value="<?php echo $_GET['isbn']; ?>" /></label></p>
        <p><label>Title: <input name="title" value="<?php echo $_GET['title']; ?>" /></label></p>
        <p><label>Year: <input name="year" value="<?php echo $_GET['year']; ?>" /></label></p>
        <p><button type="submit" name="updbook" value="submit">Save Changes</button></p>
    </form>

    <nav><a href="../index.php">Back to main menu</a></nav>

</body>

</html>


<?php

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

#Connect to the database
if(isset($_POST['updbook'])){
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
<?php
session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>YOUR BOOKS</title>
  </head>
  <body>
<?php
if($_SESSION["name"]) {
$name=$_SESSION["username"];
?>
  Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" title="Logout">Logout.</a>
    <h1>Public Library: List all books</h1>

<form action="" method="post">
<input type="text" name="isbn">
<input type="submit" name="search_isbn" value="Search book isbn">
<input type="text" name="title">
<input type="submit" name="search_name" value="Search book name">
</form>

<?php

include 'loadenv.php';
$dotenv = new DotEnv('.env');
$loadvars = $dotenv->load();

$link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$link) {
    die('<br>Connexion database impossible : <br>' . mysql_error());
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
   die ('Impossible de sélectionner la base de données : <br>' . mysql_error());
}


if(isset($_GET['delbook'])){
  $isbn=$_GET['delbook'];
$sql = mysql_query('DELETE FROM '.$name.' WHERE isbn="'.$isbn.'"') or die("Erreur SQL : $sql<br/>".mysql_error());
}

if(isset($_POST['search_isbn'])){
$isbn_s=$_POST["isbn"];

$result = mysql_query("SELECT isbn,title,year FROM $name WHERE isbn='$isbn_s'") or die("Erreur SQL : $sql<br/>".mysql_error());
if (mysql_num_rows($result)>0) {
  echo '<table>';
  echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>delete_book</th><th>update_book</th></tr></h4>';
  // output data of each row
  while ($row = mysql_fetch_assoc($result)) {
    $isbn=$row["isbn"];$title=$row["title"];$year=$row["year"];
    echo '<tr><th>' . $row["isbn"]. '</th><th>' . $row["title"]. '</th><th>' . $row["year"]. '</th>
          <th><a href="?delbook='.$row["isbn"].'">del</a></th>
          <th><a href="updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">update</a></th></tr>';
  }
  echo '</table>';
}else {
  echo "0 book found";
}
}
elseif(isset($_POST['search_name'])){
$title_s=$_POST["title"];

$result = mysql_query("SELECT isbn,title,year FROM $name WHERE title='$title_s'") or die("Erreur SQL : $sql<br/>".mysql_error());
if (mysql_num_rows($result)>0) {
  echo '<table>';
  echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>delete_book</th><th>update_book</th></tr></h4>';
  // output data of each row
  while ($row = mysql_fetch_assoc($result)) {
    $isbn=$row["isbn"];$title=$row["title"];$year=$row["year"];
    echo '<tr><th>' . $row["isbn"]. '</th><th>' . $row["title"]. '</th><th>' . $row["year"]. '</th>
          <th><a href="?delbook='.$row["isbn"].'">del</a></th>
          <th><a href="updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">update</a></th></tr>';
  }
  echo '</table>';
}else {
  echo "0 book found";
}
}else{

// sql to create table
$result = mysql_query("SELECT isbn,title,year FROM $name") or die("Erreur SQL : $sql<br/>".mysql_error());
if (mysql_num_rows($result)>0) {
  echo '<table>';
  echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>delete_book</th><th>update_book</th></tr></h4>';
  // output data of each row
  while ($row = mysql_fetch_assoc($result)) {
    $isbn=$row["isbn"];$title=$row["title"];$year=$row["year"];
    echo '<tr><th>' . $row["isbn"]. '</th><th>' . $row["title"]. '</th><th>' . $row["year"]. '</th>
          <th><a href="?delbook='.$row["isbn"].'">del</a></th>
          <th><a href="updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">update</a></th></tr>';
  }
  echo '</table>';
} else {
  echo "0 book in the library";
}
}
mysql_close($link);
?>

    <nav><a href="index.php">Back to main menu</a></nav>
<?php
}else echo '<h1>Please <a href="login.php">click here</a> to login</h1>';
?>
  </body>
</html>

<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/mainpage.css">
    <title>YOUR BOOKS</title>
</head>

<body>
    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

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

include '../modules/loadenv.php';
$dotenv = new DotEnv('../.env');
$loadvars = $dotenv->load();

#Connect to database
$link = mysql_connect($_ENV['DB_URL'], $_ENV['DB_NAME'], $_ENV['DB_PASS']);
if (!$link) {
    die('<script>console.log("Impossible to connect to the database : ")' . mysql_error() . '</script>');
}

$db_selected = mysql_select_db($_ENV['DB_NAME'], $link);
if (!$db_selected) {
   die ('<script>console.log("Impossible to choose the table : ")' . mysql_error() . '</script>');
}


#Delete a book
if(isset($_GET['delbook'])){
  $isbn=$_GET['delbook'];
  $sql = mysql_query('DELETE FROM '.$name.' WHERE isbn="'.$isbn.'"') or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  echo '<script>console.log("Book isnb-'. $isbn .' deleted")</script>';
}


#Search book via isbn
if(isset($_POST['search_isbn'])){
  $isbn_s=$_POST["isbn"];

  $result = mysql_query("SELECT isbn,title,year FROM $name WHERE isbn='$isbn_s'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($result)>0) {
    echo '<table>';
    echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>Delete Book</th><th>Update Book</th></tr></h4>';

    #display results
    while ($row = mysql_fetch_assoc($result)) {
      $isbn=$row["isbn"];$title=$row["title"];$year=$row["year"];
      echo '<tr><td>' . $row["isbn"]. '</td><td>' . $row["title"]. '</td><td>' . $row["year"]. '</td>
            <td><button><a href="?delbook='.$row["isbn"].'">DEL</a></button></td>
            <td><button><a href="updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  }else {
    echo "0 book found";
  }
}

#Search book via name
elseif(isset($_POST['search_name'])){
  $title_s=$_POST["title"];

  $result = mysql_query("SELECT isbn,title,year FROM $name WHERE title='$title_s'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($result)>0) {
    echo '<table>';
    echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>Delete Book</th><th>Update Book</th></tr></h4>';
    
    #display results
    while ($row = mysql_fetch_assoc($result)) {
      $isbn=$row["isbn"];$title=$row["title"];$year=$row["year"];
      echo '<tr><td>' . $row["isbn"]. '</td><td>' . $row["title"]. '</td><td>' . $row["year"]. '</td>
            <td><button><a href="?delbook='.$row["isbn"].'">DEL</a></button></td>
            <td><button><a href="updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  }else {
    echo "0 book found";
  }
}
else {

  #Display all books
  $result = mysql_query("SELECT isbn,title,year FROM $name") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($result)>0) {
    echo '<table>';
    echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>Delete Book</th><th>Update Book</th></tr></h4>';
    
    #display results
    while ($row = mysql_fetch_assoc($result)) {
      $isbn=$row["isbn"];$title=$row["title"];$year=$row["year"];
      echo '<tr><td>' . $row["isbn"]. '</td><td>' . $row["title"]. '</td><td>' . $row["year"]. '</td>
            <td><button><a href="?delbook='.$row["isbn"].'">DEL</a></button></td>
            <td><button><a href="updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  } else {
    echo "0 book in the library";
  }
}
mysql_close($link);
?>

    <br>
    <a href="createBook.php"><button type="button">Add a new book</button></a>
    <a href="../modules/deleteAllBooks.php" onclick="return clicked()"><button type="button">Delete all
            books</button></a>
    <br><br>
    <nav><a href="../index.php">Back to main menu</a></nav>

    <script type="text/javascript">
    function clicked() {
        if (confirm('Do you want to delete all books?')) {
            return true;
        } else {
            return false;
        }
    }
    </script>

</body>

</html>

<?php
}else{
?>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
<h1>Please <a href="login.php">click here</a> to login</h1>
<?php
}
?>
<?php #display books table

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

#Delete a book
if(isset($_GET['delbook'])){
  $isbn=$_GET['delbook'];
  $sql = mysql_query('DELETE FROM '.$name.' WHERE isbn="'.$isbn.'"') or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  echo '<script>console.log("Book isnb-'. $isbn .' deleted")</script>';
}

#Search book via isbn and display
if(isset($_POST['search_isbn']) && !empty($_POST["isbn"])){
  $isbn_s=$_POST["isbn"];

  $books = mysql_query("SELECT isbn,title,year FROM $name WHERE isbn='$isbn_s'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table>';
    echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>Delete Book</th><th>Update Book</th></tr></h4>';

    while ($book = mysql_fetch_assoc($books)) {
      $isbn=$book["isbn"];$title=$book["title"];$year=$book["year"];
      echo '<tr><td>' . $book["isbn"]. '</td><td>' . $book["title"]. '</td><td>' . $book["year"]. '</td>
            <td><button><a href="?delbook='.$book["isbn"].'">DEL</a></button></td>
            <td><button><a href="updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  }else {
    echo "0 book found";
  }
}

#Search book via name and display
elseif(isset($_POST['search_name']) && !empty($_POST["title"])){
  $title_s=$_POST["title"];

  $books = mysql_query("SELECT isbn,title,year FROM $name WHERE title='$title_s'") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table>';
    echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>Delete Book</th><th>Update Book</th></tr></h4>';
    
    while ($book = mysql_fetch_assoc($books)) {
      $isbn=$book["isbn"];$title=$book["title"];$year=$book["year"];
      echo '<tr><td>' . $book["isbn"]. '</td><td>' . $book["title"]. '</td><td>' . $book["year"]. '</td>
            <td><button><a href="?delbook='.$book["isbn"].'">DEL</a></button></td>
            <td><button><a href="/pages/updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  }else {
    echo "0 book found";
  }
}
else {

  #Display all books
  $books = mysql_query("SELECT isbn,title,year FROM $name") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table>';
    echo '<h4><tr><th>ISBN</th><th>Title</th><th>Year</th><th>Delete Book</th><th>Update Book</th></tr></h4>';
    
    while ($book = mysql_fetch_assoc($books)) {
      $isbn=$book["isbn"];$title=$book["title"];$year=$book["year"];
      echo '<tr><td>' . $book["isbn"]. '</td><td>' . $book["title"]. '</td><td>' . $book["year"]. '</td>
            <td><button><a href="?delbook='.$book["isbn"].'">DEL</a></button></td>
            <td><button><a href="/pages/updateBook.php?isbn='.$isbn.'&title='.$title.'&year='.$year.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  } else {
    echo "0 book in the library";
  }
}
?>
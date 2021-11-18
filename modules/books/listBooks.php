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

  $books = mysql_query("SELECT num,isbn,title,category,year,authors,summary,last_modification FROM $name WHERE isbn='$isbn_s' ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table>';
    echo '<h4><tr><th>Num</th><th>ISBN</th><th>Title</th><th>Category</th><th>Year</th><th>Authors</th><th>Summary</th><th>Last Modification</th><th>Delete</th><th>Update</th></tr></h4>';

    while ($book = mysql_fetch_assoc($books)) {
      $num=$book["num"];$isbn=$book["isbn"];$title=$book["title"];$category=$book["category"];$year=$book["year"];$authors=$book["authors"];$summary=$book["summary"];$last_modification=$book["last_modification"];
      echo '<tr><td>' . $num . '</td><td>' . $isbn . '</td><td>' . $title . '</td><td>' . $category . '</td><td>' . $year . '</td><td>' . $authors . '</td><td>' . $summary . '</td><td>' . $last_modification . '</td>
            <td><button><a href="?delbook='. $isbn .'">DEL</a></button></td>
            <td><button><a href="/pages/updateBook.php?isbn='.$isbn.'&title='.$title.'&category='.$category.'&year='.$year.'&authors='.$authors.'&summary='.$summary.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  }else {
    echo "0 book found";
  }
}

#Search book via name and display
elseif(isset($_POST['search_name']) && !empty($_POST["title"])){
  $title_s=$_POST["title"];

  $books = mysql_query("SELECT num,isbn,title,category,year,authors,summary,last_modification FROM $name WHERE title='$title_s' ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table>';
    echo '<h4><tr><th>Num</th><th>ISBN</th><th>Title</th><th>Category</th><th>Year</th><th>Authors</th><th>Summary</th><th>Last Modification</th><th>Delete</th><th>Update</th></tr></h4>';
    
    while ($book = mysql_fetch_assoc($books)) {
      $num=$book["num"];$isbn=$book["isbn"];$title=$book["title"];$category=$book["category"];$year=$book["year"];$authors=$book["authors"];$summary=$book["summary"];$last_modification=$book["last_modification"];
      echo '<tr><td>' . $num . '</td><td>' . $isbn . '</td><td>' . $title . '</td><td>' . $category . '</td><td>' . $year . '</td><td>' . $authors . '</td><td>' . $summary . '</td><td>' . $last_modification . '</td>
            <td><button><a href="?delbook='. $isbn .'">DEL</a></button></td>
            <td><button><a href="/pages/updateBook.php?isbn='.$isbn.'&title='.$title.'&category='.$category.'&year='.$year.'&authors='.$authors.'&summary='.$summary.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  }else {
    echo "0 book found";
  }
}

#Display all books
else {
  $books = mysql_query("SELECT num,isbn,title,category,year,authors,summary,last_modification FROM $name ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table>';
    echo '<h4><tr><th>Num</th><th>ISBN</th><th>Title</th><th>Category</th><th>Year</th><th>Authors</th><th>Summary</th><th>Last Modification</th><th>Delete</th><th>Update</th></tr></h4>';
    
    while ($book = mysql_fetch_assoc($books)) {
      $num=$book["num"];$isbn=$book["isbn"];$title=$book["title"];$category=$book["category"];$year=$book["year"];$authors=$book["authors"];$summary=$book["summary"];$last_modification=$book["last_modification"];
      echo '<tr><td>' . $num . '</td><td>' . $isbn . '</td><td>' . $title . '</td><td>' . $category . '</td><td>' . $year . '</td><td>' . $authors . '</td><td>' . $summary . '</td><td>' . $last_modification . '</td>
            <td><button><a href="?delbook='. $isbn .'">DEL</a></button></td>
            <td><button><a href="/pages/updateBook.php?isbn='.$isbn.'&title='.$title.'&category='.$category.'&year='.$year.'&authors='.$authors.'&summary='.$summary.'">UPDATE</a></button></td></tr>';
    }
    echo '</table>';
  } else {
    echo "0 book in the library";
  }
}
?>
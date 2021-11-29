<?php #display books table

#load .env
include $_SERVER['DOCUMENT_ROOT'].'/modules/loadenv.php';
$dotenv = new DotEnv($_SERVER['DOCUMENT_ROOT'].'/.env');
$loadvars = $dotenv->load();

$name=$_SESSION["username"];

include $_SERVER['DOCUMENT_ROOT']."/modules/connectDB.php";

if(isset($_POST['search_isbn']) && !empty($_POST['isbn'])){
  $isbn_s = $_POST['isbn'];
  echo '<script type="text/javascript">setTimeout(function(){window.top.location="'. $_SERVER['PHP_SELF'] . '?search=isbn&isbn_s='. $isbn_s .'&sort=title_asc"} , 0);</script>';
}
if(isset($_POST['search_title']) && !empty($_POST['title'])){
  $title_s = $_POST['title'];
  echo '<script type="text/javascript">setTimeout(function(){window.top.location="'. $_SERVER['PHP_SELF'] . '?search=title&title_s='. $title_s .'&sort=title_asc"} , 0);</script>';
}
if(isset($_POST['search_category'])){
  if ($_POST['category'] == "Other"){
    if (!empty($_POST['category-other'])){
      $category_s = $_POST['category-other'];
      echo '<script type="text/javascript">setTimeout(function(){window.top.location="'. $_SERVER['PHP_SELF'] . '?search=category&category_s='. $category_s .'&sort=title_asc"} , 0);</script>';
    }
    else {
      break;
    }
  }
  else {
    $category_s = $_POST['category'];
    echo '<script type="text/javascript">setTimeout(function(){window.top.location="'. $_SERVER['PHP_SELF'] . '?search=category&category_s='. $category_s .'&sort=title_asc"} , 0);</script>';
  }
}


#Delete a book
if(isset($_GET['delbook'])){
  $isbn=$_GET['delbook'];
  $sql = mysql_query('DELETE FROM '.$name.' WHERE isbn="'.$isbn.'"') or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  $query = $_GET;
  unset($query['delbook']);
  $query = http_build_query($query);
  echo '<script>console.log("Book isnb-'. $isbn .' deleted")</script>';
  echo '<script type="text/javascript">setTimeout(function(){window.top.location="'. $_SERVER['PHP_SELF'] . '?' . $query .'"} , 0);</script>';
}


$query = $_GET;

#Display books list
switch ($_GET['search']) {
  case "isbn":
    $isbn_s = $_GET['isbn_s'];
    switch ($_GET['sort']){
      case "title_asc":
        $books = mysql_query("SELECT * FROM $name WHERE isbn='$isbn_s' ORDER BY title ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "title_desc";
        $query_title_sort = http_build_query($query);
        break;
      case "title_desc":
        $books = mysql_query("SELECT * FROM $name WHERE isbn='$isbn_s' ORDER BY title DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "title_asc";
        $query_title_sort = http_build_query($query);
        break;
      case "year_asc":
        $books = mysql_query("SELECT * FROM $name WHERE isbn='$isbn_s' ORDER BY year ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "year_desc";
        $query_year_sort = http_build_query($query);
        break;
      case "year_desc":
        $books = mysql_query("SELECT * FROM $name WHERE isbn='$isbn_s' ORDER BY year DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "year_asc";
        $query_year_sort = http_build_query($query);
        break;
      case "authors_asc":
        $books = mysql_query("SELECT * FROM $name WHERE isbn='$isbn_s' ORDER BY authors ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "authors_desc";
        $query_authors_sort = http_build_query($query);
        break;
      case "authors_desc":
        $books = mysql_query("SELECT * FROM $name WHERE isbn='$isbn_s' ORDER BY authors DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "authors_asc";
        $query_authors_sort = http_build_query($query);
        break;
      default:
        $books = mysql_query("SELECT * FROM $name WHERE isbn='$isbn_s' ORDER BY title ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        break;
    }
    break;
  case "title":
    $title_s = $_GET['title_s'];
    switch ($_GET['sort']) {
      case "title_asc":
        $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY title ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "title_desc";
        $query_title_sort = http_build_query($query);
        break;
      case "title_desc": 
        $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY title DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "title_asc";
        $query_title_sort = http_build_query($query);
        break;
      case "year_asc":
        $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY year ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "year_desc";
        $query_year_sort = http_build_query($query);
        break;
      case "year_desc":
        $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY year DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "year_asc";
        $query_year_sort = http_build_query($query);
        break;
      case "authors_asc":
        $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY authors ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "authors_desc";
        $query_authors_sort = http_build_query($query);
        break;
      case "authors_desc":
        $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY authors DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "authors_asc";
        $query_authors_sort = http_build_query($query);
        break;
      default:
        $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY title ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        break;
    }
    break;
  case "category":
    $category_s = $_GET['category_s'];
    switch ($_GET['sort']) {
      case "title_asc":
        $books = mysql_query("SELECT * FROM $name WHERE category='$category_s' ORDER BY title ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "title_desc";
        $query_title_sort = http_build_query($query);
        break;
      case "title_desc": 
        $books = mysql_query("SELECT * FROM $name WHERE category='$category_s' ORDER BY title DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "title_asc";
        $query_title_sort = http_build_query($query);
        break;
      case "year_asc":
        $books = mysql_query("SELECT * FROM $name WHERE category='$category_s' ORDER BY year ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "year_desc";
        $query_year_sort = http_build_query($query);
        break;
      case "year_desc":
        $books = mysql_query("SELECT * FROM $name WHERE category='$category_s' ORDER BY year DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "year_asc";
        $query_year_sort = http_build_query($query);
        break;
      case "authors_asc":
        $books = mysql_query("SELECT * FROM $name WHERE category='$category_s' ORDER BY authors ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "authors_desc";
        $query_authors_sort = http_build_query($query);
        break;
      case "authors_desc":
        $books = mysql_query("SELECT * FROM $name WHERE category='$category_s' ORDER BY authors DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "authors_asc";
        $query_authors_sort = http_build_query($query);
        break;
      default:
        $books = mysql_query("SELECT * FROM $name WHERE category='$category_s' ORDER BY title ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        break;
    }
    break;
  default:
    switch ($_GET['sort']) {
      case "title_asc":
        $books = mysql_query("SELECT * FROM $name ORDER BY title ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "title_desc";
        $query_title_sort = http_build_query($query);
        break;
      case "title_desc": 
        $books = mysql_query("SELECT * FROM $name ORDER BY title DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "title_asc";
        $query_title_sort = http_build_query($query);
        break;
      case "year_asc":
        $books = mysql_query("SELECT * FROM $name ORDER BY year ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "year_desc";
        $query_year_sort = http_build_query($query);
        break;
      case "year_desc":
        $books = mysql_query("SELECT * FROM $name ORDER BY year DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "year_asc";
        $query_year_sort = http_build_query($query);
        break;
      case "authors_asc":
        $books = mysql_query("SELECT * FROM $name ORDER BY authors ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "authors_desc";
        $query_authors_sort = http_build_query($query);
        break;
      case "authors_desc":
        $books = mysql_query("SELECT * FROM $name ORDER BY authors DESC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        $query['sort'] = "authors_asc";
        $query_authors_sort = http_build_query($query);
        break;
      default:
        $books = mysql_query("SELECT * FROM $name ORDER BY title ASC") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
        break;
    }
    break;
}

if ($query_title_sort == ""){
  if ($query['sort'] == ""){
    $query['sort'] = "title_desc";
  } else {
    $query['sort'] = "title_asc";
  }
  $query_title_sort = http_build_query($query);
}
if ($query_year_sort == ""){
  $query['sort'] = "year_asc";
  $query_year_sort = http_build_query($query);
}
if ($query_authors_sort == ""){
  $query['sort'] = "authors_asc";
  $query_authors_sort = http_build_query($query);
}

if (mysql_num_rows($books) > 0) {
  
  echo '<table style="width:100%" id="myTable">';
  echo '<tr>
          <th>Num</th>
          <th>ISBN</th>
          <th class="column-sort">
            <a href="'. $_SERVER['PHP_SELF'] . '?' . $query_title_sort .'">Title↕</a>
          </th>
          <th>Category</th>
          <th class="column-sort">
            <a href="'. $_SERVER['PHP_SELF'] . '?' . $query_year_sort .'">Year↕</a>
          </th>
          <th>Edition</th>
          <th class="column-sort">
            <a href="'. $_SERVER['PHP_SELF'] . '?' . $query_authors_sort .'">Authors↕</a>
          </th>
          <th>Last Modification</th>
          <th>Delete</th>
          <th>Update</th>
        </tr>';
    
  $num_row = 1;
  while ($book = mysql_fetch_assoc($books)) {
    $isbn=$book["isbn"];$title=$book["title"];$category=$book["category"];$year=$book["year"];$edition=$book['edition'];$authors=$book["authors"];$last_modification=$book["last_modification"];
    echo '<tr class="row-hover"><td>' . $num_row . '</td>
          <td><a href="/pages/displayBook.php?isbn=' . $isbn . '">' . $isbn . '</a></td>
          <td><a href="/pages/displayBook.php?isbn=' . $isbn . '">' . $title . '</a></td>
          <td>' . $category . '</td><td>' . $year . '</td><td>' . $edition . '</td><td>' . $authors . '</td>
          <td>' . date('d-m-Y H:i', strtotime($last_modification)) . '</td>
          <td><a href="'. $_SERVER['REQUEST_URI'] .'&delbook='. $isbn .'" onclick="return ConfirmDeleteOne(\''. $isbn .'\')"><input type="image" src="/assets/images/delete.png" /></a></td>
          <td><a href="/pages/updateBook.php?isbn='.$isbn.'"><input type="image" src="/assets/images/update.png" /></a></td></tr>';
    $num_row = $num_row + 1;
  }
  echo '</table>';
} else {
  echo "0 book found<br>";
}
?>
<script>
function ConfirmDeleteOne(value) {
        if (confirm('Do you want to delete this book? (ISBN: '+ value +')')) {
            return true;
        } else {
            return false;
        }
}
</script>
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

  $books = mysql_query("SELECT * FROM $name WHERE isbn='$isbn_s' ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table style="width:100%" id="myTable">';
    echo '<tr>
                <th class="column-sort" onclick="sortTable(0)">Num↕</th>
                <th>ISBN</th>
                <th class="column-sort" onclick="sortTable(2)">Title↕</th>
                <th>Category</th>
                <th class="column-sort" onclick="sortTable(4)">Year↕</th>
                <th>Edition</th>
                <th class="column-sort" onclick="sortTable(6)">Authors↕</th>
                <th>Summary</th>
                <th>Last Modification</th>
                <th>Delete</th>
                <th>Update</th>
          </tr>';

    $num_row = 0;
    while ($book = mysql_fetch_assoc($books)) {
      $num=$book["num"];$isbn=$book["isbn"];$title=$book["title"];$category=$book["category"];$year=$book["year"];$edition=$book['edition'];$authors=$book["authors"];$summary=$book["summary"];$last_modification=$book["last_modification"];
      echo '<tr><td>' . $num . '</td><td>' . $isbn . '</td><td>' . $title . '</td><td>' . $category . '</td><td>' . $year . '</td><td>' . $edition . '</td><td>' . $authors . '</td>
            <td>'.
            '<p id="summary-'. $num_row .'" style="display:none;">'. $summary .'</p>'.
            '<a href="#" id="summary-button-'. $num_row .'" onclick="show_text_'. $num_row .'()">..more..</a>
            <script>
            function show_text_'. $num_row .'(){
              var x = document.getElementById("summary-'. $num_row .'");
              if(x.style.display == "none"){
                x.style.display = "block";
                document.getElementById("summary-button-'. $num_row .'").innerHTML = "..less..";
              }
              else{
                x.style.display = "none";
                document.getElementById("summary-button-'. $num_row .'").innerHTML = "..more..";
              }
              
            }
            </script>'.
            '</td>
            <td>' . date('d-m-Y H:i', strtotime($last_modification)) . '</td>
            <td><a href="?delbook='. $isbn .'" onclick="return ConfirmDeleteOne('. $isbn .')"><input type="image" src="/assets/images/delete.png" /></a></td>
            <td><a href="/pages/updateBook.php?isbn='.$isbn.'"><input type="image" src="/assets/images/update.png" /></a></td></tr>';
      $num_row = $num_row + 1;
    }
    echo '</table>';
  }else {
    echo "0 book found<br>";
  }
}

#Search book via title and display
elseif(isset($_POST['search_title']) && !empty($_POST["title"])){
  $title_s=$_POST["title"];

  $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table style="width:100%" id="myTable">';
    echo '<tr>
                <th class="column-sort" onclick="sortTable(0)">Num↕</th>
                <th>ISBN</th>
                <th class="column-sort" onclick="sortTable(2)">Title↕</th>
                <th>Category</th>
                <th class="column-sort" onclick="sortTable(4)">Year↕</th>
                <th>Edition</th>
                <th class="column-sort" onclick="sortTable(6)">Authors↕</th>
                <th>Summary</th>
                <th>Last Modification</th>
                <th>Delete</th>
                <th>Update</th>
          </tr>';
    
    $num_row = 0;
    while ($book = mysql_fetch_assoc($books)) {
      $num=$book["num"];$isbn=$book["isbn"];$title=$book["title"];$category=$book["category"];$year=$book["year"];$edition=$book['edition'];$authors=$book["authors"];$summary=$book["summary"];$last_modification=$book["last_modification"];
      echo '<tr><td>' . $num . '</td><td>' . $isbn . '</td><td>' . $title . '</td><td>' . $category . '</td><td>' . $year . '</td><td>' . $edition . '</td><td>' . $authors . '</td>
            <td>'.
            '<p id="summary-'. $num_row .'" style="display:none;">'. $summary .'</p>'.
            '<a href="#" id="summary-button-'. $num_row .'" onclick="show_text_'. $num_row .'()">..more..</a>
            <script>
            function show_text_'. $num_row .'(){
              var x = document.getElementById("summary-'. $num_row .'");
              if(x.style.display == "none"){
                x.style.display = "block";
                document.getElementById("summary-button-'. $num_row .'").innerHTML = "..less..";
              }
              else{
                x.style.display = "none";
                document.getElementById("summary-button-'. $num_row .'").innerHTML = "..more..";
              }
              
            }
            </script>'.
            '</td>
            <td>' . date('d-m-Y H:i', strtotime($last_modification)) . '</td>
            <td><a href="?delbook='. $isbn .'" onclick="return ConfirmDeleteOne('. $isbn .')"><input type="image" src="/assets/images/delete.png" /></a></td>
            <td><a href="/pages/updateBook.php?isbn='.$isbn.'"><input type="image" src="/assets/images/update.png" /></a></td></tr>';
      $num_row = $num_row + 1;
    }
    echo '</table>';
  }else {
    echo "0 book found<br>";
  }
}

#Search book via category and display
elseif(isset($_POST['search_category']) && !empty($_POST["category"])){
  $category_s = $_POST["category"];
  if ($category_s == "Other" && !empty($_POST["category-other"])){
    $category_s = $_POST["category-other"]; 
  }

  $books = mysql_query("SELECT * FROM $name WHERE category='$category_s' ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table style="width:100%" id="myTable">';
    echo '<tr>
                <th class="column-sort" onclick="sortTable(0)">Num↕</th>
                <th>ISBN</th>
                <th class="column-sort" onclick="sortTable(2)">Title↕</th>
                <th>Category</th>
                <th class="column-sort" onclick="sortTable(4)">Year↕</th>
                <th>Edition</th>
                <th class="column-sort" onclick="sortTable(6)">Authors↕</th>
                <th>Summary</th>
                <th>Last Modification</th>
                <th>Delete</th>
                <th>Update</th>
          </tr>';
    
    $num_row = 0;
    while ($book = mysql_fetch_assoc($books)) {
      $num=$book["num"];$isbn=$book["isbn"];$title=$book["title"];$category=$book["category"];$year=$book["year"];$edition=$book['edition'];$authors=$book["authors"];$summary=$book["summary"];$last_modification=$book["last_modification"];
      echo '<tr><td>' . $num . '</td><td>' . $isbn . '</td><td>' . $title . '</td><td>' . $category . '</td><td>' . $year . '</td><td>' . $edition . '</td><td>' . $authors . '</td>
            <td>'.
            '<p id="summary-'. $num_row .'" style="display:none;">'. $summary .'</p>'.
            '<a href="#" id="summary-button-'. $num_row .'" onclick="show_text_'. $num_row .'()">..more..</a>
            <script>
            function show_text_'. $num_row .'(){
              var x = document.getElementById("summary-'. $num_row .'");
              if(x.style.display == "none"){
                x.style.display = "block";
                document.getElementById("summary-button-'. $num_row .'").innerHTML = "..less..";
              }
              else{
                x.style.display = "none";
                document.getElementById("summary-button-'. $num_row .'").innerHTML = "..more..";
              }
              
            }
            </script>'.
            '</td>
            <td>' . date('d-m-Y H:i', strtotime($last_modification)) . '</td>
            <td><a href="?delbook='. $isbn .'" onclick="return ConfirmDeleteOne('. $isbn .')"><input type="image" src="/assets/images/delete.png" /></a></td>
            <td><a href="/pages/updateBook.php?isbn='.$isbn.'"><input type="image" src="/assets/images/update.png" /></a></td></tr>';
      $num_row = $num_row + 1;
    }
    echo '</table>';
  }else {
    echo "0 book found<br>";
  }
}

#Display all books
else {
  $books = mysql_query("SELECT * FROM $name ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table style="width:100%" id="myTable">';
    echo '<tr>
                <th class="column-sort" onclick="sortTable(0)">Num↕</th>
                <th>ISBN</th>
                <th class="column-sort" onclick="sortTable(2)">Title↕</th>
                <th>Category</th>
                <th class="column-sort" onclick="sortTable(4)">Year↕</th>
                <th>Edition</th>
                <th class="column-sort" onclick="sortTable(6)">Authors↕</th>
                <th>Summary</th>
                <th>Last Modification</th>
                <th>Delete</th>
                <th>Update</th>
          </tr>';
    
    $num_row = 0;
    while ($book = mysql_fetch_assoc($books)) {
      $num=$book["num"];$isbn=$book["isbn"];$title=$book["title"];$category=$book["category"];$year=$book["year"];$edition=$book['edition'];$authors=$book["authors"];$summary=$book["summary"];$last_modification=$book["last_modification"];
      echo '<tr><td>' . $num . '</td><td>' . $isbn . '</td><td>' . $title . '</td><td>' . $category . '</td><td>' . $year . '</td><td>' . $edition . '</td><td>' . $authors . '</td>
            <td>'.
            '<p id="summary-'. $num_row .'" style="display:none;">'. $summary .'</p>'.
            '<a href="#" id="summary-button-'. $num_row .'" onclick="show_text_'. $num_row .'()">..more..</a>
            <script>
            function show_text_'. $num_row .'(){
              var x = document.getElementById("summary-'. $num_row .'");
              if(x.style.display == "none"){
                x.style.display = "block";
                document.getElementById("summary-button-'. $num_row .'").innerHTML = "..less..";
              }
              else{
                x.style.display = "none";
                document.getElementById("summary-button-'. $num_row .'").innerHTML = "..more..";
              }
              
            }
            </script>'.
            '</td>
            <td>' . date('d-m-Y H:i', strtotime($last_modification)) . '</td>
            <td><a href="?delbook='. $isbn .'" onclick="return ConfirmDeleteOne('. $isbn .')"><input type="image" src="/assets/images/delete.png" /></a></td>
            <td><a href="/pages/updateBook.php?isbn='.$isbn.'"><input type="image" src="/assets/images/update.png" /></a></td></tr>';
      $num_row = $num_row + 1;
    }
    echo '</table>';
  } else {
    echo "0 book in the library<br>";
  }
}
?>
<script>
function sortTable(index) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[index];
      y = rows[i + 1].getElementsByTagName("TD")[index];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
  if(dir == "desc"){
    let name = rows[0].getElementsByTagName("TH")[index].innerHTML = rows[0].getElementsByTagName("TH")[index].innerHTML;
    name = name.substring(0, name.length-1) + "↑";
    rows[0].getElementsByTagName("TH")[index].innerHTML = rows[0].getElementsByTagName("TH")[index].innerHTML = name;
  }
  else {
    let name = rows[0].getElementsByTagName("TH")[index].innerHTML = rows[0].getElementsByTagName("TH")[index].innerHTML;
    name = name.substring(0, name.length-1) + "↓";
    rows[0].getElementsByTagName("TH")[index].innerHTML = rows[0].getElementsByTagName("TH")[index].innerHTML = name;
  }
}

function ConfirmDeleteOne(isbn) {
        if (confirm('Do you want to delete this book? (ISBN: '+ isbn +')')) {
            return true;
        } else {
            return false;
        }
    }
</script>
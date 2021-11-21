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
    echo '<table style="width:100%">';
    echo '<h4><tr><th>STT</th><th>ISBN</th><th>Tựa đề</th><th>Thể loại</th><th>Năm</th><th>Nhà xuất bản</th><th>Tác giả</th><th>Tóm tắt</th><th>Lần sửa cuối</th><th>Xóa</th><th>Sửa</th></tr></h4>';

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
            <td><a href="?delbook='. $isbn .'"><input type="image" src="/assets/images/delete.png" /></a></td>
            <td><a href="/vn/pages/updateBook.php?isbn='.$isbn.'"><input type="image" src="/assets/images/update.png" /></a></td></tr>';
      $num_row = $num_row + 1;
    }
    echo '</table>';
  }else {
    echo "Không tìm thấy sách<br>";
  }
}

#Search book via name and display
elseif(isset($_POST['search_title']) && !empty($_POST["title"])){
  $title_s=$_POST["title"];

  $books = mysql_query("SELECT * FROM $name WHERE title LIKE '%$title_s%' ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table style="width:100%">';
    echo '<h4><tr><th>STT</th><th>ISBN</th><th>Tựa đề</th><th>Thể loại</th><th>Năm</th><th>Nhà xuất bản</th><th>Tác giả</th><th>Tóm tắt</th><th>Lần sửa cuối</th><th>Xóa</th><th>Sửa</th></tr></h4>';
    
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
            <td><a href="?delbook='. $isbn .'"><input type="image" src="/assets/images/delete.png" /></a></td>
            <td><a href="/vn/pages/updateBook.php?isbn='.$isbn.'"><input type="image" src="/assets/images/update.png" /></a></td></tr>';
      $num_row = $num_row + 1;
    }
    echo '</table>';
  }else {
    echo "Không tìm thấy sách<br>";
  }
}

#Display all books
else {
  $books = mysql_query("SELECT * FROM $name ORDER BY num") or die('<script>console.log("Error SQL : ")' . mysql_error() . '</script>');
  if (mysql_num_rows($books)>0) {
    echo '<table style="width:100%">';
    echo '<h4><tr><th>STT</th><th>ISBN</th><th>Tựa đề</th><th>Thể loại</th><th>Năm</th><th>Nhà xuất bản</th><th>Tác giả</th><th>Tóm tắt</th><th>Lần sửa cuối</th><th>Xóa</th><th>Sửa</th></tr></h4>';
    
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
            <td><a href="?delbook='. $isbn .'"><input type="image" src="/assets/images/delete.png" /></a></td>
            <td><a href="/vn/pages/updateBook.php?isbn='.$isbn.'"><input type="image" src="/assets/images/update.png" /></a></td></tr>';
      $num_row = $num_row + 1;
    }
    echo '</table>';
  } else {
    echo "Chưa có sách<br>";
  }
}
?>
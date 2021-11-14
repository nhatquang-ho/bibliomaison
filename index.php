<?php
session_start();
?>
<html>
<head>
<title>HOME PAGE</title>
<link rel="stylesheet" type="text/css" href="mainpage.css">
</head>
<body>

<?php
if($_SESSION["name"]) {
?>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="logout.php" title="Logout">Logout.</a><br>
<a href="options.php"><button type="button">Parameters</button></a>
  <hgroup>
   <h1>Home library</h1>
   <h2>Books App</h2>
  </hgroup>

    <menu>
      <li><a href="listBooks.php"><button type="button">List all books</button></a></li>
      <li><a href="createBook.php"><button type="button">Add a new book</button></a></li>
      <li><a href="deleteAllBooks.php" onclick="return clicked()"><button type="button">Delete all books</button></a></li>
    </menu>

    <footer style="font-size: small;">
     <hr />
     <div>Created in 2020</div>
     <a href="report.php">Report problems</a>
    </footer>


<script type="text/javascript">
    function clicked() {
       if (confirm('Do you want to delete all books?')) {
           return true;
       } else {
           return false;
       }
    }

</script>

<?php
}else{
?>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
<h1>Please <a href="login.php">click here</a> to login</h1>
<?php
} 
?>
</body>
</html>

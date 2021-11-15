<?php
session_start();
?>
<html>
<head>
<title>HOME PAGE</title>
<link rel="stylesheet" type="text/css" href="css/mainpage.css">
</head>
<body>

<?php
if($_SESSION["name"]) {
?>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
Welcome <?php echo $_SESSION["name"]; ?>. Click here to <a href="pages/logout.php" title="Logout">Logout.</a><br>
<a href="pages/options.php"><button type="button">Parameters</button></a>
  <hgroup>
   <h1>Home library</h1>
   <h2>Books App</h2>
  </hgroup>

    <menu>
      <li><a href="pages/listBooks.php"><button type="button">List all books</button></a></li>
    </menu>

    <footer>
     <hr />
     <div>Created in 2020</div>
     <a href="pages/report.php">Report problems</a>
    </footer>


<?php
}else{
?>
<a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
<h1>Please <a href="pages/login.php">click here</a> to login</h1>
<?php
} 
?>
</body>
</html>

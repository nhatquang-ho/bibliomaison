<?php
session_start();
?>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>HOME PAGE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>

<?php
if($_SESSION["name"]) {
?>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/header.php";
?>

    <a href="/pages/options.php"><input onmouseover="Show_text()" onmouseout="Hide_text()" type="image" src="/assets/images/parameters.png" /></a>
    <span id="hidden-text" class="hidden-text">Parameters</span>
    <hgroup>
        <h1>Home library</h1>
        <h2>Feel free to add your books</h2>
    </hgroup>

    <menu>
        <li><a href="/pages/listBooks.php"><button type="button">List all books</button></a></li>
    </menu>

    <script>
        function Show_text() {
            var x = document.getElementById("hidden-text");
            x.classList.remove("hidden-text");
        }
        function Hide_text() {
            var x = document.getElementById("hidden-text");
            x.classList.add("hidden-text");
        }
    </script>

</body>

<?php
include $_SERVER['DOCUMENT_ROOT']."/include/footer.php";
?>

</html>


<?php
}else{
include $_SERVER['DOCUMENT_ROOT']."/include/start_page.php";
} 
?>
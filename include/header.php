<a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
Welcome <b><?php echo $_SESSION["name"]; ?> </b><a href="/pages/logout.php"><button class="button-logout"
        type="button">LOGOUT</button></a> | 

<?php
$path = "/vn" . $_SERVER['REQUEST_URI'];
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button"><b>EN</b> ↔ VN </button></a>
<br>

<?php
if ($_SERVER['REQUEST_URI'] != "/pages/options.php" && $_SERVER['REQUEST_URI'] != "/pages/password.php"){
?>
<a href="/pages/options.php"><input onmouseover="Show_text()" onmouseout="Hide_text()" type="image"
        src="/assets/images/parameters.png" /></a>
<span id="hidden-text" class="hidden-text">Parameters</span>
<?php
}
?>

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
<a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>
Chào mừng <b><?php echo $_SESSION["name"]; ?> </b><a href="/vn/pages/logout.php"><button class="button-logout"
        type="button">Đăng xuất</button></a> | 

<?php
$_SERVER["lang"] = "VN";
$path = substr($_SERVER['REQUEST_URI'],3);
?>
<a href="<?php echo $path; ?>"><button class="button-lang" type="button">EN ↔ <b>VN</b> </button></a>
<br>

<?php
if ($_SERVER['REQUEST_URI'] != "/vn/pages/options.php" && $_SERVER['REQUEST_URI'] != "/vn/pages/profileSettings.php"){
?>
<a href="/vn/pages/options.php"><input onmouseover="Show_text()" onmouseout="Hide_text()" type="image"
        src="/assets/images/parameters.png" /></a>
<span id="hidden-text" class="hidden-text">Cài đặt</span>
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
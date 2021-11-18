<?php include $_SERVER['DOCUMENT_ROOT']."/modules/sendreport.php" ?>

<html>

<head>
    <title>REPORT</title>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
</head>

<body>
    <a class="text-right" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <h2>Please enter the information below</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        Name: <input type="text" name="name">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        E-mail: <input type="text" name="email">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Comment: <textarea name="comment" rows="5" cols="40"></textarea>
        <br><br>
        <input type="submit" name="submit" value="Send">
    </form>

    <nav><a href="/index.php">Back to main menu</a></nav>

</body>

</html>
<?php include $_SERVER['DOCUMENT_ROOT']."/modules/sendreport.php" ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css">
    <title>REPORT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <a class="github-link" href="https://github.com/nhatquang-ho/bibliomaison/">GitHub</a>

    <h2>Please enter the information below</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action="">
        Name: <input type="text" name="name" maxlength="30">
        <span class="error">* <?php echo $nameErr;?></span>
        <br><br>
        E-mail: <input type="text" name="email" maxlength="30">
        <span class="error">* <?php echo $emailErr;?></span>
        <br><br>
        Comment: <textarea name="comment" rows="5" cols="40" maxlength="2000"></textarea>
        <br><br>
        <input type="submit" name="submit" value="Send">
    </form>

    <nav><a href="/index.php">Back to main menu</a></nav>

</body>

</html>
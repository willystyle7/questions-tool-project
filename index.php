<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.ico" />
    <title>Questions Tool</title>
    <script src="scripts/titlebar.js"></script>
</head>
<body>
    <?php
        echo "Questions Tool Project";
    ?>
    <form action="index.php" method="get">
        <input type="text" name="usrname" placeholder="Username"><br>
        <input type="password" name="passwd" placeholder="Password"><br>
        <input type="submit" name="Submit"><br>   
    </form>
    <?php
        echo '<pre>'.print_r($_GET, true).'</pre>';
    ?>
</body>
</html>
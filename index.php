<?php 
    session_start();
?>
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
        echo "Questions Tool Project".'<br>';
        if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true) {
            echo '<a href="logout.php">Logout</a>';
            echo '<h3>List Questions</h3>';
            // TODO List Questions
        } else {
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo "Wrong username or password";
            }
            ?>
            <form action="login.php" method="post">
                <input type="text" name="usrname" placeholder="Username"><br>
                <input type="password" name="passwd" placeholder="Password"><br>
                <input type="submit" name="Submit"><br>   
            </form>
            <a href="register.php">Register New User<a>
            <?php
        }
    ?>
    
</body>
</html>
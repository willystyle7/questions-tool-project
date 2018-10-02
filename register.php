<?php 
    session_start();
    if (isset($_POST['usrname']) && strlen($_POST['usrname']) < 5) {
        header('Location: register.php?error=3');
    }
    if (isset($_POST['passwd']) && isset($_POST['passwd2']) && $_POST['passwd'] != $_POST['passwd2']) {
        header('Location: register.php?error=4');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Questions Tool</title>
</head>
<body>
    <h4>Registration Form</h4>
    <form action="register.php" method="post">
        <input type="text" name="usrname" placeholder="Username"><br>
        <input type="password" name="passwd" placeholder="Password"><br>
        <input type="password" name="passwd2" placeholder="Retype Password"><br>
        <input type="text" name="fullName" placeholder="fullNname"><br>
        <input type="text" name="email" placeholder="Email"><br>
        <input type="submit" name="Submit"><br>   
    </form>
</body>
</html>
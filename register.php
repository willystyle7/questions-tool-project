<?php
session_start();
include('functions.php');
//my_header('Questions Tool');

if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']==true) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['register']) && $_POST['register']=="Register") {
    //var_dump($_POST); 
    $username = addslashes(trim($_POST['username']));
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);
    $email = addslashes(trim($_POST['email']));
    $full_name = addslashes(trim($_POST['full_name']));
    if (strlen($username) < 5 || strlen($username) > 40) {
        $error_array['username'] = 'Invalid username, should be more then 4 characters';
    }
    if ((bool)!preg_match("/^\w+$/", $username)) {
        $error_array['username'] = 'Username could contain only word characters';
        $username = preg_replace('/\W+/', "", $username);
    }
    if (strlen($password) < 5 || strlen($password) > 40) {
        $error_array['password'] = 'Invalid password, should be more then 4 characters';
    }
    if ($password!=$password2) {
        $error_array['passwords_not_match'] = 'Passwords didn\'t match';
    }
    //if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if ((bool)!preg_match('/[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z]{2,4}/', $email)) {
        $error_array['email'] = 'Invalid email';
    }
    if ((bool)!preg_match("/^([A-Z][a-z]+){0,1}(\s[A-Z][a-z]+){0,2}$/", $full_name)) {
        $error_array['full_name'] = 'Incorrect Full Name, better reg without';
    }

    if (!isset($error_array)) {
        $link = db_init();
        //$sql = 'SELECT COUNT(*) as cnt FROM users WHERE username="'.$username.'" OR email="'.$email.'";';
        $sql1 = 'SELECT COUNT(*) as cnt FROM users WHERE username="'.$username.'";';
        $sql2 = 'SELECT COUNT(*) as cnt FROM users WHERE email="'.$email.'";';
        $result1 = mysqli_query($link, $sql1);
        $result2 = mysqli_query($link, $sql2);
        $row1 = mysqli_fetch_assoc($result1);
        $row2 = mysqli_fetch_assoc($result2);        
        if ($row1['cnt'] != 0) {
            $error_array['username'] = 'This username is not available';
        } elseif ($row2['cnt'] != 0) {
            $error_array['email'] = 'This email is already used';
        } else {
            $sql = 'INSERT INTO users (username, password, email, full_name, date_registered, type, active) ';
            $sql .= 'VALUES ("'.$username.'", "'.md5($password).'", "'.$email.'", "'.$full_name.'", '.time().', 1, 1);';
            echo $sql.PHP_EOL;
            $result = mysqli_query($link, $sql);
            if (!$result) {
                //echo "Error with Database";
                $error_array['db'] = 'Error with Database';
                exit();
            }
            $_SESSION['is_registered']=true;            
            header('Location: index.php');
            exit;
        }
    }
} 
my_header('Questions Tool');
    ?>
<h2>Questions Tool Project</h2> 
<h4>Registration Form</h4>
<form action="register.php" method="post">
    <input type="text" name="username" placeholder="Username" value="<?php if(isset($username)) echo $username;?>"><br>
    <?php if (isset($error_array['username'])) echo '<span class="alert">'.$error_array['username'].'</span><br>';?>
    <input type="password" name="password" placeholder="Password" value="<?php if(isset($password)) echo $password;?>"><br>
    <?php if (isset($error_array['password'])) echo '<span class="alert">'.$error_array['password'].'</span><br>';?>
    <input type="password" name="password2" placeholder="Retype Password" value="<?php if(isset($password2)) echo $password2;?>"><br>
    <?php if (isset($error_array['passwords_not_match'])) echo '<span class="alert">'.$error_array['passwords_not_match'].'</span><br>';?>
    <input type="text" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email;?>"><br>
    <?php if (isset($error_array['email'])) echo '<span class="alert">'.$error_array['email'].'</span><br>';?>
    <input type="text" name="full_name" placeholder="Full Name" value="<?php if(isset($full_name)) echo $full_name;?>"><br>
    <?php if (isset($error_array['full_name'])) echo '<span class="alert">'.$error_array['full_name'].'</span><br>';?>
    <input type="submit" name="register" value="Register"><br>
    <?php if (isset($error_array['db'])) echo '<span class="alert">'.$error_array['db'].'</span><br>';?>
    <br>
    <a href="index.php">Back to Login<a><br>
</form>

<?php
my_footer();

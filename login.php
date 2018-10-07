<?php 
session_start();
include('functions.php');

if (isset($_POST['login']) && $_POST['login']=="Login") {
    $username = addslashes(trim($_POST['username']));
    $password = trim($_POST['password']);    
    $link = db_init();
    $sql = 'SELECT COUNT(*) as cnt FROM users WHERE username="'.$username.'" AND password="'.md5($password).'";';
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    //print_r($row);
    if ($row['cnt'] == 1) {
        $_SESSION['is_logged'] = true;
        $_SESSION['user'] = $username;
        header('Location: main.php');
    } else {
        $error_array['wrong_login'] = 'Wrong username or password';        
    }

}
my_header('Questions Tool');
    ?>

<h2>Questions Tool Project</h2>
<?php
if (isset($_SESSION['is_registered']) && $_SESSION['is_registered'] == true) {
    echo "Succesfully registered".'<br>';
    $_SESSION['is_registered'] = false;
}
    ?>
<?php if (isset($error_array['wrong_login'])) echo '<span class="alert">'.$error_array['wrong_login'].'</span><br>';?>
<h4>Please Login</h4>
<form action="login.php" method="post">
    <input type="text" name="username" placeholder="Username" value="<?php if(isset($username)) echo $username;?>"><br>
    <input type="password" name="password" placeholder="Password" value="<?php if(isset($password)) echo $password;?>"><br>
    <input type="submit" name="login" value="Login"><br>   
</form>
<br>
<a href="register.php">Register New User<a>

<?php
my_footer();
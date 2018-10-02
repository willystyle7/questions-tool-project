<?php 
session_start();
$usrname = trim($_POST['usrname']);
$passwd = trim($_POST['passwd']);
if ($usrname == 'ilia' && $passwd == '12345') {
    $_SESSION['is_logged'] = true;
    header('Location: index.php');
} else {
    header('Location: index.php?error=1');
}
?>
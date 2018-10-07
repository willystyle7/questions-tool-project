<?php
session_start();
include('functions.php');

if (isset($_SESSION['is_logged']) && $_SESSION['is_logged']==true) {
    header('Location: main.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}

my_header('Questions Tool');

my_footer();

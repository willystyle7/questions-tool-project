<?php
session_start();
include('functions.php');

if (!isset($_SESSION['is_logged']) || (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == false)) {
    header('Location: index.php');
    exit;
}

my_header('Questions Tool');
    ?>
<?php echo "<span>Hello {$_SESSION['user']}, </span>"; ?>
<a href="logout.php">Logout<a><br>
<h2>Question List</h2>

//TODO

<?php
my_footer();
<?php
function my_header($title)
{
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.ico" />
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="styles/style.css">
    <!-- <script src="scripts/titlebar.js"></script> -->
</head>
<body>
<?php
}

function my_footer()
{
    echo '</body></html>';
}

function db_init()
{
    $link = mysqli_connect('url', 'username', 'password', 'db_name');
    if (!$link) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        $error_array['db'] = 'Error with Database';
        die('Error with Database');
        exit();
    }    
    //echo "Success: A proper connection to MySQL was made!" . PHP_EOL;
    return $link;    
}

function get_username_by_id($id) {
    $link = db_init();
    $sql = 'SELECT * FROM users WHERE user_id="'.$id.'";';
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['username'];
}

function get_id_by_username($username) {
    $link = db_init();
    $sql = 'SELECT * FROM users WHERE username="'.$username.'";';
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['user_id'];
}
<?php
session_start();
include('functions.php');

//if (!isset($_SESSION['is_logged']) || (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == false)) {
if (!isset($_SESSION['is_logged']) || !$_SESSION['is_logged']) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['ask_question']) && $_POST['ask_question'] == (!$_SESSION['ask_question'] ? 'Ask' : 'Hide').' question') {
    $_SESSION['ask_question'] = !$_SESSION['ask_question'];
}

if (isset($_POST['add_question']) && $_POST['add_question'] == "Add question") {
    $title = addslashes(trim($_POST['title']));
    $question = addslashes(trim($_POST['question']));
    $asked_by = (int)$_SESSION['user_info']['user_id'];
    $link = db_init();
    $sql = 'INSERT INTO questions (asked_by, title, question, date_asked, answered) ';
    $sql .= 'VALUES ('.$asked_by.', "'.$title.'", "'.$question.'", '.time().', 0);';            
    $result = mysqli_query($link, $sql);
    if (!$result) {
        //echo "Error with Database";
        //echo $sql;
        $error_array['db'] = 'Error with Database';
        //exit();
    }
}

$questions = [];
$link = db_init();
$sql = 'SELECT * FROM questions';
$result = mysqli_query($link, $sql);
if (!$result) {    
    $error_array['db'] = 'Error reading from Database';    
}
while ($row = mysqli_fetch_assoc($result)) {
    $questions[] = $row;
}
usort($questions, function($a, $b) { return $b['date_asked'] - $a['date_asked']; });

my_header('Questions Tool');
    ?>
<?php echo "<span>Hello {$_SESSION['user_info']['username']}, </span>"; ?>
<a href="logout.php">Logout<a><br>
<h2>Questions List</h2>

<form action="main.php" method="post">
    <input type="submit" name="ask_question" value="<?php echo (!$_SESSION['ask_question'] ? 'Ask' : 'Hide').' question'?>"><br>
</form>
    
<?php
if ($_SESSION['ask_question']) {
    ?>
        <form action="main.php" method="post">
            <input type="text" name="title" value="" placeholder="Title" required><br>
            <textarea rows="5" cols="50" name="question" value="" placeholder="Question" required></textarea><br>
            <input type="submit" name="add_question" value="Add question"><br>
        </form>
        <br> 
        <?php if (isset($error_array['db'])) echo '<span class="alert">'.$error_array['db'].'</span><br>';?>   
    <?php   
}
for ($i=0; $i < count($questions); $i++) {
    ?>
        <hr>
        <div class="question">
            <p>Title:  <?php echo $questions[$i]['title'];?></p>
            <p>Question:  <?php echo $questions[$i]['question'];?></p>
            <p>Asked by: <?php echo get_username_by_id($questions[$i]['asked_by']);?>,
                on <?php echo date('d-m-Y H:i:s', $questions[$i]['date_asked']);?>,
                Answered: <?php echo ($questions[$i]['answered'] ? "YES" : "NO");?></p>
        </div>
    <?php 
    //print_r($questions[$i]);
}

    ?>
<hr>

//TODO

<?php
my_footer();
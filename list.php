<?php
include_once 'db.php';

$post_data = file_get_contents('php://input');
echo 'User Name: ' . $_POST['user'];
echo '<br>Password: ' . $_POST['password'] . '<br><br><br>';
$user = $_POST['user'];


$result = mysqli_query($conn,"SELECT payer.user_name as 'user', board.name as 'board_name', board.id as 'board_id' FROM `board` JOIN `payer` ON board.payer_id = payer.user_name WHERE board.payer_id = '$user';");


$html = 'Logged in as:<br>' . $_POST['user'] . '<br><br>Boards:<br>';

while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<a href="/index.php?board=' . $row['board_id'] . '&user=' . $_POST['user'] . '">' . $row['board_name'] . '<br>';
}


echo $html;

?>
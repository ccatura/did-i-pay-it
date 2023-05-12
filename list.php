<?php
include_once './db.php';

// $post_data = file_get_contents('php://input');
// $user = $_POST['user'];

// $user = $_GET["user"];

session_start();
$user = $_SESSION["userx"];


$result = mysqli_query($conn,"SELECT payer.user_name as 'user', board.name as 'board_name', board.id as 'board_id' FROM `board` JOIN `payer` ON board.payer_id = payer.user_name WHERE board.payer_id = '$user';");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Document</title>
</head>
<body>
        
<?php

$html = '<div class="container">';
$html .= 'Logged in as: <Strong>' . $user . '</strong><br><br>Boards:<br>';

while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<a href="./board.php?board=' . $row['board_id'] . '">' . $row['board_name'] . '<br>';
}

$html .=   '</div>
            </body>
            </html>';

echo $html;

?>


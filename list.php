<?php
include_once './db.php';


session_start();
include_once './header.php';

if (isset($_SESSION["userx"])) {
    $user = $_SESSION["userx"];
} else {
    header('Location: ./');
}


$result = mysqli_query($conn,"SELECT payer.user_name as 'user', board.name as 'board_name', board.id as 'board_id' FROM `board` JOIN `payer` ON board.payer_id = payer.user_name WHERE board.payer_id = '$user';");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Did I Pay It | Board list</title>
</head>
<body>
        
<?php

$html = '<div class="container">';
$html .= $header . '<br>';
$html .= '<strong>Boards:</strong><br>';

while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<a href="./board.php?board=' . $row['board_id'] . '">' . $row['board_name'] . '<br>';
}

$html .=   '</div>
            </body>
            </html>';

echo $html;

?>


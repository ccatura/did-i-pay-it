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
echo '<div class="container">';
echo $header . '<br>';
if($result->num_rows > 0) {
    echo '<strong>Boards:</strong><br>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="./delete-board.php?board=' . $row['board_id'] . '"><span class="delete-board">&#10005;</span></a> <a href="./board.php?board=' . $row['board_id'] . '">' . $row['board_name'] . '</a><br>';
    }
    echo '<br><a href="./create-board.php">Create New board</a>';
} else {
    echo '<a href="./create-board.php">Create your first board</a>';
}
?>

    </div>
</body>
</html>


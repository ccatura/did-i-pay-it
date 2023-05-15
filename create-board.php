<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <!-- <script src="./login.js" defer></script> -->
   <title>Create Board | Did I Pay It?</title>
</head>
<body>


<div class="container">
    <?php include_once './header.php'; ?>
    <form action="./create-board-submit.php" method="post" class="form">
        <div><strong>Did I Pay It? | Create Account</strong></div>
        <div>Board Name
            <div>
                <input type="text" name="board-name" required>
            </div>
        </div>
        <div><input type="submit" name="submit" value="Create Board"></input></div>
    </form>
</div>


</body>
</html>
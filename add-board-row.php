<?php
session_start();
include_once './header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <!-- <script src="./login.js" defer></script> -->
   <title>Create Row | Did I Pay It?</title>
</head>
<body>


<div class="container">
    <?php echo $header ?>
    <form action="./add-board-row-submit.php" method="post" class="form">
        <div><strong>Did I Pay It? | Create Row</strong></div>
        <div>Row Name
            <div>
                <input type="text" name="payee-name" required>
            </div>
        </div>
        <div><input type="submit" name="submit" value="Create Row"></input></div>
    </form>
</div>


</body>
</html>
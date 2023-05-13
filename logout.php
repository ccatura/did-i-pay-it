<?php
include_once './db.php';

session_start();
session_unset();
session_destroy();    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title>Did I Pay It | Logout</title>
</head>
<body>

<div class="container">
    
    <?php
        echo 'You have succesfully logged out. <a href="./">LOGIN</a>';


    ?>

</div>


</body>
</html>
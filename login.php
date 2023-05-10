<?php
    include_once("./db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
   <title>Login | Did I Pay It?</title>
</head>
<body>


<div class="container">
    <form action="./list.php" method="post" class="form">
        <div><strong>Did I Pay It? | Login</strong></div>
        <div>User Name<div><input type="text" name="user"></div></div>
        <div>Password<div><input type="password" name="password"></div></div>
        <div><input type="submit" name="submit" value="Login"></input><button>Create Account</button></div>
    </form>
</div>


</body>
</html>
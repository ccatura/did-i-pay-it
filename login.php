<?php
    include_once("db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Did I Pay It?</title>
</head>
<body>



    <form action="list.php" method="post">
        <div>Login</div>
        <div>User Name</div>
        <div><input type="text" name="user"></div>
        <div>Password</div>
        <div><input type="password" name="password"></div>
        <div><input type="submit" name="submit" value="Login"></input><button>Create Account</button></div>
    </form>



</body>
</html>
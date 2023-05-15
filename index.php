<?php
    include_once("./db.php");
    session_start();
    $_SESSION['user'] = '';
    $_SESSION['fname'] = '';
    $_SESSION['lname'] = '';
    $_SESSION['user-taken'] = false;
    $_SESSION['user-created'] = false;
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <script src="./login.js" defer></script>
    <title>Login | Did I Pay It?</title>
</head>
<body>


<div class="container">
    <form action="./login-submit.php" method="post" class="form">
        <div><strong>Did I Pay It? | Login</strong></div>
        <div>User Name<div><input type="text" name="user" value="ccatura" required></div></div>
        <div>Password<div><input type="password" name="pword" value="abc123" required></div></div>
        <div><input type="submit" name="submit" value="Login"></input></div>
        <div>or</div>
        <div><a href="./create-account.php">Create Account</a></div>
    </form>
</div>


</body>
</html>
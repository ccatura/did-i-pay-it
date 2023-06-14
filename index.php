<?php
    include_once("./db.php");
    session_start();
    $_SESSION['user'] = '';
    $_SESSION['fname'] = '';
    $_SESSION['lname'] = '';
    $_SESSION['user-taken'] = false;
    $_SESSION['user-created'] = false;
    $_SESSION['submit-more'] = false;
    $_SESSION['updated'] = false;
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
    <form action="./login.php" method="post" class="form">
        <div><strong>Did I Pay It? | Login</strong></div>
        <p class="paragraph">Welcome to "Did I Pay It?", a user-friendly application that allows you to keep track of your monthly bills with ease. Simply create boards, add payees, and check off the checkbox next to them to indicate that you have paid your bill. Your bill tracking data is securely stored in the cloud and can be accessed from any device with an internet connection. To get started, log in below or create a new account.</p>

        <div>User Name<div><input type="text" name="user" required></div></div>
        <div>Password<div><input type="password" name="pword" required></div></div>
        <div><input type="submit" name="submit" value="Login"></input></div>
        <div>or</div>
        <div><a href="./create-account.php">Create Account</a></div>
    </form>

    <div style="position: relative; padding-bottom: 56.25%;"><iframe src="https://www.loom.com/embed/b9293d71c9204132878c8b832a28dbb7?sid=b72df913-228e-4b5d-89a7-1ba6161c0432" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe></div>

</div>


</body>
</html>
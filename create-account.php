<?php
session_start();

$user = $_SESSION['user'] ? : '';
$fname = $_SESSION['fname'] ? : '';
$lname = $_SESSION['lname'] ? : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <!-- <script src="./login.js" defer></script> -->
   <title>Login | Did I Pay It?</title>
</head>
<body>


<div class="container">
    <form action="./create-account-submit.php" method="post" class="form">
        <div><strong>Did I Pay It? | Create Account</strong></div>
        <div>Choose User Name<div><input type="text" name="user" value="<?php echo $user;?>" required onkeypress="return event.charCode != 32">
        <?php
            if ($_SESSION['user-taken']) {
                echo '<br><span style="font-size:12px; color:red;">User name taken.</span>';
            }
        ?>
        </div></div>
        <div>First Name<div><input type="text" name="fname" value="<?php echo $lname;?>" required></div></div>
        <div>Last Name<div><input type="text" name="lname" value="<?php echo $fname;?>" required></div></div>
        <div>Password<div><input type="password" name="pword" required></div></div>
        <div>Confirm Password<div><input type="password" name="pword-confirm" required></div></div>
        <div><input type="submit" name="submit" value="Create Account"></input></div>
        <div>or</div>
        <div><a href="./">Existing Users Login</a></div>
    </form>
</div>


</body>
</html>
<?php
include_once './db.php';

session_start();
$_SESSION['updated'] = false;

if (isset($_SESSION["userx"])) {
    $user = $_SESSION["userx"];
} else {
    header('Location: ./');
}

$result = mysqli_query($conn,"SELECT * FROM `payer` WHERE user_name = '$user';");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <script src="./edit-account.js" defer></script>
    <title>Did I Pay It | Edit Account</title>
</head>
<body>
<div class="container">


<?php
while ($row = mysqli_fetch_assoc($result)) {
    // $_SESSION['name'] = $row['name'];
    echo 'Click on an item to change it:<br><br>';
    echo '<input type="hidden" id="user-name" value="' . $user . '">';
    echo 'User Name: <span id="user-name-disabled"><input type="text" value = "' . $row['user_name'] . '"disabled></span><br><br>';
    echo 'Name: <input type="text" name="name" value = "' . $row['name'] . '" id="name"><br><br>';
    echo 'Email: <input type="text" value = "' . $row['email'] . '" id="email"><br><br>';
    echo 'New Password: <input type="password" value = "' . $row['pword'] . '" id="pword"><br><br>';
}





?>

<input type="submit" value="Submit" id="submit">
<br><br>
<a href="./list-boards.php">Go Back</a>

    </div>
</body>
</html>


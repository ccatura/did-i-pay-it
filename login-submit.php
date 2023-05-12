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
    <script src="./login.js" defer></script>
   <title>Login | Did I Pay It?</title>
</head>
<body>
    <div class="container">


        <?php
            $post_data = file_get_contents('php://input');
            // $userx = $_POST['user'];
            // $pwordx = $_POST['pword'];

            session_start();
            $_SESSION["userx"] = $_POST['user'];
            $_SESSION["pwordx"] = $_POST['pword'];
            $userx = $_SESSION["userx"];
            $pwordx = $_SESSION["pwordx"];
        
            echo 'Data from previous page: <br>User name: ' . $userx . '<br>Password: ' . $pwordx . '<br><br>';

            $result = mysqli_query($conn,"SELECT * FROM `payer` WHERE user_name = '$userx' LIMIT 1;");


            while ($row = mysqli_fetch_assoc($result)) {
                $pword = $row['pword'];
                $user = $row['user_name'];
                $name = $row['name'];
            }
            echo $user . '<br>';
            echo $pword . '<br>';
            echo $name . '<br><br>';

            if ($pwordx == $pword) {
                echo 'Passwords match - ' . $pwordx . ' EQUALS ' . $pword;
                header('Location: ./list.php');
                exit;
            } else {
                echo 'Passwords do not match - ' . $pwordx . ' DOES NOT EQUAL ' . $pword . '<br><br>';
                echo '<a href="./">Try Again</a>';
            }


        ?>


    </div>
</body>
</html>
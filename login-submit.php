<?php
    include_once("./db.php");

    $post_data = file_get_contents('php://input');
    $userx = $_POST['user'];
    $pwordx = $_POST['pword'];

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
        header('Location: ./list.php?user=' . $user);
        exit;
    } else {
        echo 'Passwords do not match - ' . $pwordx . ' DOES NOT EQUAL ' . $pword;
    }


?>
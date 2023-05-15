<?php

$header = '';

if (isset($_SESSION['user-created'])) {
    if ($_SESSION['user-created'] == true) {
        $header .=  'New user created! Let\'s make your first board!<br><br>';
    }
}

$header .=     '<strong>' . $_SESSION['name'] . '</strong> (' . $_SESSION['user'] . ')<br>'
            . '<a href="./logout.php">Logout</a><br>';



?>
<?php
$name = $_SESSION['name'];
$user = $_SESSION['user'];

echo '<div class="header-container">';

// if (isset($_SESSION['user-created'])) {
    if ($_SESSION['user-created'] == true) {
        echo  'Welcome ' . $name . '! Let\'s make your first board!<br><br>';
    } else {
        echo '<div><strong>' . $name . '</strong> (' . $user . ')</div>';
        echo '<a href="./list-boards.php">Your Boards</a>';
        echo '<br><a href="./create-board.php">New board</a>';
    }
// }

// if (isset($_SESSION['user-created'])) {
    // if ($_SESSION['user-created'] == false) {
    //     echo '<div><strong>' . $name . '</strong> (' . $user . ')</div>';
    // }
// }
echo '<a href="./logout.php">Logout</a>';
echo '</div>';


?>
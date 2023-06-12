<?php

$name = $_SESSION['name'];
$user = $_SESSION['user'];


echo '<div class="header-container">';
if ($_SESSION['updated']) {
    echo '<div id="updated">Updated!</div>';
    // $_SESSION['updated'] = false;
}

// if (isset($_SESSION['user-created'])) {
    if ($_SESSION['user-created'] == true) {
        echo  'Welcome ' . $name . '! Let\'s make your first board!<br><br>';
    } else {
        echo '<div><strong><a href="./edit-account.php">' . $name . '</a></strong> (' . $user . ')</div>';
        echo '<div><a href="./list-boards.php"><button>Boards</button></a></div>';
        echo '<div><a href="./create-board.php"><button>New</button></a></div>';
    }
// }

// if (isset($_SESSION['user-created'])) {
    // if ($_SESSION['user-created'] == false) {
    //     echo '<div><strong>' . $name . '</strong> (' . $user . ')</div>';
    // }
// }
echo '<div><a href="./logout.php"><button>Logout</button></a></div>';
echo '</div>';


?>
<?php
include_once './db.php';

session_start();

$board_to_delete = $_GET['board'];
$sql_string = "DELETE FROM `board` WHERE `id` = $board_to_delete;";


/*   */
/* CLEAN UP REDUNDANCY BELOW */
/*   */



try {
   if (mysqli_query($conn, $sql_string)) {
      header('Location: ./list-boards.php' . $board);
   } else {
      echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
   }
}
catch(Exception $e) {
   echo $e .'<br><br>';
}




$sql_string = "DELETE FROM `board_row` WHERE `board_id` = $board_to_delete;";

try {
   if (mysqli_query($conn, $sql_string)) {
      header('Location: ./list-boards.php' . $board);
   } else {
      echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
   }
}
catch(Exception $e) {
   echo $e .'<br><br>';
}



mysqli_close($conn);


   









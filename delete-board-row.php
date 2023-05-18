<?php
include_once './db.php';

session_start();

if (isset($_SESSION['user'])) {
   if (isset($_GET['row_id'])) {
      $row_to_delete = $_GET['row_id'];
   } else {
      header('Location: ./list-boards.php');
   }
} else {
   header('Location: ./');
}


$board = $_GET['board'];
$sql_string = "DELETE FROM `board_row` WHERE `id` = $row_to_delete;";

try {
   if (mysqli_query($conn, $sql_string)) {
      header('Location: ./board.php?board=' . $board);
   } else {
      echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
   }
}
catch(Exception $e) {
   echo $e .'<br><br>';
}
mysqli_close($conn);


   









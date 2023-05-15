<?php
include_once './db.php';

session_start();

$row_to_delete = $_GET['row_id'];
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


   









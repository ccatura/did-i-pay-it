<?php
include_once './db.php';

session_start();

$post_data = file_get_contents('php://input');
$payee_name = $_POST['payee-name'];
$user = $_SESSION['user'];
$board_id = $_SESSION['board'];



$sql_string = "INSERT INTO `board_row` (`payee_id`, `board_id`, `payer_id`) VALUES ('$payee_name', '$board_id','$user');";

// echo $sql_string;

try {
   if (mysqli_query($conn, $sql_string)) {
      header('Location: ./board.php?board=' . $board_id);
   } else {
      echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
   }
}
catch(Exception $e) {
   echo $e .'<br><br>';
}
   mysqli_close($conn);


   









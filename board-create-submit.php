<?php
include_once './db.php';

session_start();

$post_data = file_get_contents('php://input');
$board_name = $_POST['board-name'];
$user = $_SESSION['user'];

// $_SESSION['user'] = $_POST['user'];
// $_SESSION['fname'] = $_POST['fname'];
// $_SESSION['lname'] = $_POST['lname'];
// $_SESSION['user-created'] = false;








$sql_string = "INSERT INTO `board` (`name`, `payer_id`) VALUES ('$board_name', '$user');";

try {
   if (mysqli_query($conn, $sql_string)) {
      header('Location: ./list.php');
   } else {
      echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
   }
}
catch(Exception $e) {
   echo $e .'<br><br>';
}
   mysqli_close($conn);


   









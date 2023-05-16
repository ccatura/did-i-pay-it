<?php
session_start();
include_once './db.php';

$post_data = file_get_contents('php://input');
$payee_id = $_POST['payee-id'];
$payee_name_input = $_POST['payee-name-input'];
$user = $_SESSION['user'];
$board_id = $_SESSION['board'];

/* */
/* */
/* THIS PAGE BELOW, NEEDS TO BE CLEANED UP A LITTLE BIT */
/* THERE NEEDS TO BE ERROR HANDLING AS WELL */
/* */
/* */



if ($payee_id != '') { // User chooses payee from the dropdown list
   check_payee_in_board($payee_id, $conn, $board_id, $user);
   header('Location: ./board.php?board=' . $_SESSION['board']);
   exit();
} else { // User types in custom payee
   // This block checks if newly typed in payee already exists
   $sql_string = "SELECT `id` FROM `payee` WHERE `name` = '$payee_name_input' LIMIT 1;";
   $result = mysqli_query($conn, $sql_string);

   if ($result->num_rows == 0) {
      // This block inserts the new payee if no payee with that same name returns from the query
      $sql_string = "INSERT INTO `payee` (`name`) VALUES ('$payee_name_input');";
      $result = mysqli_query($conn, $sql_string);
   }

   // This gets the new ID from the DB
   $sql_string = "SELECT `id` FROM `payee` WHERE `name` = '$payee_name_input' LIMIT 1;";
   $result = mysqli_query($conn, $sql_string);
   while ($row = mysqli_fetch_assoc($result)) {
      $payee_id_new = $row['id'];
   }
   check_payee_in_board($payee_id_new, $conn, $board_id, $user);
}

mysqli_close($conn);
header('Location: ./board.php?board=' . $_SESSION['board']);








function check_payee_in_board($payee_id, $conn, $board_id, $user) {
   // Does a check for duplicate payees IN THE BOARD
   // If it exists, this returns, doing nothing
   // If it does not exist, it commits it to the DB
   $sql_string = "SELECT `payee_id` FROM `board_row` WHERE `payee_id` = '$payee_id' AND `board_id` = '$board_id' LIMIT 1;";
   $result = mysqli_query($conn, $sql_string);

   if ($result->num_rows > 0) {
      return;
   } else {
      $sql_string = "INSERT INTO `board_row` (`payee_id`, `board_id`, `payer_id`) VALUES ('$payee_id', '$board_id','$user');";
      $result = mysqli_query($conn, $sql_string);   
      header('Location: ./board.php?board=' . $_SESSION['board']);
      exit();
   }
}



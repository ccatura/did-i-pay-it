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
/* */
/* */

if ($payee_id != '') {
   $sql_string = "INSERT INTO `board_row` (`payee_id`, `board_id`, `payer_id`) VALUES ('$payee_id', '$board_id','$user');";
   $result = mysqli_query($conn, $sql_string);
} else {
   $sql_string = "INSERT INTO `payee` (`name`) VALUES ('$payee_name_input');";
   $result = mysqli_query($conn, $sql_string);

   $sql_string = "SELECT `id` FROM `payee` WHERE `name` = '$payee_name_input' LIMIT 1;";
   $result = mysqli_query($conn, $sql_string);

   while ($row = mysqli_fetch_assoc($result)) {
      $payee_id_new = $row['id'];
   }

   $sql_string = "INSERT INTO `board_row` (`payee_id`, `board_id`, `payer_id`) VALUES ('$payee_id_new', '$board_id','$user');";
   $result = mysqli_query($conn, $sql_string);

   echo 'name: '. $payee_name_input.'<br>';

   echo 'id: ' . $payee_id_new.'<br>';
}
echo $sql_string;




header('Location: ./board.php?board=' . $_SESSION['board']);








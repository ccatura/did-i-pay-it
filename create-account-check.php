<?php
include_once './db.php';

session_start();

$post_data = file_get_contents('php://input');
$user_new = $_POST['user'];
$pword_new = $_POST['pword'];
$name = $_POST['fname'] . ' ' . $_POST['lname'];

$_SESSION['user'] = $_POST['user'];
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
$_SESSION['user-created'] = false;






$result = mysqli_query($conn,"SELECT `user_name` FROM `payer` WHERE user_name = '$user_new';");


if ($result->num_rows > 0) {
   while ($row = mysqli_fetch_assoc($result)) {
      if($row['user_name'] == $user_new) {
         $_SESSION['user-taken'] = true;
         header('Location: ./create-account.php');
      } 
   }
} else {
   $sql_string = "INSERT INTO `payer` (`user_name`, `name`, `pword`) VALUES ('$user_new', '$name', '$pword_new');";

   try {
      if (mysqli_query($conn, $sql_string)) {
         echo "User name: " . $user_new . " added!<br>";
         $_SESSION['user-taken'] = false;
         $_SESSION['userx'] = $user_new;
         $_SESSION['user-created'] = true;
         $_SESSION['name'] = $_SESSION['fname'] . ' ' . $_SESSION['lname'];
         echo 'user: ' . $_SESSION['user'] .'<br>';
         echo 'user created: ' . $_SESSION['user-created'] .'<br>';
         
         header('Location: ./list.php');
      } else {
         echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
      }
   }
   catch(Exception $e) {
      echo $e .'<br><br>';
   }
      mysqli_close($conn);
}

   









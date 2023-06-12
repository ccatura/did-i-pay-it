<?php
include_once './db.php';
session_start();
$_SESSION['name'] = $_GET['name'];


   // Gets the data passed from the JS file
   $data = json_decode(file_get_contents("php://input"), true);



      if ($result = mysqli_query($conn, $data)) {
         // echo 'Account settings updated successfully!';
         // echo $_SESSION['userx'];
         $_SESSION['updated'] = true;
      } else {
         echo "Error:-" . mysqli_error($conn);
         $_SESSION['updated'] = false;
      }

      mysqli_close($conn);      



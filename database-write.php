<?php
include_once 'db.php';

   $table = 'payee';
   $name = 'Cheese';

   $sql = "INSERT INTO `$table` (`name`)
   VALUES ('$name')";

   if (mysqli_query($conn, $sql)) {
      echo "New record has been added successfully!";
   } else {
      echo "Error: " . $sql . ":-" . mysqli_error($conn);
   }
   mysqli_close($conn);
?>
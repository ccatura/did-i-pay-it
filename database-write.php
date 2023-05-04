<?php
include_once 'db.php';

   $s = curl_init(); 
   curl_setopt($s,CURLOPT_URL,'https://random-word-api.herokuapp.com/word'); 
   curl_setopt($s,CURLOPT_HEADER,false);
   $result = curl_exec($s);


   $table = 'payee';
   $name = json_decode($result);




   // https://random-word-api.herokuapp.com/word

   $sql = "INSERT INTO `$table` (`name`)
   VALUES ('$name')";

   if (mysqli_query($conn, $sql)) {
      echo "New record has been added successfully!";
   } else {
      echo "Error: " . $sql . ":-" . mysqli_error($conn);
   }
   mysqli_close($conn);
?>
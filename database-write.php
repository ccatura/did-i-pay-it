<?php
include_once 'db.php';
header('Access-Control-Allow-Origin: *');

   // $api_url = 'https://random-word-api.herokuapp.com/word';
   // $json_data = file_get_contents($api_url);
   // $response_data = json_decode($json_data);
   // $the_word = $response_data;
   // $name = ucfirst($the_word[0]);


   // Gets the data passed from the JS file
   $data = json_decode(file_get_contents("php://input"), true);

   $previous_index = -1;
   $month_count = 1;
   $sql_string = '';
   $count = 0;


$row_count = 0;
$month_count = 1;
$prev = '';

      for ($i=0; $i < count($data); $i++) {
         if ($data[$i]['row_id'] != $prev) { // Unique row ID's and payee IDs inside here
            $row_count++;
            $sql_string = 'UPDATE `board_row` SET ';
            $prev = $data[$i]['row_id'];
            for ($j=0; $j < count($data); $j++) { // Checkboxes for each row inside here
               if ($data[$j]['row_id'] == $prev) {
                  $month_name = strtolower(date("F", mktime(0, 0, 0, $month_count, 10)));
                  if ($data[$j]['checkbox_id']) {
                     if ($month_count < 12) {
                        $sql_string .= $month_name . ' = 1, ';
                     } else {
                        $sql_string .= $month_name . ' = 1 ';
                     }
                  } else {
                     if ($month_count < 12) {
                        $sql_string .= $month_name . ' = 0, ';
                     } else {
                        $sql_string .= $month_name . ' = 0 ';
                     }
                  }
                  if ($month_count < 12) {
                     $month_count++;
                  } else {
                     $month_count = 1;
                     $sql_string .= 'WHERE `payee_id` = ' . $data[$i]['payee_id'] . '; ';
                  }
               }
            }
            if (mysqli_query($conn, $sql_string)) {
               echo "Update row " . $row_count . '.  ';
            } else {
               echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
            }
         }
      }
      mysqli_close($conn);      



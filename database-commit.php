<?php
include_once './db.php';
// header('Access-Control-Allow-Origin: *');

   // Temporary code to get random words
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
                     $sql_string .= 'WHERE `payee_id` = ' . $data[$i]['payee_id'] . ' AND board_id = ' . $data[$i]['board_id'] . '; ';

                     //check if webpage payee name matches DB payee name
                     $sql_check_payee = 'SELECT `id` FROM `payee` WHERE `name` = \'' . $data[$i]["payee_name"] . '\'';

                     if ($result = mysqli_query($conn, $sql_check_payee)) {
                        // echo 'Rows returned: ' . $result->num_rows . ' <br> ';
                        if ($result->num_rows == 0) {
                           // here we check what the new name is against the db.
                           // if we find it, we replace the current payee-id with the newly found one
                           // if not, we make a new payee and replace it with the NEW payee-id
                        }
                     } else {
                        echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
                     }
                  }
               }
            }


            if (mysqli_query($conn, $sql_string)) {
               echo "Updated row " . $row_count . '.  ';
            } else {
               echo "Error: " . $sql_string . ":-" . mysqli_error($conn);
            }
         }
      }
      mysqli_close($conn);      



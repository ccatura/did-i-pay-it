<?php
    include_once("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js" defer></script>
    <title>Did I Pay It?</title>
</head>
<body>



    <div>Auto Save<span id="autosave"></span></div>
    <div class="checkoff-container">
        <div class="headings">
            <div class="desc-heading">
                (2023) Description
            </div>
            <div id="months-container">
                <div class="month" month="January"></div>
                <div class="month" month="February"></div>
                <div class="month" month="March"></div>
                <div class="month" month="April"></div>
                <div class="month" month="May"></div>
                <div class="month" month="June"></div>
                <div class="month" month="July"></div>
                <div class="month" month="August"></div>
                <div class="month" month="September"></div>
                <div class="month" month="October"></div>
                <div class="month" month="November"></div>
                <div class="month" month="December"></div>
            </div>
        </div>
        <div class="checkboxes">

             <?php
                $board = $_GET["board"];
                try {
                    $result = mysqli_query($conn,
                    "SELECT    payer.user_name,\n"
                    . "		   board.name,\n"
                    . "		   payee.name,\n"
                    . "        board_row.january,\n"
                    . "        board_row.february,\n"
                    . "        board_row.march,\n"
                    . "        board_row.april,\n"
                    . "        board_row.may,\n"
                    . "        board_row.june,\n"
                    . "        board_row.july,\n"
                    . "        board_row.august,\n"
                    . "        board_row.september,\n"
                    . "        board_row.october,\n"
                    . "        board_row.november,\n"
                    . "        board_row.december\n"
                    . "FROM payer\n"
                    . "INNER JOIN board ON board.payer_id = payer.user_name\n"
                    . "INNER JOIN board_row on board_row.payer_id = payer.user_name\n"
                    . "INNER JOIN payee on payee.id = board_row.payee_id\n"
                    . "WHERE board.id = $board;"
                    );


                    $starting_index = 2;
                    $row_index = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        $checkbox_group_html = '';
                        echo '<div class="row">';
                        echo '<div class="desc"><input type="text" value="' . $row['name'] . '" name="desc-' . $row_index . '"></div>';
                        echo '<div class="checks-container">';
                        foreach ($row as $key => $value) {
                            $col_index =  (int)$key -$starting_index;
                            if (is_int($key) && $key > $starting_index) {
                                $checkbox_group_html .=  '<div class="check"><input type="checkbox" name="check-' . $col_index . '-' . $row_index . '"';
                                if($row[$key] == 1) {
                                    $checkbox_group_html .= 'checked';
                                } else {
                                    $checkbox_group_html .= '';
                                }
                                $checkbox_group_html .= '></div>';
                            }
                        }
                        echo $checkbox_group_html . '</div></div>';
                        $row_index += 1;
                    }
                }
                catch(Exception $e) {
                    // echo '<br>Message: ' . $e->getMessage() . '<br><br>';
                    echo '<br><br>There was a problem retrieving the records. Please, make sure you are logged in and try again.<br><br><br>';
                }
            ?>

        </div>
        <div><button id="check-all">Check All</button></div>


    </div>




</body>
</html>
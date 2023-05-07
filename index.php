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



    <div>Auto Save<span id="autosave"> Enabled</span></div>
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
                    "SELECT    board_row.id as 'board_row_id',\n"
                    . "		   payee.id as 'payee_id',\n"
                    . "		   payee.name as 'payee_name',\n"
                    . "		   board.name as 'board_name',\n"
                    . "		   payer.user_name,\n"
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


                    $starting_index = 4;
                    while ($row = mysqli_fetch_array($result)) {
                        $payee_name             = $row['payee_name'];
                        $payee_id               = $row['payee_id'];
                        $payer_id               = $row['user_name'];
                        $board_row_id           = $row['board_row_id'];
                        $checkbox_group_html    = '';

                        echo '<div class="row" row-id="' . $board_row_id . '">';
                        echo '<div class="desc"><input class="payee" type="text" value="' . $payee_name . '" row-id="' . $board_row_id . '" payee-id="' . $payee_id . '"></div>';
                        echo '<div class="checks-container">';

                        foreach ($row as $key => $value) {
                            if (is_int($key) && $key > $starting_index) {
                                $month_index = $key - $starting_index;
                                $month_name = strtolower(date('F', mktime(0, 0, 0, $month_index, 10)));
                                $checkbox_group_html .=  '<div class="check"><input class="checkbox" type="checkbox" id="' . $board_row_id . '-' . $month_name . '"';
                                if($row[$key] == 1) {
                                    $checkbox_group_html .= 'checked';
                                } else {
                                    $checkbox_group_html .= '';
                                }
                                $checkbox_group_html .= ' row-id="' . $board_row_id . '" checkbox-id="' . $month_name . '" checked-id="' . $row[$key] . '"></div>';
                            }
                        }
                        echo $checkbox_group_html . '</div></div>';
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
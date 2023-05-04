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
    <title>Document</title>
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

            <div class="row">
                <div class="desc"><input type="text" value="Rent" name="desc-1"></div>
                <div class="checks-container">
                    <div class="check"><input type="checkbox" name="check-1-1"></div>
                    <div class="check"><input type="checkbox" name="check-1-2"></div>
                    <div class="check"><input type="checkbox" name="check-1-3"></div>
                    <div class="check"><input type="checkbox" name="check-1-4"></div>
                    <div class="check"><input type="checkbox" name="check-1-5"></div>
                    <div class="check"><input type="checkbox" name="check-1-6"></div>
                    <div class="check"><input type="checkbox" name="check-1-7"></div>
                    <div class="check"><input type="checkbox" name="check-1-8"></div>
                    <div class="check"><input type="checkbox" name="check-1-9"></div>
                    <div class="check"><input type="checkbox" name="check-1-10"></div>
                    <div class="check"><input type="checkbox" name="check-1-11"></div>
                    <div class="check"><input type="checkbox" name="check-1-12"></div>
                </div>
            </div>

            <div class="row">
                <div class="desc"><input type="text" value="Phone" name="desc-2"></div>
                <div class="checks-container">
                    <div class="check"><input type="checkbox" name="check-2-1"></div>
                    <div class="check"><input type="checkbox" name="check-2-2"></div>
                    <div class="check"><input type="checkbox" name="check-2-3"></div>
                    <div class="check"><input type="checkbox" name="check-2-4"></div>
                    <div class="check"><input type="checkbox" name="check-2-5"></div>
                    <div class="check"><input type="checkbox" name="check-2-6"></div>
                    <div class="check"><input type="checkbox" name="check-2-7"></div>
                    <div class="check"><input type="checkbox" name="check-2-8"></div>
                    <div class="check"><input type="checkbox" name="check-2-9"></div>
                    <div class="check"><input type="checkbox" name="check-2-10"></div>
                    <div class="check"><input type="checkbox" name="check-2-11"></div>
                    <div class="check"><input type="checkbox" name="check-2-12"></div>
               </div>
            </div>

            <div class="row">
                <div class="desc"><input type="text" value="Water" name="desc-3"></div>
                <div class="checks-container">
                    <div class="check"><input type="checkbox" name="check-3-1"></div>
                    <div class="check"><input type="checkbox" name="check-3-2"></div>
                    <div class="check"><input type="checkbox" name="check-3-3"></div>
                    <div class="check"><input type="checkbox" name="check-3-4"></div>
                    <div class="check"><input type="checkbox" name="check-3-5"></div>
                    <div class="check"><input type="checkbox" name="check-3-6"></div>
                    <div class="check"><input type="checkbox" name="check-3-7"></div>
                    <div class="check"><input type="checkbox" name="check-3-8"></div>
                    <div class="check"><input type="checkbox" name="check-3-9"></div>
                    <div class="check"><input type="checkbox" name="check-3-10"></div>
                    <div class="check"><input type="checkbox" name="check-3-11"></div>
                    <div class="check"><input type="checkbox" name="check-3-12"></div>
                </div>
            </div>

        </div>
        <div><button id="check-all">Check All</button></div>


    </div>

    <?php
    $result = mysqli_query($conn,
    "SELECT    payer.user_name,\n"
    . "		   board.name,\n"
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
    . "WHERE board.id = 1;"
    );

    while ($row = mysqli_fetch_array($result)) {
        echo $row['user_name'] . " " . $row['name'] . " " . $row['january'] . " " . $row['february'] . " " . $row['march'] . " " . $row['april'] . " " . $row['may'] . " " . $row['june'] . " " . $row['july'] . " " . $row['august'] . " " . $row['september'] . " " . $row['october'] . " " . $row['november'] . " " . $row['december'] . "<br>";

        $checkbox_group = '';

        foreach ($row as $key => $value) {
            if (is_int($key) && $key > 1) {
                // echo ' key: ' . $key . ' value: ' . $value . '<br>';
                $checkbox_group .=  '<input type="checkbox" name="check-1-1"';

                if($row[$key] == 1) {
                    $checkbox_group .= 'checked';
                } else {
                    $checkbox_group .= 'unchecked';
                }

                $checkbox_group .= '>';
            }
        }
        echo $checkbox_group . '<br>';
    }
    ?>


</body>
</html>
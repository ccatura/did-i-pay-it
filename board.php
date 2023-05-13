<?php
    include_once("./db.php");

    session_start();


    if (isset($_SESSION["userx"])) {
        $user = $_SESSION["userx"];
    } else {
        $user = 'No user';
        header('Location: ./');
    }

    // Old code from form data. now using sessions.
    // $post_data = file_get_contents('php://input');
    // $user = $_POST['user'];
    // $user = $_GET["user"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <script src="./board.js" defer></script>
    <title>Did I Pay It?</title>
</head>
<body>


    <div class="container main-container">
        <div id="header"><span id="header-inner">AutoSave</span><span id="autosave">&nbsp;Enabled</span></div>
        <div class="checkoff-container">
            <div class="headings">
                <div class="desc-heading" id="desc-heading"></div>
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

                <div class="rowx">
                    <div class="descx"></div>
                    <div class="checks-containerx">
                        <div class="checkx"><button class="checkxb" id="january-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="february-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="march-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="april-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="may-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="june-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="july-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="august-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="september-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="october-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="november-checkall">&#9660;</button></div>
                        <div class="checkx"><button class="checkxb" id="december-checkall">&#9660;</button></div>
                    </div>
                </div>


                <?php
                    $board = $_GET["board"];
                    // $user = $_GET["user"];
                    try {
                        $result = mysqli_query($conn,
                        "SELECT    board_row.id as 'board_row_id',\n"
                        . "		   payee.id as 'payee_id',\n"
                        . "		   payee.name as 'payee_name',\n"
                        . "		   board.name as 'board_name',\n"
                        . "		   board_row.board_id as 'board_row_board_id',\n"
                        . "		   board_row.order,\n"
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
                        . "INNER JOIN board_row on board_row.board_id = board.id\n"
                        . "INNER JOIN payee on payee.id = board_row.payee_id\n"
                        . "WHERE board_row.board_id = $board AND payer.user_name = '$user'\n"
                        . "ORDER BY `order`;"
                        );

                        if ($result->num_rows == 0) {
                            header('Location: ./list.php');
                        }

                        $starting_index = 6;
                        while ($row = mysqli_fetch_array($result)) {
                           
                            $board_row_board_id     = $row['board_row_board_id'];
                            $payee_name             = $row['payee_name'];
                            $payee_id               = $row['payee_id'];
                            $payer_id               = $row['user_name'];
                            $board_row_id           = $row['board_row_id'];
                            $order                  = $row['order'];
                            $board_name             = $row['board_name'];
                            $checkbox_group_html    = '';

                            echo '<div class="row" row-id="' . $board_row_id . '" board_id="' . $board_row_board_id . '" order="' . $order . '">';
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
                            echo '<script>document.getElementById("desc-heading").innerText="' . $board_name . '";</script>';
                        }
                    }
                    catch(Exception $e) {
                        // echo '<br>Message: ' . $e->getMessage() . '<br><br>';
                        echo '<br><br>There was a problem retrieving the records. Please, make sure you are logged in and try again.<br><br><br>';
                    }
                ?>


                    
            </div>
            <div><button id="check-all">Check All</button></div>
            <div><a href="./logout.php">Logout</a></div>
            <div><a href="./list.php">View Your Boards</a></div>


        </div>
    </div>



</body>
</html>
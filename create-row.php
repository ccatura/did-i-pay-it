<?php
include_once './db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <script src="./create-row.js" defer></script>
   <title>Create Row | Did I Pay It?</title>
</head>
<body>





<div class="container">
    <?php include_once './header.php'; ?>
    <form action="./create-row-submit.php" method="post" class="form">
        <div><strong>Did I Pay It? | Create Row</strong></div>
        <div>Select Payee Name</div>
        <div>
            <?php
                $result = mysqli_query($conn,"SELECT * FROM `payee`;");
                echo '<select name="payee-id" id="payee-name-select">';
                echo '<option ></option>';
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['id'] . '"><a href="">' . $row['name'] . '</a></option>';
                    }
                }
                echo '</select>';
            ?>
        </div>
        <div>Or</div>
        <div><input type="text" name="payee-name-input" id="payee-name-input" placeholder="Enter new payee"></div>
        <div><input type="submit" name="submit" value="Create Row"></input></div>


    </form>
</div>

</div>


</body>
</html>
<?php
    $servername = "sql647.main-hosting.eu";
    $username = "u682819236_ccatura_did_i";
    include("pword.php");
    $dbname = "u682819236_did_i_pay_it";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
    if(!$conn){
        die('Could not Connect MySql Server:' .mysql_error());
    }
?>
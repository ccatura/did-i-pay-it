<?php
include_once 'db.php';


	$result = mysqli_query($conn,"SELECT * FROM `users` JOIN `songs` ON users.username = songs.username WHERE songs.username = 'ccatura';");


    while ($row = mysqli_fetch_assoc($result)) {
        $file_title = 'scroller.php?song_id=' . $row['id'];
        echo "<li>" . "<p class='file-list-title'><a href='" . $file_title . "'>" . $row['song_title'] . "</a>";
        echo "<p class='file-list-id'>ID: " . $row['id'] . "</p>";
        echo "<p class='file-list-artist'>" . $row['song_artist'] . "</p>";
    }
    
?>

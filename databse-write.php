<?php
include_once 'db.php';
if(isset($_POST['submit']))
{    
    $username = 'ccatura';
    $song_title = str_replace("'", "\'", $_POST['song-title']);
    $song_artist = str_replace("'", "\'", $_POST['song-artist']);
    $song_lyrics = str_replace("'", "\'", $_POST['song-lyrics']);

    $sql = "INSERT INTO `songs` (`username`, `song_title`, `song_artist`, `song_lyrics`)
    VALUES ('$username', '$song_title', '$song_artist', '$song_lyrics')";

    if (mysqli_query($conn, $sql)) {
       echo "<h1>New record has been added successfully!</h1>";
    } else {
       echo "<h1>Error: " . $sql . ":-" . mysqli_error($conn) . "</h1>";
    }
    mysqli_close($conn);
}


?>
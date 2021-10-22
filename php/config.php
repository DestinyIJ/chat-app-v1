<?php
    $servername = "localhost";
    $username = "destiny";
    $password = "destinylocalhost";
    $DBname = "chatv1";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $DBname);

    if(!$conn) {
        echo "Database connection error" . mysqli_connect_error();
    } 
?>

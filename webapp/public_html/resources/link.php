<?php
// Create connection
   $link = mysqli_connect('82.150.140.89','KBS','Kbs.1234','KBS');
    // Check connection
    if ($link->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
?>
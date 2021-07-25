<?php
    // Used to connect to database

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="bank";
    $conn = mysqli_connect( $servername, $username, $password, $db_name ) or die('Not connected' . mysqli_connect_error());
?>
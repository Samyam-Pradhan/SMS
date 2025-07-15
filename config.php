<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $port = 3307;
    $database = "sms_db";

    $con = mysqli_connect($server, $username, $password, $database, $port);

    if(!$con){
        die("Connection failed: " . mysqli_connect_error());
    }

    
?>
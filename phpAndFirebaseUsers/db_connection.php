<?php
//Connects to database

    $servername = "localhost";
    $username = "root";
//$username = "jobbowen";
    $password = "";
//$password = "jobbowen";
    $db = "n423";
//$db = "jobbowen_db";
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

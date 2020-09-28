<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "messageapp";

// Connect to MySQL
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

// Test connection
if (mysqli_connect_errno()){
    echo "DB connection error ". mysqli_connect_error(); 
}   
    
?>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "cih_bank";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}






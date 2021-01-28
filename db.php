<?php

$servername = "localhost";
$username = "root";
$password = "root";
$db_name = "session_app";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
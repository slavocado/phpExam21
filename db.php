<?php

$servername = "std-mysql";
$username = "std_947_phpexam";
$password = "admin123";
$db_name = "std_947_phpexam";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
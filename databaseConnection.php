<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create database connectionection
$connection = new mysqli($servername, $username, $password);

// Check database connectionection
if (!$connection) {
    die("connectionection failed: " . mysqli_connect_error());
}
?> 
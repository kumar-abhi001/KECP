<?php
$servername = "localhost";
$username = "root";
$password = "Sanju123@#";
$dbname = "KECs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

<?php
session_start();
$fullName = $_SESSION['username'];
$nameParts = explode(" ", $fullName);
$firstName = $nameParts[0];

$servername = "localhost";
$username = "ota";
$password = "password";
$dbname = "froggers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$servername = "localhost";
$username = "luizgamer";
$password = "123";
$dbname = "froggers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
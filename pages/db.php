<?php
session_start();
$fullName = $_SESSION['username'];
$idCliente = $_SESSION['IDcliente'];

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

$stmt = $conn->prepare("SELECT email, senha FROM clientes WHERE id = ?");
$stmt->bind_param("i", $idCliente);
$stmt->execute();

$result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $emailEpico = $row['email'];
    $senha = $row['senha'];
    
?>

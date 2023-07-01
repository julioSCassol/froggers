<?php
session_start();
include '../db.php';
$data = json_decode(file_get_contents('php://input'), true);
$novoEmail = $data['novoEmail'];
error_log($novoEmail);
$id = $_SESSION['IDcliente'];

$sql = "UPDATE clientes SET email = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $novoEmail, $id);

if ($stmt->execute()) {
    echo "Email updated successfully";
} else {
    echo "Error updating email: " . $conn->error;
}
?>
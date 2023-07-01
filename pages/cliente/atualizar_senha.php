<?php
session_start();
include '../db.php';
$data = json_decode(file_get_contents('php://input'), true);
$novaSenha = $data['novaSenha'];
$id = $_SESSION['IDcliente']; 

$sql = "UPDATE clientes SET senha = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $novaSenha, $id);

if ($stmt->execute()) {
    echo "Password updated successfully";
} else {
    echo "Error updating password: " . $conn->error;
}

?>
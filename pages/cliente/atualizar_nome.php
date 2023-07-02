<?php
session_start();
include '../db.php';
$data = json_decode(file_get_contents('php://input'), true);
$novoNome = $data['novoNome'];
error_log($novoNome);
$id = $_SESSION['IDcliente'];

$sql = "UPDATE clientes SET nome = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $novoNome, $id);

if ($stmt->execute()) {
    $_SESSION['nome'] = $novoNome; 
    echo "Nome updated successfully";
} else {
    echo "Error updating nome: " . $conn->error;
}
?>

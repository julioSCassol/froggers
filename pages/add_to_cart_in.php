<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'pedido.php';
include 'db.php';

$id = isset($_POST['id']) ? $_POST['id'] : "";
$size = isset($_POST['size']) ? $_POST['size'] : "";
$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";

$stmt = $conn->prepare("SELECT * FROM itens_pedido WHERE IDprodutos = ? AND IDpedidos = ? AND tamanho = ?");
$stmt->bind_param('iis', $id, $IDpedido, $size);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) { 
    $stmt = $conn->prepare("UPDATE itens_pedido SET quantidade = quantidade + 1 WHERE IDprodutos = ? AND IDpedidos = ? AND tamanho = ?");
    $stmt->bind_param('iis', $id, $IDpedido, $size);
    $stmt->execute();
}
$conn->close();
?>

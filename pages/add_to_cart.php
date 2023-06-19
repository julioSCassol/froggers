<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'pedido.php';
include 'db.php';

$id = isset($_POST['id']) ? $_POST['id'] : "";
$IDcliente = isset($_SESSION['IDcliente']) ? $_SESSION['IDcliente'] : "";
$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";
function getprodutoByID($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

$produto = getprodutoByID($id);

echo "<script>alert('Item inserted successfully. IDcliente: " . $IDcliente . "');</script>";

$quantidade = 1;
$precoUn = $produto['preco'];


if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

$stmt = $conn->prepare("INSERT INTO itens_pedido (quantidade, precoUn, IDprodutos, IDpedidos) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE quantidade = ?");
$stmt->bind_param('idiii', $quantidade, $precoUn, $id, $IDpedido, $quantidade);
$result = $stmt->execute();

if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['quantidade'] += $quantidade;
} else {
    $_SESSION['cart'][$id] = array(
        "quantidade" => $quantidade,
        "precoUn" => $precoUn,
        "id" => $id,
        "IDpedido" => $IDpedido
    );
}



?>
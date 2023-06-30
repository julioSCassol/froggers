<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'pedido.php';
include 'db.php';

$id = isset($_POST['id']) ? $_POST['id'] : "";
$size = isset($_POST['size']) ? $_POST['size'] : "";
echo ($size);
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

$precoUn = $produto['preco'];

$stmt = $conn->prepare("SELECT * FROM itens_pedido WHERE IDprodutos = ? AND IDpedidos = ? AND tamanho = ?");
$stmt->bind_param('iis', $id, $IDpedido, $size);
$stmt->execute();
$result = $stmt->get_result();
$itensPedido = $result->fetch_assoc();

if ($itensPedido) {
    $quantidade = $itensPedido['quantidade'] + 1;
} else {
    $quantidade = 1;

    $stmt = $conn->prepare("INSERT INTO itens_pedido (quantidade, precoUn, IDprodutos, IDpedidos, tamanho) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('idiis', $quantidade, $precoUn, $id, $IDpedido, $size);
    $stmt->execute();
}

$_SESSION['cart'][$id][$size] = array(
    "quantidade" => $quantidade,
    "precoUn" => $precoUn,
    "id" => $id,
    "IDpedido" => $IDpedido,
    "tamanho" => $size
);

$stmt->close();
$conn->close();
?>

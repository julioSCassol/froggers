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

if (!$produto) {

    echo "<script>alert('Produto não encontrado.');</script>";
    exit;
}

$quantidade = 1;
$precoUn = $produto['preco'];


if ($quantidade > $produto['quantidade']) {
    echo "<script>alert('Quantidade indisponível. Apenas " . $produto['quantidade'] . " unidades disponíveis.');</script>";
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}


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


$novaQuantidade = $produto['quantidade'] - $quantidade;
$stmt = $conn->prepare("UPDATE produtos SET quantidade = ? WHERE id = ?");
$stmt->bind_param('ii', $novaQuantidade, $id);
$result = $stmt->execute();

echo "<script>alert('Item inserido com sucesso. IDcliente: " . $IDcliente . "');</script>";
?>
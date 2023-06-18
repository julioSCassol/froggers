<?php
session_start();

include 'db.php';

$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";
$IDcliente = isset($_SESSION['IDcliente']) ? $_SESSION['IDcliente'] : "";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<p>O Carrinho está vazio!.</p>';
    exit;
}

$ids = array_keys($_SESSION['cart']);
$ids_string = implode(',', $ids);

$stmt = $conn->prepare("SELECT produtos.*, itens_pedido.quantidade, itens_pedido.precoUn
                        FROM produtos
                        INNER JOIN itens_pedido ON produtos.id = itens_pedido.IDprodutos
                        INNER JOIN pedidos ON itens_pedido.IDpedidos = pedidos.id
                        WHERE pedidos.IDcliente = ? AND itens_pedido.IDpedidos = ? AND produtos.id IN (".implode(',', array_fill(0, count($ids), '?')).")");

$stmt->bind_param(str_repeat('i', count($ids) + 2), $IDcliente, $_SESSION['IDpedido'], ...$ids);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $quantidade = $_SESSION['cart'][$id]['quantidade'];

    echo '<div class="cart-item">';
    echo '<p>' . $row['nome'] . '</p>';
    echo '<p>Quantity: ' . $quantidade . '</p>';
    echo '<p>Price: ' . $row['preco'] . '</p>';
    echo '</div>';
}
?>

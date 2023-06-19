<?php
session_start();

include 'db.php';

$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";
$IDcliente = isset($_SESSION['IDcliente']) ? $_SESSION['IDcliente'] : "";

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo '<div class="Sapo-triste">
            <img src="/assets/images/Sapo-triste.png" alt="Sapo-triste">
            <p>Carrinho Vazio!</p>
          </div>';
    exit;
}

$ids = array_keys($_SESSION['cart']);

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
    echo '<img src="/assets/camisetas/'. $row['nome'] .'.png" alt="'. $row['nome'] .'" class="catalog-item-img">';
    echo '<p class = catalog-title>' . $row['nome'] . '</p>';
    echo '<p class = catalog-price>Preço: ' . number_format($row['preco'], 2) . '</p>';
    echo '<div class="quantity-box">';
    echo '<button class="remove-item" data-productid="' . $id . '" onclick="removeItemFromCart(this.getAttribute(\'data-productid\'))">-</button>';
    echo '<span class="quantity">' . $quantidade . '</span>';
    echo '<button class="add-item" data-productid="' . $id . '" onclick="addToCart(this.getAttribute(\'data-productid\'))">+</button>';
    echo '</div>';
    echo '</div>';
    
}

?>
</body>
</html>

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

$totalCarrinho = 0;

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $IDcategoria = $row['IDcategoria'];
    $quantidade = $_SESSION['cart'][$id]['quantidade'];
    $precoUnitario = $row['precoUn'];
    $precoTotal = $quantidade * $precoUnitario;
    $totalCarrinho += $precoTotal;

    $produtoCategoria = "";
    switch($IDcategoria) {
        case 1:
            $produtoCategoria = "moletons";
            break;
        case 2:
            $produtoCategoria = "camisetas";
            break;
        case 3:
            $produtoCategoria = "canecas";
            break;
        default:
            $produtoCategoria = "outras";
    }
    
    echo '<div class="cart-item">';
    $imagemCaminho = "/assets/".$produtoCategoria.'/'. $row['nome'] .'.png';
    echo '<img src="'.$imagemCaminho.'" alt="'. $row['nome'] .'" class="catalog-item-img">';
    echo '<p class = catalog-title>' . $row['nome'] . '</p>';
    echo '<p class = catalog-price>Preço Unitário: R$' . number_format($precoUnitario, 2) . '</p>';
    echo '<p class = catalog-price>Total: R$' . number_format($precoTotal, 2) . '</p>'; // Exibe o preço total
    echo '<div class="quantity-box">';
    echo '<button class="remove-item" data-productid="' . $id . '" onclick="removeItemFromCart(this.getAttribute(\'data-productid\'))">-</button>';
    echo '<span class="quantity">' . $quantidade . '</span>';
    echo '<button class="add-item" data-productid="' . $id . '" onclick="addToCart(this.getAttribute(\'data-productid\'))">+</button>';
    
    echo '</div>';
    echo '</div>';
    
}
echo '<p class="cart-total">Total do Carrinho: R$' . number_format($totalCarrinho, 2) . '</p>';
?>
</body>
</html>

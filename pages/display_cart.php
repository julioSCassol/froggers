<?php
session_start();

include 'db.php';

$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";
$IDcliente = isset($_SESSION['IDcliente']) ? $_SESSION['IDcliente'] : "";
$_SESSION['cart'] = isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? $_SESSION['cart'] : array();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

if(empty($IDcliente)) {
    echo '<div class="not-logged-in">
            <p>Para visualizar o carrinho, por favor entre em sua conta.</p>
          </div>';
    exit();
}

// isso aqui é só pro sapo triste aparecer
$stmt = $conn->prepare("SELECT * FROM itens_pedido WHERE IDpedidos = ?");
$stmt->bind_param("i", $IDpedido);
$stmt->execute();
$resultSapo = $stmt->get_result();

if ($resultSapo->num_rows == 0) {
    echo '<div class="Sapo-triste">
            <img src="/assets/images/Sapo-triste.png" alt="Sapo-triste">
            <p>Carrinho Vazio!</p>
          </div>';
}

$ids = array_keys($_SESSION['cart']);

if (!empty($ids)) {
    $stmt = $conn->prepare("SELECT produtos.*, itens_pedido.quantidade, itens_pedido.precoUn, itens_pedido.tamanho
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
        $quantidade = $row['quantidade'];
        $precoUnitario = $row['precoUn'];
        $precoTotal = $quantidade * $precoUnitario;
        $totalCarrinho += $precoTotal;
        $size = $row['tamanho'];
    
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
        if ($IDcategoria != 3) {
            echo '<p class="catalog-size">Tamanho: ' . $size . '</p>';
        }
        echo '<div class="quantity-box">';
        echo '<button class="remove-item" data-productid="' . $id . '" data-productsize="' . $size . '" onclick="removeItemFromCart(this.getAttribute(\'data-productid\'), this.getAttribute(\'data-productsize\'))">-</button>';
        echo '<span class="quantity">' . $quantidade . '</span>';
        echo '<button class="add-item" data-productid="' . $id . '" data-productsize="' . $size . '" onclick="addToCartIn(this.getAttribute(\'data-productid\'), this.getAttribute(\'data-productsize\'))">+</button>';    
        echo '</div>';
        echo '</div>';
        
    }
    
    if ($resultSapo->num_rows > 0) {
        echo '<div id="menu-container">';
        echo '<div class="cupom-container">';
        echo '<input id="cupom-input" type="text" name="cupom" placeholder="Cupom">';
        echo '<p class="cart-total">Total do Carrinho: R$' . number_format($totalCarrinho, 2) . '</p>';
        echo '</div>';
        echo '</div>';
    }

}
?>
</body>
<script>
    function addToCartIn(id, size) {
        console.log(size);

        $.post("../add_to_cart_in.php", { id: id, size: size })
            .done(function(data) {
                console.log("Item adicionado ao carrinho");
                displayCart();
            });
    }
    function removeItemFromCart(id, size) {
        console.log(size);
        $.post("../remove_from_cart.php", { id: id, size: size })
            .done(function(data) {
                console.log("Item removido do carrinho");
                displayCart();
        });
}
</script>
</html>

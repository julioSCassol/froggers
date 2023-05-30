<?php
// add to cart
function addToCart($productID, $quantity, $orderID) {
    global $conn;
    $sql = "INSERT INTO itens_pedido (quantidade, precoUn, IDprodutos, IDpedidos) VALUES (?, (SELECT preco FROM produtos WHERE id = ?), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $quantity, $productID, $productID, $orderID);
    $stmt->execute();
}

// view cart
function viewCart($orderID) {
    global $conn;
    $sql = "SELECT produtos.nome, produtos.descricao, itens_pedido.quantidade, itens_pedido.precoUn FROM itens_pedido JOIN produtos ON itens_pedido.IDprodutos = produtos.id WHERE itens_pedido.IDpedidos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "Product Name: " . $row["nome"]. " - Description: " . $row["descricao"]. " - Quantity: " . $row["quantidade"]. " - Price: " . $row["precoUn"]. "<br>";
    }
}

// checkout
function checkout($orderID) {
    global $conn;
    $sql = "UPDATE pedidos SET total = (SELECT SUM(quantidade * precoUn) FROM itens_pedido WHERE IDpedidos = ?) WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $orderID, $orderID);
    $stmt->execute();
}
?>
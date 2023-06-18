<?php
session_start();

include 'db.php'; 

$id = isset($_POST['id']) ? $_POST['id'] : "";

$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";

if(array_key_exists($id, $_SESSION['cart'])){
    unset($_SESSION['cart'][$id]);

    $stmt = $conn->prepare("DELETE FROM itens_pedido WHERE IDprodutos = ? AND IDpedidos = ?");
    $stmt->bind_param("ii", $id, $IDpedido);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Produto removido do carrinho');</script>";
    }
    else {
        echo "<script>alert('Erro ao remover o produto do carrinho');</script>";
    }
}
else {
    echo "<script>alert('Produto não encontrado no carrinho');</script>";
}

$stmt->close();
?>

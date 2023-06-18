<?php
session_start();

include 'db.php'; 

$id = isset($_POST['id']) ? $_POST['id'] : "";

$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";
if(array_key_exists($id, $_SESSION['cart'])){
    if ($_SESSION['cart'][$id]['quantidade'] > 1) {
        $_SESSION['cart'][$id]['quantidade']--;
        
        $stmt = $conn->prepare("UPDATE itens_pedido SET quantidade = quantidade - 1 WHERE IDprodutos = ? AND IDpedidos = ?");
        $stmt->bind_param("ii", $id, $IDpedido);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Quantidade diminuida por 1');</script>";
        }
        else {
            echo "<script>alert('Um erro ocorreu ao diminuir a quantidade');</script>";
        }

    } else {
        unset($_SESSION['cart'][$id]);
        $stmt = $conn->prepare("DELETE FROM itens_pedido WHERE IDprodutos = ? AND IDpedidos = ?");
        $stmt->bind_param("ii", $id, $IDpedido);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Produto removido do carrinho');</script>";
        }
        else {
            echo "<script>alert('Erro ao remover produto do carrinho');</script>";
        }
    }
} else {
    echo "<script>alert('Produto não encontrado no carrinho');</script>";
}

$stmt->close();

?>

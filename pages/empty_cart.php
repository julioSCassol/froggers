<?php
session_start();
include 'db.php';

$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";

if (isset($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $id => $item) {
    unset($_SESSION['cart'][$id]);

    $stmt = $conn->prepare("DELETE FROM itens_pedido WHERE IDprodutos = ? AND IDpedidos = ?");
    $stmt->bind_param("ii", $id, $IDpedido);
    $stmt->execute();
  }
}

?>

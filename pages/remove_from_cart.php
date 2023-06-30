<?php
session_start();

include 'db.php'; 

$id = isset($_POST['id']) ? $_POST['id'] : "";
$size = isset($_POST['size']) ? $_POST['size'] : "";
$IDcliente = isset($_SESSION['IDcliente']) ? $_SESSION['IDcliente'] : "";
$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";
if (isset($_SESSION['cart'][$id][$size])) {
    $stmt = $conn->prepare("SELECT * FROM itens_pedido WHERE IDprodutos = ? AND IDpedidos = ?");
    $stmt->bind_param("ii", $id, $IDpedido);
    $stmt->execute();

    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $quantidade = $row['quantidade'];
    }

    if ($quantidade > 1) {
        $_SESSION['cart'][$id][$size]['quantidade']--;

        $stmt = $conn->prepare("UPDATE itens_pedido SET quantidade = quantidade - 1 WHERE IDprodutos = ? AND IDpedidos = ? AND tamanho = ?");
        $stmt->bind_param("iis", $id, $IDpedido, $size);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Quantidade diminuída por 1');</script>";
        } else {
            echo "<script>alert('Um erro ocorreu ao diminuir a quantidade');</script>";
        }
    } else {
        unset($_SESSION['cart'][$id][$size]);

        $stmt = $conn->prepare("DELETE FROM itens_pedido WHERE IDprodutos = ? AND IDpedidos = ? AND tamanho = ?");
        $stmt->bind_param("iis", $id, $IDpedido, $size);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Produto removido do carrinho');</script>";
        } else {
            echo "<script>alert('Erro ao remover produto do carrinho');</script>";
        }
    }
} else {
    echo "<script>alert('Produto não está no carrinho');</script>";
}

$stmt->close();
?>
<script>
    function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
</script>
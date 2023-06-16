<?php
function addToCart($productID, $quantity, $orderID) {
    global $conn;
    $sql = "INSERT INTO itens_pedido (quantidade, precoUn, IDprodutos, IDpedidos) VALUES (?, (SELECT preco FROM produtos WHERE id = ?), ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiii", $quantity, $productID, $productID, $orderID);
    $stmt->execute();
}

function viewCart($orderID) {
    global $conn;
    $sql = "SELECT produtos.nome, itens_pedido.quantidade, itens_pedido.precoUn FROM itens_pedido JOIN produtos ON itens_pedido.IDprodutos = produtos.id WHERE itens_pedido.IDpedidos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "Product Name: " . $row["nome"]. " - Quantity: " . $row["quantidade"]. " - Price: " . $row["precoUn"]. "<br>";
    }
}

function checkout($orderID) {
    global $conn;
    $sql = "UPDATE pedidos SET total = (SELECT SUM(quantidade * precoUn) FROM itens_pedido WHERE IDpedidos = ?) WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $orderID, $orderID);
    $stmt->execute();
}

if (isset($_POST['productID'])) {
    $productID = $_POST['productID'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $found = false;
    foreach ($_SESSION['cart'] as $item) {
        if ($item['id'] == $productID) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $newItem = array(
            'id' => $productID,
            'quantity' => 1
        );
        $_SESSION['cart'][] = $newItem;
    }

    echo "Item added to the cart";
}
if (isset($_POST['productID'])) {
    $productID = $_POST['productID'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productID) {
            $item['quantity']++;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $newItem = array(
            'id' => $productID,
            'quantity' => 1
        );
        $_SESSION['cart'][] = $newItem;
    }

    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    echo json_encode($product);
}

?>


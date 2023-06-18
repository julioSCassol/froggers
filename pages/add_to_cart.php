<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'pedido.php';
include 'db.php';

// get the product id
$id = isset($_POST['id']) ? $_POST['id'] : "";
$IDcliente = isset($_SESSION['IDcliente']) ? $_SESSION['IDcliente'] : "";
$IDpedido = isset($_SESSION['IDpedido']) ? $_SESSION['IDpedido'] : "";
function getprodutoByID($id)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

$produto = getprodutoByID($id);

echo "<script>alert('Item inserted successfully. IDcliente: " . $IDcliente . "');</script>";

$quantidade = 1;
$precoUn = $produto['preco'];

// $stmt = $conn->prepare("SELECT id from pedidos WHERE IDcliente = ?");
// $stmt->bind_param('i', $IDcliente);
// $stmt->execute();
// $result = $stmt->get_result();
// $row = $result->fetch_assoc();
// $idpedido = $row['id'];

// check if the 'cart' session array was created
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

$stmt = $conn->prepare("INSERT INTO itens_pedido (quantidade, precoUn, IDprodutos, IDpedidos) VALUES (?, ?, ?, ?)");
$stmt->bind_param('idii', $quantidade, $precoUn, $id, $IDpedido);
$result = $stmt->execute();

// Inserting into cart array.
if(isset($_SESSION['cart'])){
    $_SESSION['cart'][$id]=array(
        "quantidade" => $quantidade,
        "precoUn" => $precoUn,
        "id" => $id,
        "IDpedido" => $IDpedido
    );
}
else{
    $_SESSION['cart']=array();
    $_SESSION['cart'][$id]=array(
        "quantidade" => $quantidade,
        "precoUn" => $precoUn,
        "id" => $id,
        "IDpedido" => $IDpedido
    );
}

?>
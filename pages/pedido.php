<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDcliente = $_SESSION['IDcliente'];
    $total = 0; 

    $checkOrderQuery = "SELECT * FROM pedidos WHERE IDcliente = '$IDcliente'";
    $checkOrderResult = $conn->query($checkOrderQuery);

    if ($checkOrderResult->num_rows === 0) {
        $sql = "INSERT INTO pedidos (IDcliente, total) VALUES ('$IDcliente', '$total')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['IDpedido'] = $conn->insert_id;
            echo '<script>alert("Pedido criado com sucesso!");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $row = $checkOrderResult->fetch_assoc();
        $_SESSION['IDpedido'] = $row['id'];
        echo '<script>alert("An existing order has been retrieved for this customer.");</script>';
    }
}
?>

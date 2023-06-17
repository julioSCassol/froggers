<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IDcliente = $_SESSION['IDcliente'];
    $total = 0; 

    // Query to check if an order already exists for the customer
    $checkOrderQuery = "SELECT * FROM pedidos WHERE IDcliente = '$IDcliente'";
    $checkOrderResult = $conn->query($checkOrderQuery);

    // If no order exists, insert a new one
    if ($checkOrderResult->num_rows === 0) {
        $sql = "INSERT INTO pedidos (IDcliente, total) VALUES ('$IDcliente', '$total')";
        if ($conn->query($sql) === TRUE) {
            // Store the ID of the newly created order in the session
            $_SESSION['IDpedido'] = $conn->insert_id;
            echo '<script>alert("Pedido criado com sucesso!");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // If an order already exists, retrieve its ID and store it in the session
        $row = $checkOrderResult->fetch_assoc();
        $_SESSION['IDpedido'] = $row['id'];
        echo '<script>alert("An existing order has been retrieved for this customer.");</script>';
    }
}
?>

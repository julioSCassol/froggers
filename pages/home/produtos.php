<?php
include '../db.php';

$sql = "SELECT * FROM produtos";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die('Error in SQL query: ' . mysqli_error($conn));
}

$produtos = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    array_push($produtos, $row);
}

$productsFound = count($produtos) > 0;

$response = array(
    "products" => $produtos,
    "productsFound" => $productsFound
);

header('Content-Type: application/json');
echo json_encode($response);
?>

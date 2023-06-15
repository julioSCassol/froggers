<?php
include '../db.php';

// Retrieve the search term from the request
$searchTerm = $_GET['search'];

// Prepare the SQL query to search for products
$sql = "SELECT * FROM produtos WHERE nome LIKE '%$searchTerm%'";

// Execute the query
$resultado = mysqli_query($conn, $sql);

// Check for errors
if (!$resultado) {
    die('Error in SQL query: ' . mysqli_error($conn));
}

$produtos = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    array_push($produtos, $row);
}

// Check if any products were found
$productsFound = count($produtos) > 0;

$response = array(
    "products" => $produtos,
    "productsFound" => $productsFound
);

header('Content-Type: application/json');
echo json_encode($response);
?>

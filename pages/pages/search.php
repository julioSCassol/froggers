<?php
include '../db.php';

// Retrieve the search term from the request
$searchTerm = $_GET['search'];

// Prepare the SQL query to search for products
$sql = "SELECT * FROM produtos WHERE nome LIKE '%$searchTerm%'";

// Execute the query
$result = $conn->query($sql);

$produtos = array();
while ($row = mysqli_fetch_assoc($resultado)) {
    array_push($produtos, $row);
}

header('Content-Type: application/json');
echo json_encode($produtos);
?>
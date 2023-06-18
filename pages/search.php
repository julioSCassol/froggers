<?php
include '../db.php';

$searchTerm = $_GET['search'];

$sql = "SELECT * FROM produtos WHERE nome LIKE '%$searchTerm%'";

$result = $conn->query($sql);

$produtos = array();
while ($row = mysqli_fetch_assoc($resultado)) {
    array_push($produtos, $row);
}

header('Content-Type: application/json');
echo json_encode($produtos);
?>
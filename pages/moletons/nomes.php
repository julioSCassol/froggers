<?php
include '../db.php';

$sql = "SELECT produtos.* FROM produtos where IDcategoria=1";

$resultado = mysqli_query($conn, $sql);

$produtos = array();

while ($row = mysqli_fetch_assoc($resultado)) {
    array_push($produtos, $row);
}

header('Content-Type: application/json');
echo json_encode($produtos);
?>

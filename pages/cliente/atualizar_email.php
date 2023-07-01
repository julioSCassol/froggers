<?php
session_start();
include '../db.php';

$novoEmail = $_POST["novoEmail"];
$idCliente = $_SESSION["IDcliente"];


$stmt = $conn->prepare("UPDATE clients SET email = ? WHERE IDcliente = ?");
$stmt->bind_param("si", $novoEmail, $idCliente);
$stmt->execute();
$stmt->close();

?>

<?php
session_start();
include '../db.php';

$novaSenha = $_POST["novaSenha"];
$idCliente = $_SESSION["IDcliente"];


$stmt = $conn->prepare("UPDATE clients SET senha = ? WHERE IDcliente = ?");
$stmt->bind_param("si", $novaSenha, $idCliente);
$stmt->execute();
$stmt->close();
?>

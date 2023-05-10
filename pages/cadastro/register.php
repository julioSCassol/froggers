<?php

$servername = "localhost";
$username = "froggers";
$password = "password";
$dbname = "froggers";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nome = $_POST['name'];
$email = $_POST['email'];
$senha = $_POST['password'];
$senha_confirmada = $_POST['confirm_password'];

if (empty($nome) || empty($email) || empty($senha) || empty($senha_confirmada)) {
    echo "Por favor preencha todos os campos";
} else {
    if ($senha != $senha_confirmada) {
        echo "As senhas não coincidem";
    } else {
        $sql = "INSERT INTO clientes (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

?>

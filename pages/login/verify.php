<?php
$conn = mysqli_connect("localhost", "froggers", "password", "froggers");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$email = $_POST["email"];
$senha = $_POST["password"];

$sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";

$resultado = mysqli_query($conn, $sql);

$isUserLoggedIn = false;

if ($resultado && mysqli_num_rows($resultado) > 0) {
    echo "Login bem-sucedido!";
    $isUserLoggedIn = true;
} else {
    echo "Email e/ou senha incorretos!";
}

mysqli_close($conn);
?>

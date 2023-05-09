<?php
$conn = mysqli_connect("Luiz", "picoli", "lolmolpp", "froggers");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$email = $_POST["email"];
$senha = $_POST["password"];

$sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";

$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    echo "Login bem-sucedido!";
} else {
    echo "Email e/ou senha incorretos!";
}

mysqli_close($conn);
?>

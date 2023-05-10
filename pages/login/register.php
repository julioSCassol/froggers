<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost"; //dps muda essa bomba aq
$username = "froggers"; 
$password = "123"; //hackeia eu n
$dbname = "froggers";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$senha = $_POST['password'];

if(empty($email) || empty($senha)){
    echo "Por favor preencha todos os campos";
 }else{
        $sql = "INSERT INTO clientes (email, senha) VALUES ('$email', '$senha')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
 }
 





$conn->close();





?>

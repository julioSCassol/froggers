<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_SESSION['itemsPurchased'])) {
        unset($_SESSION['itemsPurchased']);
    }
}

header("Location: index.php");
exit();

<?php
include './db.php';

// Retrieve the search term from the request
$searchTerm = $_GET['search'];

// Prepare the SQL query to search for products
$sql = "SELECT * FROM produtos WHERE nome LIKE '%$searchTerm%' OR descricao LIKE '%$searchTerm%'";

// Execute the query
$result = $conn->query($sql);

// Check if any results were found
if ($result->num_rows > 0) {
    // Loop through the results and display them
    while ($row = $result->fetch_assoc()) {
        echo "<p>Product Name: " . $row['nome'] . "</p>";
        echo "<p>Description: " . $row['descricao'] . "</p>";
        echo "<p>Price: $" . $row['preco'] . "</p>";
        echo "<hr>";
    }
} else {
    echo "No results found.";
}

// Close the database connection
$conn->close();
?>
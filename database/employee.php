<?php
include './db.php'; // Include the database connection file

$sql = "CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15),
    position VARCHAR(255),
    salary DECIMAL(10, 2)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'employee' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>

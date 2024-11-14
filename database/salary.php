<?php
include './db.php'; // Include the database connection file

$sql = "CREATE TABLE IF NOT EXISTS  salary_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    month VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    rate DECIMAL(10, 2) NOT NULL,
    days_worked INT NOT NULL,
    salary DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'employee' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

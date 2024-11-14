<?php
include '../database/db.php';
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $salary = $_POST['salary'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $sql = "INSERT INTO salaries (employee_id, salary, month, year) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("idss", $employee_id, $salary, $month, $year);

    if ($stmt->execute()) {
        echo "Salary added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Salary</title>
</head>

<body>
    <h2>Add Monthly Salary</h2>
    <form action="add_salary.php" method="POST">
        <input type="number" name="employee_id" placeholder="Employee ID" required><br>
        <input type="number" name="salary" placeholder="Salary" required><br>
        <input type="text" name="month" placeholder="Month" required><br>
        <input type="number" name="year" placeholder="Year" required><br>
        <button type="submit">Add Salary</button>
    </form>
</body>

</html>
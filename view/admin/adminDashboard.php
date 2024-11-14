<?php
include "../../database/db.php";
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

$employees = [];
$sql = "SELECT * FROM employees"; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card-deck {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-bottom: 40px;
        }

        .card {
            width: 18rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Admin Dashboard</h2>

        <!-- Dashboard Cards -->
        <div class="card-deck">
            <!-- Add Employee Card -->
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Add Employee</h5>
                    <p class="card-text">Add a new employee to the system.</p>
                    <a href="addEmployee.php" class="btn btn-primary">Add Employee</a>
                </div>
            </div>

            <!-- Employee List Card -->
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Employee List</h5>
                    <p class="card-text">View and manage the list of all employees.</p>
                    <a href="employeeList.php" class="btn btn-primary">Employee List</a>
                </div>
            </div>

            <!-- Make Salary Slip Card -->
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Make Salary Slip</h5>
                    <p class="card-text">Generate a salary slip for employees.</p>
                    <a href="makeSalary.php" target="_blank" class="btn btn-primary">Make Salary Slip</a>
                </div>
            </div>
        </div>
        
        <!-- Logout -->
        <div class="text-center mt-4">
            <a href="./adminLogin.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

</body>

</html>
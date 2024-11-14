<?php
include "../../database/db.php";
session_start();


if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Fetch employees from the database
$employees = [];
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
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
            position: relative;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
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
    </style>
</head>

<body>

    <div class="container">
        <!-- Back Button -->
        <a href="javascript:history.back()" class="btn btn-secondary back-button">Back</a>

        <h2 class="text-center mb-4">Admin Dashboard</h2>

        <!-- Employee List Table -->
        <h4 id="employeeList" class="text-center">Employee List</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Position</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($employees)): ?>
                    <?php foreach ($employees as $index => $employee): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($employee['name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['email']); ?></td>
                            <td><?php echo htmlspecialchars($employee['phone']); ?></td>
                            <td><?php echo htmlspecialchars($employee['position']); ?></td>
                            <td><?php echo htmlspecialchars($employee['salary']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No employees found in the database.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Logout -->
        <div class="text-center mt-4">
            <a href="./adminLogin.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

</body>

</html>
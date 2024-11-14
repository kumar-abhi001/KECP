<?php
require_once '../../fpdf186/fpdf.php';
include "../../database/db.php";
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

// Fetch all employees from the database
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
$employees = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }
} else {
    echo "No employees found.";
    exit();
}

// Handle Add Salary
if (isset($_POST['add_salary'])) {
    foreach ($employees as $employee) {
        $employeeId = $employee['id'];
        $month = $_POST["month_$employeeId"];
        $year = $_POST["year_$employeeId"];
        $rate = $_POST["rate_$employeeId"];
        $daysWorked = $_POST["days_$employeeId"];
        $salary = $rate * $daysWorked;

        // Insert salary data into the salary_details table
        $sql = "INSERT INTO salary_details (employee_id, month, year, rate, days_worked, salary)
                VALUES ('$employeeId', '$month', '$year', '$rate', '$daysWorked', '$salary')";

        if ($conn->query($sql) === TRUE) {
            echo "Salary added for " . $employee['name'] . "<br>";
        } else {
            echo "Error adding salary for " . $employee['name'] . ": " . $conn->error . "<br>";
        }
    }
}

if (isset($_POST['calculate_salary'])) {
    foreach ($employees as $employee) {
        $employeeId = $employee['id'];
        $rate = $_POST["rate_$employeeId"];
        $daysWorked = $_POST["days_$employeeId"];

        if (is_numeric($rate) && is_numeric($daysWorked)) {
            // Calculate salary
            $salary = $rate * $daysWorked;
            $_POST["salary_$employeeId"] = number_format($salary, 2);
        } else {
            echo "Invalid input for employee ID: $employeeId<br>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Slip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            width: 120px;
            display: inline-block;
        }

        .salary-cell {
            width: 120px;
        }

        .pdf-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center mb-4">Salary Slip</h2>
        <a href="javascript:history.back()" class="btn btn-secondary mb-3">Back</a>

        <!-- Create PDF Button -->
        <form action="generateSalarySlip.php" method="post">
            <button type="submit" class="pdf-button">Create PDF</button>
        </form>

        <!-- Employee Salary Form -->
        <form id="salaryForm" method="post">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Employee ID</th>
                        <th>Position</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Rate (per day)</th>
                        <th>Days Worked</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($employee['name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['id']); ?></td>
                            <td><?php echo htmlspecialchars($employee['position']); ?></td>
                            <td>
                                <select name="month_<?php echo $employee['id']; ?>" class="form-control" required>
                                    <option value="" disabled selected>Select Month</option>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo date("F", mktime(0, 0, 0, $i, 10)); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td>
                                <select name="year_<?php echo $employee['id']; ?>" class="form-control" required>
                                    <option value="" disabled selected>Select Year</option>
                                    <?php for ($i = 2016; $i <= 2050; $i++): ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </td>
                            <td>
                                <input type="number" name="rate_<?php echo $employee['id']; ?>" class="form-control" placeholder="Rate" required>
                            </td>
                            <td>
                                <input type="number" name="days_<?php echo $employee['id']; ?>" class="form-control" placeholder="Days Worked" required>
                            </td>
                            <td class="salary-cell">
                                <input type="number" name="salary_<?php echo $employee['id']; ?>" class="form-control" readonly>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" name="calculate_salary" class="btn btn-primary">Calculate Salaries</button>
            <button type="submit" name="add_salary" class="btn btn-success">Add Salary</button>
        </form>

    </div>

</body>

</html>
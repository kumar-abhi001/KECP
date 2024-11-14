<?php
include '../../database/db.php';
session_start();

// Check if the user is logged in as an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Salary PDF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>

    <div class="container mt-5">
        <h2 class="text-center">Generate Salary PDF</h2>

        <form action="generateSalaryPdf.php" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <label for="month" class="form-label">Select Month</label>
                    <select name="month" id="month" class="form-select" required>
                        <option value="" disabled selected>Select Month</option>
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='$i'>" . date("F", mktime(0, 0, 0, $i, 10)) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="year" class="form-label">Select Year</label>
                    <select name="year" id="year" class="form-select" required>
                        <option value="" disabled selected>Select Year</option>
                        <?php
                        for ($i = 2016; $i <= 2050; $i++) {
                            echo "<option value='$i'>$i</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Generate PDF</button>
        </form>
    </div>

</body>

</html>
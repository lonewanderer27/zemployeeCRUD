<?php
// save_employee.php
include('config.php');
global $conn;
$current_date = date('d-M-y');

$Fname = trim($_POST['Fname']);
$Lname = trim($_POST['Lname']);
$Email = trim($_POST['Email']);
$Phone = trim($_POST['Phone']);
$JobTitle = trim($_POST['JobTitle']);

// Finding duplicates
$query = "SELECT EmployeeID FROM employees WHERE EmployeeFN = '$Fname' AND EmployeeLN = '$Lname'";
$rs = $conn->query($query);

if ($rs->num_rows == 0) {
    // Checks current EmployeeID
    $query = "SELECT MAX(EmployeeID) AS MaxID FROM employees";
    $rs = $conn->query($query);
    $row = $rs->fetch_assoc();
    $newEmployeeID = $row['MaxID'] + 1;

    $query = "INSERT INTO employees (EmployeeID, EmployeeFN, EmployeeLN, EmployeeEmail, EmployeePhone, HireDate, ManagerID, JobTitle)
                VALUES ($newEmployeeID, '$Fname', '$Lname', '$Email', '$Phone', '$current_date', 50, '$JobTitle')";

    if ($conn->query($query)) {
        header("location:index.php");
    } else {
        echo $conn->error;
    }
} else {
    $error = "The name already exists. Please input another one, or edit the information.";
    echo $error;
    header("location:index.php");
}
?>

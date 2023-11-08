<?php
// update_employee.php
include('config.php');
global $conn;

// Get the employee ID from the URL parameter
if (isset($_POST['token'])) {
    $id = $_POST['token'];
    $Fname = trim($_POST['Fname']);
    $Lname = trim($_POST['Lname']);
    $Email = trim($_POST['Email']);
    $Phone = trim($_POST['Phone']);
    $JobTitle = trim($_POST['JobTitle']);

    $sql = "UPDATE employees SET EmployeeFN = '$Fname', EmployeeLN = '$Lname', EmployeeEmail = '$Email', EmployeePhone = '$Phone', JobTitle = '$JobTitle'
                WHERE EmployeeID = $id";

    if ($conn->query($sql)) {
        header("location:index.php");
    } else {
        echo $conn->error;
    }
} else {
    echo "Employee ID not provided.";
}
?>

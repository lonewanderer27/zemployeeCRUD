<?php
include('config.php');
global $conn;

if (isset($_POST['token'])) {
    $id = $_POST['token'];
    $sql = "DELETE FROM employees WHERE EmployeeID=$id";

    if ($conn->query($sql)) {
        header("location:index.php");
    } else {
        echo $conn->error;
    }
}
?>

<?php
global $conn;
include('config.php');
$tag = '';
$query = "SELECT EmployeeID, EmployeeFN, EmployeeLN, EmployeePhone, JobTitle FROM employees";
//execute query
if ($rs = $conn->query($query)) {
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $tag .= '<tr>';
            $tag .= '<td>' . $row['EmployeeID'] . '</td>';
            $tag .= '<td>' . $row['EmployeeFN'] . ' ' . $row['EmployeeLN'] . '</td>';
            $tag .= '<td>' . $row['JobTitle'] . '</td>';
            $tag .= '<td>' . $row['EmployeePhone'] . '</td>';
            $tag .= '<td>
						<a class="btn btn-outline-warning" href="index.php?token=' . $row['EmployeeID'] . '"> Edit</a>
						<a class="btn btn-outline-danger" href="delete.php?token=' . $row['EmployeeID'] . '"> Delete</a>
								
						</td>';
            $tag .= '</tr>';
        }
    } else {
        $tag = "No record(s) Found!";
    }
} else {
    echo $conn->error;
}

$Fname = '';
$Lname = '';
$Email = '';
$Phone = '';
if (isset($_GET['token'])) {
    $id = $_GET['token'];
    $query = "SELECT * FROM employees WHERE EmployeeID=$id";
    if ($rs = $conn->query($query)) {
        if ($rs->num_rows > 0) {
            $row = $rs->fetch_assoc();
            $Fname = $row['EmployeeFN'];
            $Lname = $row['EmployeeLN'];
            $Email = $row['EmployeeEmail'];
            $Phone = $row['EmployeePhone'];
            $JobTitle = $row['JobTitle'];
        }
    } else {
        echo $conn->error;
    }
    $btn = '<input class="btn btn-warning" type="submit" name="btnUpdate" value="SAVE RECORD">';
} else {
    $btn = '<input class="btn btn-primary" type="submit" name="btnSubmit" value="ADD RECORD">';
}
?>

<!-- HTML FILE -->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Employees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
</head>
<body class="container my-5 d-flex flex-column justify-content-center">
<form class="d-flex align-content-center my-3"
      action="<?php echo (isset($id)) ? 'update_employee.php' : 'add_employee.php' ?>" method="POST">
    <input class="form-control mb-2 me-2" type="text" name="Fname" placeholder="Enter First Name" value="<?= $Fname ?>"
           required>
    <input class="form-control mb-2 me-2" type="text" name="Lname" placeholder="Enter Last Name" value="<?= $Lname ?>"
           required>
    <input class="form-control mb-2 me-2" type="email" name="Email" placeholder="Enter Email" value="<?= $Email ?>"
           required>
    <input class="form-control mb-2 me-2" type="text" name="Phone" placeholder="Enter Contact No" value="<?= $Phone ?>"
           required><br/>
    <select class="form-select mb-2 me-2" name="JobTitle">
        <?php
        $query = "SELECT DISTINCT(JobTitle) FROM employees";
        if ($rs = $conn->query($query)) {
            while ($row = $rs->fetch_assoc()) {
                echo '<option value="' . $row['JobTitle'] . '">' . $row['JobTitle'] . '</option>';
            }
        } else {
            echo $conn->error;
        }
        ?>
    </select>
    <input class="d-none" name="token" value="<?= $id ?>"/>
    <?php
    echo $btn;
    ?>
</form>

<table class="table table-bordered table-hover table-striped" id="employeesTb">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Job Title</th>
        <th>Phone No.</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody class="table-group-divider">
    <?php echo $tag; ?>
    </tbody>
</table>
</body>
<script>
    $(document).ready(function () {
        $('#employeesTb').DataTable();
    });
</script>
</html>

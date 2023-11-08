<?php
$user = "root";
$pass = "";
$server = "database";
$db = "records";

//$user = "root";
//$pass = "";
//$server = "localhost";
//$db = "records";

$conn = new mysqli($server, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection Error: " . $conn->connect_error);
}
?>
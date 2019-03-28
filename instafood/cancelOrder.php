<?php
$servername = "fall2018dbvivekanandan.cpp49cqijelg.us-east-2.rds.amazonaws.com";
$username = "aviveka1";
$password = "Unccfall2018";
$dbname = "Instafood";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$or = $_GET['or'];

$sql = sprintf("DELETE FROM Orders WHERE order_number = '".$or."'");

if ($conn->query($sql) === TRUE) {
    echo "Order Cancelled";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
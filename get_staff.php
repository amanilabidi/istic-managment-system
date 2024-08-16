<?php
// get_staff.php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "istic_managment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch staff data from the database
$sql = "SELECT * FROM account";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    $staffMembers = $result->fetch_all(MYSQLI_ASSOC);

    // Output the staff members as JSON
    echo json_encode($staffMembers);
} else {
    // No staff members found
    echo json_encode([]);
}

// Close connection
$conn->close();
?>

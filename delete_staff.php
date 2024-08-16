<?php
// delete_staff.php

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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get staff ID from the request
    $staffId = $_POST["id"];

    // SQL query to delete the staff member
    $sql = "DELETE FROM account WHERE id = $staffId";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo "Staff member deleted successfully";
    } else {
        // Error in deletion
        echo "Error deleting staff member: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>

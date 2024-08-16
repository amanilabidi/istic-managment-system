<?php
// add_student.php

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
    // Get form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $cin = $_POST["cin"];
    $dob = $_POST["dob"];
    $field = $_POST["field"];
    $studentId = $_POST["student_id"]; // Add this line to get the student ID

    // Check if student ID is provided
    if (!empty($studentId)) {
        // Update the student information
        $updateSql = "UPDATE student SET firstname='$firstname', lastname='$lastname', cin='$cin', dob='$dob', field='$field' WHERE id='$studentId'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Student updated successfully";
        } else {
            echo "Error updating student: " . $conn->error;
        }
    } else {
        // Insert new student
        $insertSql = "INSERT INTO student (firstname, lastname, cin, dob, field) VALUES ('$firstname', '$lastname', '$cin', '$dob', '$field')";

        if ($conn->query($insertSql) === TRUE) {
            echo "Student added successfully";
        } else {
            echo "Error adding student: " . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

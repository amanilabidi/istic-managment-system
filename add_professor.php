<?php
// add_professor.php

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
    $speciality = $_POST["speciality"];
    $hours = $_POST["hours"];
    $professorId = $_POST["professor_id"]; // Add this line to get the professor ID

    // Check if professor ID is provided
    if (!empty($professorId)) {
        // Update the professor information
        $updateSql = "UPDATE professor SET firstname='$firstname', lastname='$lastname', cin='$cin', dob='$dob', speciality='$speciality', hours='$hours' WHERE id='$professorId'";

        if ($conn->query($updateSql) === TRUE) {
            echo "Professor updated successfully";
        } else {
            echo "Error updating professor: " . $conn->error;
        }
    } else {
        // Insert new professor
        $insertSql = "INSERT INTO professor (firstname, lastname, cin, dob, speciality, hours) VALUES ('$firstname', '$lastname', '$cin', '$dob', '$speciality', '$hours')";

        if ($conn->query($insertSql) === TRUE) {
            echo "Professor added successfully";
        } else {
            echo "Error adding professor: " . $conn->error;
        }
    }
}

// Close connection
$conn->close();
?>

<?php
// delete_student.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the student ID from the request
    $studentId = $_POST["id"];

    // Perform the deletion in the database
    $conn = new mysqli("localhost", "root", "", "istic_managment");
    $sql = "DELETE FROM student WHERE id = $studentId";

    if ($conn->query($sql) === TRUE) {
        echo "Student deleted successfully";
    } else {
        echo "Error deleting student: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

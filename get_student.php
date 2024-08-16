<?php
// get_student.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the student ID from the request
    $studentId = $_POST["id"];

    // Fetch the student's information from the database
    $conn = new mysqli("localhost", "root", "", "istic_managment");
    $sql = "SELECT * FROM student WHERE id = $studentId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        echo json_encode($student);
    } else {
        echo "Student not found";
    }

    // Close the database connection
    $conn->close();
}
?>

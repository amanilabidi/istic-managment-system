<?php
// get_professor.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the professor ID from the request
    $professorId = $_POST["id"];

    // Fetch the professor's information from the database
    $conn = new mysqli("localhost", "root", "", "istic_managment");
    $sql = "SELECT * FROM professor WHERE id = $professorId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $professor = $result->fetch_assoc();
        echo json_encode($professor); // Corrected the variable name
    } else {
        echo "Professor not found";
    }

    // Close the database connection
    $conn->close();
}
?>

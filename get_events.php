<?php
// get_events.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "istic_managment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a GET request
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get event ID from the request
    $eventId = $_GET["id"];

    // Fetch event details from the database
    $sql = "SELECT * FROM calender WHERE id = $eventId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Return the details as JSON
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Event not found"]);
    }
}

$conn->close();
?>

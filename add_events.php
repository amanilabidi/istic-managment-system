<?php
// add_events.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "istic_managment";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $date = $_POST["date"];
    $eventText = $_POST["event"];
    $updateEventId = isset($_POST["update-event-id"]) ? $_POST["update-event-id"] : null;

    if (!empty($updateEventId)) {
        // If update ID is present, update the existing event
        $stmt = $conn->prepare("UPDATE calender SET date = ?, event = ? WHERE id = ?");
        $stmt->bind_param("ssi", $date, $eventText, $updateEventId);
    } else {
        // If no update ID is present, add a new event
        $stmt = $conn->prepare("INSERT INTO calender (date, event) VALUES (?, ?)");
        $stmt->bind_param("ss", $date, $eventText);
    }

    // Execute the prepared statement
    if ($stmt->execute() === TRUE) {
        echo "Event added/updated successfully";
    } else {
        echo "Error adding/updating event: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

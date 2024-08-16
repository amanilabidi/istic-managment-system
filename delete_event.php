<?php
// delete_event.php

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
    // Get the event ID from the POST data
    $eventId = $_POST["id"];

    // SQL query to delete the event with the specified ID
    $sql = "DELETE FROM calender WHERE id = $eventId";

    if ($conn->query($sql) === TRUE) {
        echo "Event deleted successfully";
    } else {
        echo "Error deleting event: " . $conn->error;
    }
}

$conn->close();
?>

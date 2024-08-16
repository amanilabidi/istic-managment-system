<?php

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

// Function to sanitize input data
function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = sanitizeInput($_POST["email"]);
    $password = sanitizeInput($_POST["password"]);

    // Check if the provided email exists in the database
    $sql = "SELECT * FROM account WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User with the provided email exists, verify the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Password is correct, redirect to admin interface
            echo "Redirecting";
            header("Location: personal_account.php");
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password";
        }
    } else {
        // User with the provided email does not exist
        echo "User not found";
    }
}

// Close the database connection
$conn->close();
?>
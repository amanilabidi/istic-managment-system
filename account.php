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

// Function to sanitize input data,trims leading/trailing whitespace, removes backslashes, and converts special characters to HTML entities.
function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
//Checks if the HTTP request method is POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $fullname = sanitizeInput($_POST["fullname"]);
    $email = sanitizeInput($_POST["email"]);
    $password = password_hash(sanitizeInput($_POST["password"]), PASSWORD_DEFAULT);

    // Insert data into the database:
    $sql = "INSERT INTO account (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a new page on successful account creation
        header("Location: personal_account.php");
        exit(); // Make sure to exit to prevent further execution of the script
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

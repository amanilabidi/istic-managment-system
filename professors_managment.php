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



// Handle professor deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_professor"])) {
    $professorIdToDelete = $_POST["delete_professor"];

    // SQL query to delete the professor from the database
    $deleteSql = "DELETE FROM professor WHERE id = $professorIdToDelete";

    if ($conn->query($deleteSql) === TRUE) {
        // Professor deleted successfully
        echo json_encode(["status" => "success"]);
        exit;
    } else {
        // Error deleting professor
        echo json_encode(["status" => "error", "message" => $conn->error]);
        exit;
    }
}





// Fetch professor data from the database
$sql = "SELECT * FROM professor";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    $professors = $result->fetch_all(MYSQLI_ASSOC);

    // Close the result set
    $result->close();
} else {
    $professors = [];
}





// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="students.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="professor_managment.js" defer></script>
    <title>students managment</title>
</head>

<body>

    <section class="container">
        <nav class="navigation-wrapper">
            <ul class="nav-list">
                <li class="nav-item ">
                    <a href="personal_account.php"><em>Home</em></a>
                </li>
                <li class="nav-item">
                    <a href="specialities.php"><em>Specialities</em></a>
                </li>
                <li class="nav-item">
                    <a href="students_managment.php"><em>Students Managment</em></a>
                </li>
                <li class="nav-item">
                    <a href="#/"><em>Professors Managment</em></a>
                </li>
                <li class="nav-item">
                    <a href="staff_managment.php"><em>Staff Managment</em></a>
                </li>
                <li class="nav-item">
                    <a href="results.php"><em>Results </em></a>
                </li>
                <li class="nav-item">
                    <a href="calendry.php"><em>Calender</em></a>
                </li>
               
                <li class="nav-item">
                    <a href="#/"><em>
                            <p id="current-time"></p>
                        </em></a>
                </li>
            </ul>
        </nav>
        <section class="main-section">
            <div>
                <h3>Professors Managment</h3>

            </div>
            <div class="formulaire">
                <p>Add new professor!</p>
                <form action="add_professor.php" method="POST">
                <input type="hidden" id="professor_id" name="professor_id" value="">

                    <div class="input-box">
                        <label for="firstname">Firstname:</label>
                        <input type="text" id="firstname" name="firstname" required>

                    </div>
                    <div class="input-box">
                        <label for="lastname">Lastname:</label>
                        <input type="text" id="lastname" name="lastname" required>
                    </div>

                    <div class="input-box">
                        <label for="cin">CIN:</label>
                        <input type="text" id="cin" name="cin" required>
                    </div>

                    <div class="input-box">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" id="dob" name="dob" required>
                    </div>

                    <div class="input-box">
                        <label for="field">Speciality:</label>
                        <input type="text" id="speciality" name="speciality" required>
                    </div>
                    <div class="input-box">
                        <label for="field">Hours:</label>
                        <input type="number" id="hours" name="hours" required>
                    </div>

                    <div class="btns-element">
                        <button type="submit" class="submit-btn">Add professor</button>
                        <button type="reset" class="reset-btn">Reset</button>
                    </div>

                </form>
            </div>
            <table class="students-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>CIN</th>
                        <th>Date of birth</th>
                        <th>Speciality</th>
                        <th>Hours</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($professors as $professor): ?>
                        <tr>
                            <td>
                                <?= $professor['id'] ?>
                            </td>
                            <td>
                                <?= $professor['firstname'] ?>
                            </td>
                            <td>
                                <?= $professor['lastname'] ?>
                            </td>
                            <td>
                                <?= $professor['cin'] ?>
                            </td>
                            <td>
                                <?= $professor['dob'] ?>
                            </td>
                            <td>
                                <?= $professor['speciality'] ?>
                            </td>
                            <td>
                                <?= $professor['hours'] ?>
                            </td>
                            <td>
                                <button class="btn red delete-btn" data-professor-id="<?= $professor['id'] ?>"><i
                                        class="fa fa-trash icon"></i></button>

                                        <button class="btn yellow update-btn" data-professor-id="<?= $professor['id'] ?>"><i
                                        class="fa fa-pencil icon"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>


        </section>
    </section>

</body>

</html>
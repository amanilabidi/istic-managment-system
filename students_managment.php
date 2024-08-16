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

// Fetch student data from the database
$sql = "SELECT * FROM student";
$result = $conn->query($sql);

// Check if there are rows in the result
if ($result->num_rows > 0) {
    $students = $result->fetch_all(MYSQLI_ASSOC);

    // Close the result set
    $result->close();
} else {
    $students = [];
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
    <!-- Add this line in the head section of your HTML -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="students_managment.js" defer></script>
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
                    <a href="#/"><em>Students Managment</em></a>
                </li>
                <li class="nav-item">
                    <a href="professors_managment.php"><em>Professors Managment</em></a>
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
                <h3>Students Managment</h3>

            </div>
            <div class="formulaire">
                <p>Add new student!</p>
                <form action="add_student.php" method="POST">
                <input type="hidden" id="student_id" name="student_id" value="">

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
                        <label for="field">Field:</label>
                        <input type="text" id="field" name="field" required>
                    </div>

                    <div class="btns-element">
                        <button type="submit" class="submit-btn">Add Student</button>
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
                        <th>Field</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td>
                                <?= $student['id'] ?>
                            </td>
                            <td>
                                <?= $student['firstname'] ?>
                            </td>
                            <td>
                                <?= $student['lastname'] ?>
                            </td>
                            <td>
                                <?= $student['cin'] ?>
                            </td>
                            <td>
                                <?= $student['dob'] ?>
                            </td>
                            <td>
                                <?= $student['field'] ?>
                            </td>
                            <td>
                                <button class="btn red delete-btn" data-student-id="<?= $student['id'] ?>"><i
                                        class="fa fa-trash icon"></i></button>

                                <button class="btn yellow update-btn" data-student-id="<?= $student['id'] ?>"><i
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
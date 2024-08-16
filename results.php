<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="students.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Admin interface</title>

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
                    <a href="professors_managment.php"><em>Professors Managment</em></a>
                </li>
                <li class="nav-item">
                    <a href="staff_managment.php"><em>Staff Managment</em></a>
                </li>
                <li class="nav-item">
                    <a href="#/"><em>Results </em></a>
                </li>
                <li class="nav-item">
                    <a href="calender.php"><em>Calender</em></a>
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
                <h3>Results 2023/2024</h3>

            </div>
            <div class="formulaire">
                <p>Add new result!</p>
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
                        <label for="field">Speciality:</label>
                        <input type="text" id="speciality" name="speciality" required>
                    </div>
                    <div class="input-box">
                        <label for="cin">Rate:</label>
                        <input type="number" id="rate" name="rate" required>
                    </div>
                    <div class="input-box">
                        <label for="dob">Result</label>
                        <input type="text" id="result" name="result" required>
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
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>CIN</th>
                        <th>Speciality</th>
                        <th>Rate</th>
                        <th>Result</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>


        </section>
    </section>
</body>

</html>

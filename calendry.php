<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="students.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Admin interface</title>
    <script src="personal_account.js" defer></script>
    <script>
        $(document).ready(function () {
            // Fetch events from the database and display in the table
            function fetchEvents() {
                $.ajax({
                    type: "GET",
                    url: "get_events.php", // Create a new PHP file for fetching events
                    success: function (response) {
                        var events = JSON.parse(response);

                        // Clear existing rows in the table
                        $(".students-table tbody").empty();

                        // Add new rows for each event
                        for (var i = 0; i < events.length; i++) {
                            var event = events[i];
                            var row = "<tr>" +
                                "<td>" + event.id + "</td>" +
                                "<td>" + event.date + "</td>" +
                                "<td>" + event.event + "</td>" +
                                "<td>" +
                                "<button class='btn yellow update-btn' data-event-id='" + event.id + "'>Update</button>" +
                                "<button class='btn red delete-btn' data-event-id='" + event.id + "'>Delete</button>" +
                                "</td>" +
                                "</tr>";
                            $(".students-table tbody").append(row);
                        }

                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching events:', error);
                    }
                });

                // Attach event handlers for delete buttons
                attachDeleteHandlers();
                attachUpdateHandlers();
            }

            // Attach event handlers for delete buttons
            function attachDeleteHandlers() {
                $(".delete-btn").click(function () {
                    var eventId = $(this).data("event-id");

                    // Make an AJAX request to delete the event
                    $.ajax({
                        type: "POST",
                        url: "delete_event.php",
                        data: { id: eventId },
                        success: function (response) {
                            // Display a success message or handle errors
                            console.log(response);

                            // Fetch and display the updated events
                            fetchEvents();
                        },
                        error: function (xhr, status, error) {
                            console.error('Error deleting event:', error);
                        }
                    });
                });
            }



            function attachUpdateHandlers() {
                $(".update-btn").click(function () {
                    var eventId = $(this).data("event-id");

                    // Fetch the details of the selected event
                    $.ajax({
                        type: "GET",
                        url: "get_events.php", // Create a new PHP file for fetching a single event
                        data: { id: eventId },
                        success: function (response) {
                            var eventDetails = JSON.parse(response);

                            // Populate the form with the event details
                            $("#date").val(eventDetails.date);
                            $("#event").val(eventDetails.event);

                            // Save the event ID in a hidden input field for later use
                            $("#update-event-id").val(eventId);
                        },
                        error: function (xhr, status, error) {
                            console.error('Error fetching event details:', error);
                        }
                    });
                });
            }




            // Handle form submission
            $("form").submit(function (e) {
                e.preventDefault();

                // Get form data
                var date = $("#date").val();
                var eventText = $("#event").val();
                var updateEventId = $("#update-event-id").val();
                // Make an AJAX request to add the new event
                $.ajax({
                    type: "POST",
                    url: "add_events.php",
                    data: { date: date, event: eventText },
                    success: function (response) {
                        // Display a success message or handle errors
                        console.log(response);

                        // Fetch and display the updated events
                        fetchEvents();

                        // Clear the form after submission
                        $("#date").val("");
                        $("#event").val("");
                        $("#update-event-id").val("");
                    },
                    error: function (xhr, status, error) {
                        console.error('Error adding event:', error);
                    }
                });
            });

            // Initial fetch to display events on page load
            fetchEvents();

        });

    </script>
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
                    <a href="results.php"><em>Results </em></a>
                </li>
                <li class="nav-item">
                    <a href="#/"><em>Calender</em></a>
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
                <h3>Calender 2023/2024</h3>

            </div>
            <div class="formulaire">
                <p>Add new event!</p>
                <form action="add_events.php" method="POST">
                    <input type="hidden" id="update-event-id" name="update-event-id">
                    <div class="input-box">
                        <label for="dob">Date:</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="input-box">
                        <label for="firstname">Event:</label>
                        <input type="text" id="event" name="event" required>

                    </div>





                    <div class="btns-element">
                        <button type="submit" class="submit-btn">Add event</button>
                        <button type="reset" class="reset-btn">Reset</button>
                    </div>

                </form>
            </div>
            <table class="students-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Event</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch events from the database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "istic_managment";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM calender";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['event'] . "</td>";
                            echo "<td>";
                            echo "<button class='btn yellow update-btn' data-event-id='" . $row['id'] . "'>Update</button>";
                            echo "<button class='btn red delete-btn' data-event-id='" . $row['id'] . "'>Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No events found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>


        </section>
    </section>
</body>

</html>
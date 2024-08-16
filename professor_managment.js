// professor_managment.js

$(document).ready(function () {
    // Delete professor button click event
    $(".delete-btn").on("click", function () {
        var professorId = $(this).data("professor-id");
        var rowToDelete = $(this).closest("tr"); // Store the reference to the row for later removal

        // Confirm deletion
        if (confirm("Are you sure you want to delete this professor?")) {
            // Make an AJAX request to delete the professor
            $.ajax({
                type: "POST",
                url: "professors_managment.php",
                data: { delete_professor: professorId },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        // Remove the deleted professor row from the table
                        rowToDelete.remove();
                    } else {
                        alert("Error deleting professor: " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    alert("Error deleting professor. Please try again.\n" + error);
                }
            });
        }
    });
});

//update prof: 

$(document).ready(function() {
    // Event listener for the update buttons
    $(".update-btn").on("click", function() {
        // Get the professor ID from the data attribute
        var professorId = $(this).data("professor-id");

        // Send an asynchronous request to fetch the professor's information
        $.ajax({
            type: "POST",
            url: "get_professor.php", // Create a new PHP file for fetching professor information
            data: { id: professorId },
            success: function(response) {
                // Parse the JSON response
                var professor = JSON.parse(response);

                // Fill the form with the professor's information
                $("#professor_id").val(professorId);
                $("#firstname").val(professor.firstname);
                $("#lastname").val(professor.lastname);
                $("#cin").val(professor.cin);
                $("#dob").val(professor.dob);
                $("#speciality").val(professor.speciality);
                $("#hours").val(professor.hours);

                // Log the response for debugging
                console.log("Response from server:", response);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching professor information:", error);
            }
        });
    });
});



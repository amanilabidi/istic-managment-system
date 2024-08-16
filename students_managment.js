//delete student : 
    $(document).ready(function() {
        // Event listener for the delete buttons
        $(".delete-btn").on("click", function() {
            // Get the student ID from the data attribute
            var studentId = $(this).data("student-id");

            // Confirm with the user before deleting
            if (confirm("Are you sure you want to delete this student?")) {
                // Send an asynchronous request to delete the student
                $.ajax({
                    type: "POST",
                    url: "delete_student.php", // Create a new PHP file for deletion
                    data: { id: studentId },
                    success: function(response) {
                        // Remove the table row from the interface
                        $(this).closest("tr").remove();
                        alert("Student deleted successfully");
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting student:", error);
                    }
                });
            }
        });
    });
//update student: 

    $(document).ready(function() {
        // Event listener for the update buttons
        $(".update-btn").on("click", function() {
            // Get the student ID from the data attribute
            var studentId = $(this).data("student-id");

            // Send an asynchronous request to fetch the student's information
            $.ajax({
                type: "POST",
                url: "get_student.php", // Create a new PHP file for fetching student information
                data: { id: studentId },
                success: function(response) {
                    // Parse the JSON response
                    var student = JSON.parse(response);

                    // Fill the form with the student's information
                    $("#student_id").val(studentId);
                    $("#firstname").val(student.firstname);
                    $("#lastname").val(student.lastname);
                    $("#cin").val(student.cin);
                    $("#dob").val(student.dob);
                    $("#field").val(student.field);
                    console.log("Response from server:", response);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching student information:", error);
                }
            });
        });
    });



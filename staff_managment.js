$(document).ready(function() {
    // Fetch staff data from the database
    $.ajax({
        type: "GET",
        url: "get_staff.php",
        success: function(response) {
            var staffMembers = JSON.parse(response);

            for (var i = 0; i < staffMembers.length; i++) {
                var staffMember = staffMembers[i];
                var row = "<tr>" +
                    "<td>" + staffMember.id + "</td>" +
                    "<td>" + staffMember.fullname + "</td>" +
                    "<td>" + staffMember.email + "</td>" +
                    "<td>" + staffMember.password + "</td>" +
                    "<td>" +
                    "<button class='btn red delete-btn' data-staff-id='" + staffMember.id + "'><i class='fa fa-trash icon'> Delete</i></button>" +
                    "</td>" +
                    "</tr>";
                $(".students-table tbody").append(row);
            }

            // Event listener for the delete buttons
            $(".students-table").on("click", ".delete-btn", function() {
                var staffId = $(this).data("staff-id");

                // Send an asynchronous request to delete the staff member
                $.ajax({
                    type: "POST",
                    url: "delete_staff.php", // Create a new PHP file for deleting staff information
                    data: { id: staffId },
                    success: function() {
                        // Remove the corresponding row from the table
                        $(this).closest('tr').remove();
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting staff member:", error);
                    }
                });
            });
        },
        error: function(xhr, status, error) {
            console.error("Error fetching staff information:", error);
        }
    });
});

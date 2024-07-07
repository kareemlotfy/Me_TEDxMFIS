<?php
require("db_conn.php");

// Check if the user is authenticated, otherwise redirect to the login page
// You should have a more robust authentication mechanism in a real-world scenario
session_start();
if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../index.php");
    exit();
}

// Function (CSS) to see error or success
function getMessageClass($success) {
    return $success ? "success" : "error";
}

// check form

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the ticket ID from the form

    $ticket_id = $_POST['ticket_id'];

    // Check if Enter Event button is pressed

    if(isset($_POST['enter_event'])) {

        // Check the current status of the ticket ID

        $sql_check_status = "SELECT enter_status FROM user_cred WHERE ticket_id = ?";
        $stmt_check_status = $conn->prepare($sql_check_status);
        $stmt_check_status->bind_param("s", $ticket_id);
        $stmt_check_status->execute();
        $result_check_status = $stmt_check_status->get_result();

        if ($result_check_status->num_rows > 0) {
            $row = $result_check_status->fetch_assoc();
            if ($row['enter_status'] == 'yes') {
                echo "<span class='" . getMessageClass(false) . "'>Error: Ticket ID has already been used to enter the event</span>";
            } else {
                // Update the enter_status field to yes for the ticket ID

                $sql = "UPDATE user_cred SET enter_status = 'yes' WHERE ticket_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $ticket_id);

                if ($stmt->execute()) {
                    echo "<span class='" . getMessageClass(true) . "'>Enter Event status updated successfully</span>";
                } else {
                    echo "<span class='" . getMessageClass(false) . "'>Error updating Enter Event status: " . $stmt->error . "</span>";
                }
            }
        } else {
            echo "<span class='" . getMessageClass(false) . "'>Error: Ticket ID not found</span>";
        }
    }

    // Check if the Dinner Event button is pressed

    if(isset($_POST['dinner_event'])) {

        // Check the current status of the ticket ID

        $sql_check_status = "SELECT dinner_status FROM user_cred WHERE ticket_id = ?";
        $stmt_check_status = $conn->prepare($sql_check_status);
        $stmt_check_status->bind_param("s", $ticket_id);
        $stmt_check_status->execute();
        $result_check_status = $stmt_check_status->get_result();

        if ($result_check_status->num_rows > 0) {
            $row = $result_check_status->fetch_assoc();
            if ($row['dinner_status'] == 'yes') {
                echo "<span class='" . getMessageClass(false) . "'>Error: Ticket ID has already been used to attend the dinner event</span>";
            } else {

                // Update the dinner_status field to yes for the ticket ID

                $sql = "UPDATE user_cred SET dinner_status = 'yes' WHERE ticket_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $ticket_id);

                if ($stmt->execute()) {
                    echo "<span class='" . getMessageClass(true) . "'>Dinner Event status updated successfully</span>";
                } else {
                    echo "<span class='" . getMessageClass(false) . "'>Error updating Dinner Event status: " . $stmt->error . "</span>";
                }
            }
        } else {
            echo "<span class='" . getMessageClass(false) . "'>Error: Ticket ID not found</span>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEDx Manarat AlFarouk School</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #statusMessage {
            font-weight: bold;
            margin-top: 10px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form method="post">
        
        <input type="text" name="ticket_id" id="ticket_id" placeholder="Enter Ticket ID">
        <input type="submit" name="enter_event" value="Enter Event">
        <input type="submit" name="dinner_event" value="Dinner Event">
        <button type="button" id="autoFillButton">Auto Fill Ticket ID</button>
        <a href="../logout.php">Logout</a>
    </form>

    <script>
        document.getElementById("autoFillButton").addEventListener("click", function() {
            var url = window.location.href;
            var ticketIdIndex = url.indexOf("#") + 1;
            var ticketId = url.substring(ticketIdIndex);
            document.getElementById("ticket_id").value = ticketId;
        });
    </script>
</body>
</html>

<?php
require("db_conn.php");
session_start();

if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
    header("Location: ../index.php");
    exit();
}

function getMessageClass($success) {
    return $success ? "success" : "error";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEDx Event Management</title>
    <link rel="icon" type="image/x-icon" href="admin/assets/img/logos/x-art.png" />
    <link rel="stylesheet" href="../../admin/assets/vendor/css/core.css">
    <link rel="stylesheet" href="../../admin/assets/vendor/css/theme-default.css">
    <link rel="stylesheet" href="../../admin/assets/vendor/css/pages/page-auth.css">
    <style>
        #statusMessage {
            font-weight: bold;
            margin: 10px;
        }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center">
                        <a href="#" class="app-brand-link gap-2">
                            <img src="../../admin/assets/img/logos/TEDx_logo_place2_RGB_CS2_page-0001.jpg" alt="tedx logo" style="height: 70px;">
                        </a>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="ticket_id" class="form-label" style="font-size:20px;">Ticket ID</label>
                            <input type="text" name="ticket_id" id="ticket_id" required class="form-control">
                        </div>

                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ticket_id'])) {
                            $ticket_id = trim($_POST['ticket_id']);
                            $event = $_POST['event_type'] ?? null;

                            if ($event) {
                                $status_column = $event . "_status";

                                $sql_check_status = "SELECT $status_column FROM user_cred WHERE ticket_id = ?";
                                $stmt_check_status = $conn->prepare($sql_check_status);
                                $stmt_check_status->bind_param("s", $ticket_id);
                                $stmt_check_status->execute();
                                $result = $stmt_check_status->get_result();

                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    if ($row[$status_column] === 'yes') {
                                        echo "<span class='" . getMessageClass(false) . "'>Error: Ticket ID has already been used for this event</span>";
                                    } else {
                                        $sql_update = "UPDATE user_cred SET $status_column = 'yes' WHERE ticket_id = ?";
                                        $stmt_update = $conn->prepare($sql_update);
                                        $stmt_update->bind_param("s", $ticket_id);

                                        if ($stmt_update->execute()) {
                                            echo "<span class='" . getMessageClass(true) . "'>Successfully marked attendance for $event event</span>";
                                        } else {
                                            echo "<span class='" . getMessageClass(false) . "'>Error updating status: " . $stmt_update->error . "</span>";
                                        }
                                    }
                                } else {
                                    echo "<span class='" . getMessageClass(false) . "'>Error: Ticket ID not found</span>";
                                }
                            } else {
                                echo "<span class='" . getMessageClass(false) . "'>Error: No event type selected</span>";
                            }
                        }
                        $conn->close();
                        ?>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100 btn1" type="button" id="autoFillButton">Auto Fill Ticket ID</button>
                        </div>
                        <div class="mb-3">
                            <select name="event_type" class="form-control" required>
                                <option value="" disabled selected>Select An Option</option>
                                <option value="enter">Enter Event</option>
                                <option value="breakfast">Breakfast Event</option>
                                <option value="snack">Snack Event</option>
                                <option value="dinner">Dinner Event</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Submit" class="btn btn-primary d-grid w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("autoFillButton").addEventListener("click", function () {
        var url = window.location.href;
        var ticketIdIndex = url.indexOf("#") + 1;
        var ticketId = url.substring(ticketIdIndex);
        document.getElementById("ticket_id").value = ticketId;
    });
</script>
</body>
</html>

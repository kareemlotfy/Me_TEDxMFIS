<?php

/**
 * Sanitize input data by trimming, removing slashes, and encoding special characters.
 *
 * @param array $data Input data to sanitize.
 * @return array Filtered data.
 */
function filteration(array $data): array
{
    $filteredData = [];

    foreach ($data as $key => $value) {
        // Trim whitespace
        $value = trim($value);

        // Remove backslashes
        $value = stripslashes($value);

        // Encode special characters
        $value = htmlspecialchars($value);

        // Remove HTML and PHP tags
        $value = strip_tags($value);

        $filteredData[$key] = $value;
    }

    return $filteredData;
}

/**
 * Get the admin's name from the database.
 *
 * @param mysqli $con Database connection.
 * @param int $adminId Admin ID.
 * @return string|null Admin name or null if not found.
 */
function getAdminName(mysqli $con, int $adminId): ?string
{
    $sql = "SELECT admin_name FROM admin_cred WHERE id = ?";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        echo "Prepare failed: (" . $con->errno . ") " . $con->error;
        return null;
    }

    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["admin_name"];
    }

    return null;
}

/**
 * Execute a SELECT query with prepared statements.
 *
 * @param string $sql SQL query.
 * @param array $values Values to bind to the query.
 * @param string $datatypes Data types for binding.
 * @return mysqli_result Query result.
 */
function select(string $sql, array $values, string $datatypes): mysqli_result
{
    global $con;

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            die("Query execution failed - Select");
        }
    } else {
        die("Query preparation failed - Select");
    }
}

/**
 * Display an alert message.
 *
 * @param string $type Alert type ("error" or "success").
 * @param string $title Alert title.
 * @param string $msg Alert message.
 */
function alert(string $type, string $title, string $msg): void
{
    $class = $type === "error" ? "error" : "success";
    $icon = $type === "error"
        ? '<svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path></svg>'
        : '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_iconCarrier"><path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';

    echo <<<HTML
    <div class="alert_container" id="popup">
        <div role="alert" class="$class">
            <div class="alert_header">
                <div class="image">$icon</div>
                <div class="content">
                    <span class="title">$title</span>
                    <p class="message">$msg</p>
                </div>
                <div class="actions">
                    <button class="desactivate close" aria-label="Close" data-dismiss="alert" type="button" onclick="closePopup()">Close</button>
                </div>
            </div>
        </div>
    </div>
HTML;

    echo "<script>var titleVariableFromPHP = '" . htmlspecialchars($title) . "';</script>";
}

/**
 * Add a class to the body to trigger styling or behavior.
 */
function addBodyClassAndStyle(): void
{
    echo '<script>document.body.classList.add("alertCalled");</script>';
}

/**
 * Redirect to login page if admin is not logged in.
 */
function adminLogin(): void
{
    session_start();
    if (!isset($_SESSION["adminLogin"]) || $_SESSION["adminLogin"] !== true) {
        echo "<script>window.location.href='../Login/index.php';</script>";
        exit();
    }
}

?>

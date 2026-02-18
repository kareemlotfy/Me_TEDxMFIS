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

function checkAdminPermission(mysqli $con, int $adminId, int $pageId): void
{
    $sql = "SELECT * FROM permissions WHERE admin_id = ? AND page_id = ?";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        echo "Prepare failed: (" . $con->errno . ") " . $con->error;
        return;
    }

    $stmt->bind_param("ii", $adminId, $pageId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Admin doesn't have permission to access this page
        header("Location: ../Misc/unauthorized.php");
        exit();
    }
}

function hasPermission(mysqli $con, int $adminId, int $pageId): bool
{
    $sql = "SELECT 1 FROM permissions WHERE admin_id = ? AND page_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $adminId, $pageId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}


function getAdminDetails(mysqli $con, int $adminId): ?array
{
    $sql = "SELECT admin_name, admin_commitee, admin_pic, admin_position, admin_email, admin_username, admin_number FROM admin_cred WHERE id = ?";
    $stmt = $con->prepare($sql);

    if (!$stmt) {
        echo "Prepare failed: (" . $con->errno . ") " . $con->error;
        return null;
    }

    $stmt->bind_param("i", $adminId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Returns an associative array with the admin's details
    }

    return null;
}

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

function alert(string $type, string $pay, string $title, string $msg, string $button): void
{
    $class = $type === "error" ? "error" : "success";
    $icon = $type === "error"
        ? '<svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path></svg>'
        : '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_iconCarrier"><path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg>';

    echo <<<HTML
    <dialog id="alertDialog">
        <div class="alert_container">
            <div role="alert" class="$class">
                <div class="alert_header">
                    <div class="image">$icon</div>
                    <div class="content">
                        <span class="title">$title</span>
                        <p class="message">$msg</p>
                    </div>
                    <div class="actions">
                        <button id="alertClose" class="alertClose" aria-label="Close" data-dismiss="alert" onclick="closeAlertDialog('$pay')"
                            type="button">$button</button>
                    </div>
                </div>
            </div>
        </div>
    </dialog>
    
HTML;

    echo "<script>
        const alertDialog = document.querySelector('#alertDialog');
        alertDialog.showModal();

        function closeAlertDialog(pay) {
            const alertDialog = document.querySelector('#alertDialog');
            alertDialog.close();
            alertDialog.parentNode.removeChild(alertDialog);
            if (pay === 'instapay') {
                openInstaPayDialog();
            } else if(pay == 'cash') {
                openCashAtSchoolDialog();
            }
        }
    </script>";
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

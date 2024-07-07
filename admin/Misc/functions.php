<?php

function filteration($data)
{
    $filteredData = array();

    foreach ($data as $key => $value) {
        // Trim whitespace
        $value = trim($value);
        
        // Remove backslashes
        $value = stripslashes($value);
        
        // Encode special characters
        $value = htmlspecialchars($value);
        
        $value = strip_tags($value);

        // Add filtered value to new array
        $filteredData[$key] = $value;
    }

    return $filteredData;
}


function select($sql, $values, $datatypes)
{
    $con = $GLOBALS['con'];

    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            die("Query Cannot Be Excuted - Select");
        }
    } else {
        die("Query Cannot Be Prepared - Select");
    }
}

function alert($type, $title,$msg)
{
    if ($type === "error") {
        $class = "error";
        $icon = '<svg
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        aria-hidden="true"
        >
        <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"
        ></path>
        </svg>';
    } elseif ($type === "success") {
        $class = "success";
        $icon = '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20 7L9.00004 18L3.99994 13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>';
    }
    echo <<<alert
    <div class="alert_container" id="popup">
        <div role="alert" class="$class">
            <div class="alert_header">
                <div class="image">
                    $icon
                </div>
                <div class="content">
                    <span class="title">$title</span>
                    <p class="message">$msg</p>
                </div>
                <div class="actions">
                    <button
                    class="desactivate close"
                    aria-label="Close"
                    data-dismiss="alert"
                    type="button"
                    onclick="closePopup()"
                    >
                    Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    alert;
    echo "<script>";
    echo "var titleVariableFromPHP = '" . $title . "';";
    echo "</script>";
}

function addBodyClassAndStyle() {
    echo '<script>';
    echo 'document.body.classList.add("alertCalled");';
    echo '</script>';
}

function adminLogin()
{
    session_start();
    if (!(isset($_SESSION["adminLogin"]) && $_SESSION["adminLogin"] == true)) {
        echo "
        <script>window.location.href='../Login/index.php';</script>
        ";
    }
}

?>
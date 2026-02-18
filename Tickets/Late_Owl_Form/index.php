<?php

include('../../admin/Misc/functions.php');
include("../../Misc/db_conn.php");

// Function to fetch ticket status by ID
function getTicketStatus($con, $ticket_id) {
    $query = "SELECT ticket_status FROM settings WHERE id = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : null;
    $status = $row['ticket_status'] ?? null;
    $stmt->close();
    return $status;
}

// Fetch Late Owl ticket details (id = 1)
function getLateOwlTicket($con) {
    $query = "SELECT ticket_price, ticket_discount FROM settings WHERE id = 2 LIMIT 1";
    $result = $con->query($query);
    return $result ? $result->fetch_assoc() : ['ticket_price' => 0, 'ticket_discount' => 0];
}

// Example usage
$lateOwl = getLateOwlTicket($con);

$late_price    = $lateOwl['ticket_price'];
$late_discount = $lateOwl['ticket_discount'];
$late_final    = $late_price - $late_discount;

$ticket_status2 = getTicketStatus($con, 2); // Late Owl status

if ($ticket_status2 == "sold_out" || $ticket_status2 == "coming_soon") {
    header('Location:../../Misc/error.html');
}

// Validate email
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Get IP
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

$frm_data = filteration($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $frm_data['first_name'];
    $last_name = $frm_data['last_name'];
    $name = $first_name . " " . $last_name;
    $email = $frm_data['email'];
    $phone = $frm_data['phone'];
    $age = $frm_data['age'];
    $location = $frm_data['location'];
    $ticket_type = $frm_data['ticket_type'];
    $ticket_sub_type = $frm_data['ticket_sub_type'];
    
    if (empty($frm_data['ted_event_name'])) {
        $ted_event_name = "This Option did't appear to him/her";
    } else {
        $ted_event_name = $frm_data['ted_event_name'];
    }
    
    if (empty($frm_data['school'])) {
        $school = "This Option did't appear to him/her";
    } else {
        $school = $frm_data['school'];
    }
    

    $gender = "";
    $p_phone = "";
    $learning_type = "";
    $login_type = "";
    $st_mfis = "";
    $grade = "";
    $ted_event = "";
    $pay = "";

    // Get user IP address and browser and operating system
    $user_ip = get_client_ip();
    $user_browser = $_SERVER['HTTP_USER_AGENT'];
    $user_os = php_uname('s');

    if (isset($frm_data['submit'])) {

        if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($age) || empty($location) || empty($frm_data['gender']) || empty($frm_data['login_type']) || empty($frm_data['ted_event']) || empty($frm_data['payment_method'])) {
            alert("error","", "Please fill in all required fields", "Oops! It seems like you missed filling in some required fields. Please make sure to fill in all the mandatory information and try again.", "Close");
            
        } elseif ($frm_data['age'] < 14) {
            alert("error","" , "Age Requirement Error", "We're sorry, but you must be at least 14 years old to submit this form. Please ensure you meet the age requirement before proceeding.", "Close");
            
        } elseif (!is_valid_email($email)) {
            alert("error","", "Invalid email format", "The email address you provided is not in a valid format. Please double-check your email address and ensure it follows the correct format (e.g., example@email.com).", "Close");
            
        } else {
            include("../../Misc/db_conn.php");

            $gender = $frm_data['gender'];
            $login_type = $frm_data['login_type'];
            $ted_event = $frm_data['ted_event'];
            $pay = $frm_data['payment_method'];

            if (empty($frm_data['st_mfis'])) {
                $st_mfis = "No";
            } else {
                $st_mfis = $frm_data['st_mfis'];
            }
            
            if (empty($frm_data['grade'])) {
                $grade = "This Option did't appear to him/her";
            } else {
                $grade = $frm_data['grade'];
            }

            if (empty($frm_data['learning_type'])) {
                $learning_type = "This Option did't appear to him/her";
            } else {
                $learning_type = $frm_data['learning_type'];
            }

            if (empty($frm_data['p_phone'])) {
                $p_phone = "This Option did't appear to him/her";
            } else {
                $p_phone = $frm_data['p_phone'];
            }


            if (mysqli_connect_errno()) {
                die("Connection error: (" . mysqli_connect_errno() . ") " . mysqli_connect_error());
            } else {
                // Check if email or phone is already used
                $SELECT = "SELECT email FROM user_cred WHERE email = ? LIMIT 1";
                $stmt = $con->prepare($SELECT);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                $rnum = $stmt->num_rows;

                if ($rnum == 0) {
                    // Check if phone is already used
                    $SELECT = "SELECT phone FROM user_cred WHERE phone = ? LIMIT 1";
                    $stmt = $con->prepare($SELECT);
                    $stmt->bind_param("s", $phone);
                    $stmt->execute();
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;

                    if ($rnum == 0) {
                        $stmt->close();

                        // Insert new data
                        $INSERT = "INSERT INTO user_cred 
                        (first_name, last_name, name, email, phone, age, school, location, ted_event_name, ip_address, browser, operating_system, st_mfis, login_type, ted_event, gender, grade, payment_method, paid, learning_type, p_phone, ticket_type, ticket_sub_type, submit_date) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

                        $stmt = $con->prepare($INSERT);

                        $paid = $late_final;

$stmt->bind_param("sssssissssssssssssissss", 
    $first_name,
    $last_name,
    $name,
    $email,
    $phone,
    $age,
    $school,
    $location,
    $ted_event_name,
    $user_ip,
    $user_browser,
    $user_os,
    $st_mfis,
    $login_type,
    $ted_event,
    $gender,
    $grade,
    $pay,
    $paid,
    $learning_type,
    $p_phone,
    $ticket_type,
    $ticket_sub_type
);


                        $stmt->execute();

                        // Display success message
                        if ($_POST["payment_method"] == "instapay") {
                            alert("success", "instapay", "Thanks For Submit", "Congratulations! Your details have been successfully submitted. Thanks!","Proceed to Payment Instructions");

                        } else {
                            alert("success", "cash","Thanks For Submit", "Congratulations! Your details have been successfully submitted. Thanks!","Proceed to Payment Instructions");
                        }
                    } else {
                        alert("error","", "Phone is already used", "The phone number you entered is already associated with another form. Please use a different phone number.", "Close");
                    }
                } else {
                    alert("error","", "Email is already used", "The email address you entered is already associated with another form. Please use a different email address.","Close");
                }

                $stmt->close();
                $con->close();
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Get your tickets for TEDxManaratAlFaroukSchool and be part of an event filled with innovative ideas, inspiring talks, and engaging experiences.">
    <meta name="keywords"
        content="TEDxManaratAlFaroukSchool tickets, buy TEDx tickets, TEDx event, TEDx ticket sales, TEDx participation, attend TEDx, TEDx event tickets">
    <meta name="robots" content="index, follow">
    <meta name="referrer" content="no-referrer">
    <meta name="author" content="TEDxManaratAlFaroukSchool">

    <link rel="shortcut icon" href="images/x-art.png" type="image/x-icon">
    <!-- <base href="http://localhost/TEDxManaratAlfaroukSchool/"> -->
    <base href="https://tedxmanaratalfaroukschool.com/">


    <link rel="stylesheet" href="assets\fontawesome-free-6.6.0-web\fontawesome-free-6.6.0-web\css\all.css">

    <link rel="stylesheet" href="Tickets/style-tickets.css">
    <link rel="stylesheet" href="Tickets/style-tickets copy.css">
    <link rel="stylesheet" href="style.css">
    <title>Late Owl Ticket Form</title>
</head>

<body>
    <div id="tickets">

        <div class="payment-section">
            <div class="container">
                <div class="payment-wrapper">
                    <div class="payment-right">
                        <div class="main">
                            <h1>Late Owl Ticket Form</h1>
                            <form id="myForm" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                                <input type="hidden" name="ticket_type" value="single">
                                <input type="hidden" name="ticket_sub_type" value="late owl">
                                <!-- Account Information Start -->
                                <h4>Your Information</h4>
                                <div class="input_group">
                                    <div class="input_box">
                                        <input type="text" class="name" id="first_name" name="first_name"
                                            placeholder=" ">
                                        <label for="first_name"
                                            class="payment-form-label payment-form-label-required">First
                                            Name</label>
                                        <!-- <i class="fa fa-user icon"></i> -->
                                        <i class="fi fi-rr-user icon"></i>

                                    </div>
                                    <div class="input_box">
                                        <input type="text" class="name" id="last_name" name="last_name" placeholder=" ">
                                        <label for="last_name"
                                            class="payment-form-label payment-form-label-required">Last
                                            Name</label>
                                        <!-- <i class="fa fa-user icon"></i> -->
                                        <i class="fi fi-rr-user icon"></i>
                                    </div>
                                </div>
                                <div class="input_group">
                                    <div class="input_box">
                                        <input type="text" class="name" id="email" name="email" placeholder=" ">

                                        <label for="email"
                                            class="payment-form-label payment-form-label-required">Email</label>
                                        <!-- <i class="fa fa-envelope icon"></i> -->
                                        <i class="fi fi-rr-at icon"></i>
                                    </div>
                                </div>
                                <div class="input_group">
                                    <div class="input_box">
                                        <input type="text" class="name" id="location" name="location" placeholder=" ">

                                        <label for="location"
                                            class="payment-form-label payment-form-label-required test-resp">Area of
                                            Residence</label>
                                        <!-- <i class="fa fa-map-marker icon" aria-hidden="true"></i> -->
                                        <i class="fi fi-rr-map-marker icon"></i>
                                    </div>
                                </div>
                                <div class="input_group">
                                    <div class="input_box">
                                        <input type="number" class="name" id="phone" name="phone" placeholder=" ">

                                        <label for="phone" class="payment-form-label payment-form-label-required">Phone
                                            Number</label>
                                        <!-- <i class="fa fa-phone icon"></i> -->
                                        <i class="fi fi-rr-phone-call icon"></i>
                                    </div>
                                </div>

                                <div class="input_group" id="st-parent_q">
                                    <div class="input_box">
                                        <h4>You are</h4>
                                        <input type="radio" id="student" name="login_type" class="radio"
                                            value="Student In School">
                                        <label class="radio-label login_type" id="student" for="student">Student In
                                            School</label>
                                        <input type="radio" id="college" name="login_type" class="radio"
                                            value="Student In College">
                                        <label class="radio-label login_type" id="college" for="college">Student In
                                            College</label>
                                        <input type="radio" id="parent" name="login_type" class="radio" value="Parent">
                                        <label class="radio-label login_type" id="parent" for="parent">Parent</label>
                                    </div>
                                </div>

                                <!-- <div class="input_group" id="sch-coll-q">
                                <div class="input_box">
                                    <h4>You are in</h4>
                                    <input type="radio" id="school" name="sch/coll" class="radio"   required>
                                    <label class="radio-label" for="school">School</label>
                                    <input type="radio" id="college" name="sch/coll" class="radio"   required>
                                    <label class="radio-label" for="college">College</label>
                                </div>
                                </div> -->
                                <div class="input_group" id="p_phone">
                                    <div class="input_box">
                                        <input type="number" class="name" id="p_phone" name="p_phone" placeholder=" ">

                                        <label for="p_phone"
                                            class="payment-form-label payment-form-label-required">Parent Phone
                                            Number</label>
                                        <!-- <i class="fa fa-phone icon"></i> -->
                                        <i class="fi fi-rr-phone-call icon"></i>
                                    </div>
                                </div>

                                <div class="input_group" id="st-MFIS">
                                    <div class="input_box">
                                        <h4>Are You Student In Manarat Al Farouk</h4>
                                        <input type="radio" id="yes" name="st_mfis" class="radio" value="Yes">
                                        <label class="radio-label" for="yes">Yes</label>
                                        <input type="radio" id="no" name="st_mfis" class="radio" value="No">
                                        <label class="radio-label" for="no">No</label>
                                    </div>

                                </div>

                                <div class="input_group" id="st-no">
                                    <div class="input_box">
                                        <input type="text" class="name" id="school" name="school" placeholder=" ">
                                        <label for="location"
                                            class="payment-form-label payment-form-label-required test-resp">State Your
                                            School</label>
                                        <i class="fi fi-rr-school icon"></i>
                                    </div>
                                </div>
                                <div class="input_group" id="st-yes2">
                                    <div class="input_box">
                                        <h4>Learning Type</h4>
                                        <input type="radio" id="National" name="learning_type" class="radio"
                                            value="National">
                                        <label class="radio-label" for="National">National</label>
                                        <input type="radio" id="IG" name="learning_type" class="radio" value="IG">
                                        <label class="radio-label" for="IG">IG</label>
                                    </div>

                                </div>
                                <div class="input_group" id="st-yes">
                                    <div class="input_box">
                                        <h4>Your Grade</h4>
                                        <input type="radio" id="grade-7" name="grade" class="radio" value="Grade 7">
                                        <label class="radio-label grade7" for="grade-7">Grade 7</label>
                                        <input type="radio" id="grade-8" name="grade" class="radio" value="Grade 8">
                                        <label class="radio-label grade8" for="grade-8">Grade 8</label>
                                        <input type="radio" id="grade-9" name="grade" class="radio" value="Grade 9">
                                        <label class="radio-label grade9" for="grade-9">Grade 9</label>
                                        <input type="radio" id="grade-10" name="grade" class="radio" value="Grade 10">
                                        <label class="radio-label grade10" for="grade-10">Grade 10</label>
                                        <input type="radio" id="grade-11" name="grade" class="radio" value="Grade 11">
                                        <label class="radio-label grade11" for="grade-11">Grade 11</label>
                                        <input type="radio" id="grade-12" name="grade" class="radio" value="Grade 12">
                                        <label class="radio-label grade12" for="grade-12">Grade 12</label>
                                    </div>

                                </div>
                                <div class="input_group">
                                    <div class="input_box">
                                        <h4>Have You Ever Attended a TEDx Event?</h4>
                                        <input type="radio" id="yes2" name="ted_event" class="radio" value="Yes">
                                        <label class="radio-label" for="yes2">Yes</label>
                                        <input type="radio" id="no2" name="ted_event" class="radio" value="No">
                                        <label class="radio-label" for="no2">No</label>
                                    </div>
                                </div>
                                <div class="input_group" id="ted-event-yes">
                                    <div class="input_box">
                                        <input type="text" class="name" id="ted-event-name" name="ted_event_name"
                                            placeholder=" ">
                                        <label for="ted-event-name"
                                            class="payment-form-label payment-form-label-required test-resp">Mention
                                            Which Tedx Event</label>
                                        <i class="fi fi-rr-calendar-days icon   "></i>
                                    </div>
                                </div>
                                <!-- Account Information End -->

                                <!-- Age & Gender Start -->

                                <div class="input_group">
                                    <div class="input_box">
                                        <h4>Age</h4>
                                        <input type="number" class="name" id="age" name="age" placeholder="" min=0>
                                        <!-- <i class="fa fa-fingerprint icon"></i> -->
                                        <!-- <label for="age" class="payment-form-label payment-form-label-required">Age</label> -->

                                    </div>
                                    <div class="input_box">
                                        <h4>Gender</h4>
                                        <input type="radio" id="male" name="gender" class="radio" value="Male">
                                        <label class="radio-label" for="male">Male</label>
                                        <input type="radio" id="female" name="gender" class="radio" value="Female">
                                        <label class="radio-label" for="female">Female</label>
                                    </div>
                                </div>
                                <!-- Age & Gender End -->
                                <!-- Payment Details Start -->
                                <h4>Payment Method</h4>
                                <div class="input_group">
                                    <div class="input_box">
                                        <input type="radio" name="payment_method" id="bc1" class="radio"
                                            value="instapay">
                                        <label class="radio-label pay-method" for="bc1">
                                            <span>
                                                <img src="images/insta.png"
                                                    style="width:27px; margin-right:8px;"></img>Instapay
                                            </span>
                                        </label>

                                    </div>
                                </div>
                                <div class="input_group">
                                    <div class="input_box">
                                        <input type="radio" name="payment_method" id="bc2" class="radio" value="cash">
                                        <label class="radio-label pay-method" for="bc2">
                                            <span>
                                                <i class="fa-solid fa-money-bills"></i>Cash at School
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <!-- InstaPy Dialog -->
                                <dialog class="payment_details" id="instaPayDialog">
                                    <h2>InstaPay</h2>
                                    <img src="images/instapayqrcode.jpeg" />
                                    <ol>
                                        <li style="list-style:none; text-align:center;"><Strong
                                                style="color: var(--ted-color)">IF You use Mobile</Strong></li>
                                        <li> <a href="https://ipn.eg/S/maryamelshafie2/instapay/9d5BVu">Click this
                                                Link</a> it will redirect you to Instapy app OR scan the QR code with
                                            the camera of another phone.</li>
                                        <li>Then enter this amount : <strong
                                                id="ticket_total"><?= htmlspecialchars($late_final) ?></strong> EGP
                                        </li>
                                        <li>Confirm the transaction.</li>
                                        <li>Send a screenshot of the transaction to this number:
                                            <strong>01035870735</strong> on WhatsApp or
                                            <a href="https://wa.me/201035870735" target="_blank"
                                                style="color: green; font-weight:600; text-decoration:none;">Click This
                                                Link</a>.
                                        </li>
                                        <li>And send a message with the phone number you wrote in the form to the
                                            WhatsApp number above.</li>
                                    </ol>

                                    <ol>
                                        <li style="list-style:none; text-align:center;"><Strong
                                                style="color: var(--ted-color)">IF You use ON PC or Laptop</Strong></li>
                                        <li>Open your mobile camera app.</li>
                                        <li>Scan The QR code.</li>
                                        <li>Then enter this amount : <strong
                                                id="ticket_total"><?= htmlspecialchars($late_final) ?></strong> EGP
                                        </li>
                                        <li>Confirm the transaction.</li>
                                        <!-- <li>Send a screenshot of the transaction to this number: <strong>01035870735</strong> on WhatsApp or
                                        <a href="https://wa.me/201035870735" target="_blank" style="color: green; font-weight:600; text-decoration:none;">Click This Link</a>. </li> -->
                                        <li>Then send a screenshot of the transaction to this number:
                                            <strong>01035870735</strong> on WhatsApp.
                                        </li>
                                        <li>Send a message with the phone number you wrote in the form.</li>
                                    </ol>

                                    <p style="font-size:30px; text-align:center;"><strong
                                            style="color: var(--ted-color);"><i
                                                class="fa-solid fa-triangle-exclamation"></i> Important Notes</strong>
                                    </p>
                                    <ol style="margin-top:20px;">
                                        <li>Make Sure You Entered The Correct Amount</li>
                                        <li>Make Sure To Send the Screenshot to the WhatsApp Number Above to Get Your
                                            Ticket</li>
                                        <li>Make Sure to Send the Correct Number You Wrote in the Form to the WhatsApp
                                            Number</li>
                                    </ol>

                                    <div class="input_box">
                                        <a href="index.php"><button type="button"
                                                onclick="closeDialog('instaPayDialog')">Okay</button></a>
                                    </div>
                                </dialog>

                                <!-- Cash at School Dialog -->
                                <dialog class="payment_details" id="cashAtSchoolDialog">
                                    <h2>Cash at MFIS School</h2>
                                    <p>📍 Location : <a href="https://maps.app.goo.gl/JUi2FjJ8y4J9fkGy6" target="_blank"
                                            rel="noopener noreferrer">MFIS</a></p>
                                    <ol>
                                        <strong>You will receive the ticket by email upon payment.</strong>
                                        <p>You can contact one of the numbers bellow on WhatsApp a day prior to pay for
                                            your ticket at school</p>
                                        <br>
                                        <li>National (Girls)<br>Salma - 0 110 725 9620<br>Jana - 0 120 823 1545</li>
                                        <br>
                                        <li>IG (Girls)<br>Rovan - 0 100 333 9063</li>
                                        <br>
                                        <li>National (Boys)<br>Omar ashraf - 0 122 701 5734<br>Moaz Hany - 0 101 556 3533</li>
                                        <br>
                                        <h2>Cash at FIS School</h2>
                                        <p>📍 Location : <a href="https://maps.app.goo.gl/9qrd5ywT1E1i7zMu5" target="_blank"
                                            rel="noopener noreferrer">FIS</a></p>
                                        <li>FIS (Girls)<br>habiba yehia - 0 109 353 8909</li>
                                    </ol>
                                    <div class="input_box">
                                        <button type="button" onclick="closeDialog('cashAtSchoolDialog')">Okay</button>
                                    </div>
                                </dialog>
                                <!-- <div id="formcc">
                                <div class="input_group ">
                                    <div class="input_box">
                                        <input type="number" class="name" id="card_number" name="card_number" placeholder=" " required>
                                        <label for="card_number" class="payment-form-label payment-form-label-required">Card Number</label>
                                        <i class="fi fi-rr-credit-card icon"></i>
                                    </div>
                                </div>
                                <div class="input_group ">
                                    <div class="input_box">
                                        <input type="text" class="name" id="card_name" name="card_name" placeholder=" " required>
                                        <label for="card_name" class="payment-form-label payment-form-label-required">Cardholder Name</label>
                                        <i class="fi fi-rr-credit-card icon"></i>
                                    </div>
                                </div>

                                <div class="input_group ">
                                    <div class="input_box">
                                        <input type="number" class="name" id="cvv" name="cvv" placeholder=" " required>
                                        <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                                        <div class="icon"><img src="user\images\cvv.png" alt="" class=""></div>
                                    </div>
                                </div>
                                <div class="input_group ">
                                    <div class="input_box">
                                        <input type="number" class="name" id="exp_month" name="exp_month" placeholder=" " required>
                                        <label for="exp_month" class="payment-form-label payment-form-label-required">Exp Month</label>
                                        <i class="fi fi-rr-calendar-days icon"></i>
                                    </div>
                                </div>
                                <div class="input_group ">
                                    <div class="input_box">
                                        <input type="number" class="name" id="exp_year" name="exp_year" placeholder=" " required>
                                        <label for="exp_year" class="payment-form-label payment-form-label-required">Exp Year</label>
                                        <i class="fi fi-rr-calendar icon"></i>
                                    </div>
                                </div>
                            </div> -->
                                <div class="input_group">
                                    <div class="input_box">
                                        <button type="submit" name="submit">Submit</button>
                                    </div>
                                </div>


                                <!-- Payment Details End -->
                            </form>

                        </div>

                        <!--messeage when form is locked -->

                        <div class="done_message" id="done_message">
                            <p>We're All Done For 2024, But You Can Watch The 2023 Talks 🎬👇</p>
                            <a href="user\Talks\talks.php"><button>Our Talks</button></a>
                        </div>

                    </div>
                    <div class="payment-left">
                        <div class="payment-header">
                            <div class="payment-header-icon"><i class="fa-solid fa-bolt"></i></div>
                            <div class="payment-header-title">Order Summary</div>
                            <p class="payment-header-description"></p>
                        </div>
                        <div class="payment-content">
                            <div class="payment-body">
                                <div class="payment-plan">
                                    <div class="payment-plan-type">Late</div>
                                    <div class="payment-plan-info">
                                        <div class="payment-plan-info-name">Late Owl (single) Ticket</div>
                                        <div class="payment-plan-info-price" id="ticket_price">
                                            <?= htmlspecialchars($late_price) ?> EGP</div>
                                    </div>
                                </div>
                                <div class="payment-summary">
                                    <div class="payment-summary-item">
                                        <div class="payment-summary-name">Discount</div>
                                        <div class="payment-summary-price" id="ticket_discount">
                                            <?= htmlspecialchars($late_discount) ?> EGP</div>
                                    </div>
                                    <div class="payment-summary-divider"></div>
                                    <div class="payment-summary-item payment-summary-total">
                                        <div class="payment-summary-name">Total</div>
                                        <div class="payment-summary-price" id="ticket_total">
                                            <?= htmlspecialchars($late_final) ?> EGP</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- <div class="cursor"></div>
    <div class="cursor2"></div> -->
        <script src="script.js"></script>
        <script>
        function openInstaPayDialog() {
            const dialog = document.getElementById('instaPayDialog');
            if (dialog) {
                dialog.showModal();
            }
        }

        function openCashAtSchoolDialog() {
            const dialog = document.getElementById('cashAtSchoolDialog');
            if (dialog) {
                dialog.showModal();
            }
        }

        function closeDialog(dialogId) {
            const dialog = document.getElementById(dialogId);
            if (dialog) {
                dialog.close();
            }
        }
        </script>
        <script>
        function closePopup() {
            let popup = document.getElementById("popup");
            let age = document.getElementById("age");
            let email = document.getElementById("email");
            let phone = document.getElementById("phone");
            popup.classList.add("close_popup");
            document.body.classList.remove("alertCalled");
            if (titleVariableFromPHP == "Age Requirement Error") {
                age.value = '';
                age.focus();
            } else if (titleVariableFromPHP == "Invalid email format") {
                email.value = '';
                email.focus();
            } else if (titleVariableFromPHP == "Phone is already used") {
                phone.value = '';
                phone.focus();
            }
        }

        // hide the elements
        document.getElementById("st-MFIS").style.display = "none";
        document.getElementById("p_phone").style.display = "none";
        document.getElementById("st-no").style.display = "none";
        document.getElementById("st-yes").style.display = "none";
        document.getElementById("st-yes2").style.display = "none";
        document.getElementById("ted-event-yes").style.display = "none";

        // Function to show or hide elements based on radio button selection
        function handleRadioSelection() {
            var studentRadio = document.getElementById("student");
            var collegeRadio = document.getElementById("college");
            var parentRadio = document.getElementById("parent");
            var tedEventYesRadio = document.getElementById("yes2");
            var tedEventNoRadio = document.getElementById("no2");
            var tedEventInput = document.getElementById("ted-event-name");

            // If 'student' radio is selected
            studentRadio.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById("st-MFIS").style.display = "flex";
                    document.getElementById("p_phone").style.display = "flex";
                    document.getElementById("st-no").style.display = "none";
                    document.getElementById("st-yes").style.display = "none";
                    document.getElementById("st-yes2").style.display = "none";
                }
            });

            // If 'college' radio is selected
            collegeRadio.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById("st-MFIS").style.display = "none";
                    document.getElementById("p_phone").style.display = "none";
                    document.getElementById("st-no").style.display = "none";
                    document.getElementById("st-yes").style.display = "none";
                    document.getElementById("st-yes2").style.display = "none";
                    clearStYes(); // Clear selected radio buttons in 'st-yes'
                    clearStMFIS(); // Clear selected radio button in 'st-mfis'
                }
            });

            // If 'parent' radio is selected
            parentRadio.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById("st-MFIS").style.display = "none";
                    document.getElementById("p_phone").style.display = "none";
                    document.getElementById("st-no").style.display = "none";
                    document.getElementById("st-yes").style.display = "none";
                    document.getElementById("st-yes2").style.display = "none";
                    clearStYes(); // Clear selected radio buttons in 'st-yes'
                    clearStMFIS(); // Clear selected radio button in 'st-mfis'
                }
            });

            // If 'ted-event-yes' radio is selected
            tedEventYesRadio.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById("ted-event-yes").style.display = "flex";
                } else {
                    document.getElementById("ted-event-yes").style.display = "none";
                    tedEventInput.value = ""; // Clear input
                }
            });

            // If 'ted-event-no' radio is selected
            tedEventNoRadio.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById("ted-event-yes").style.display = "none";
                    tedEventInput.value = ""; // Clear input
                }
            });

            // If 'yes' or 'no' in 'st-MFIS' is selected
            var mfisYesRadio = document.getElementById("yes");
            var mfisNoRadio = document.getElementById("no");

            mfisYesRadio.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById("st-yes").style.display = "flex";
                    document.getElementById("st-yes2").style.display = "flex";
                    document.getElementById("st-no").style.display = "none";
                }
            });

            mfisNoRadio.addEventListener('change', function() {
                if (this.checked) {
                    document.getElementById("st-no").style.display = "flex";
                    document.getElementById("st-yes").style.display = "none";
                    document.getElementById("st-yes2").style.display = "none";
                    clearStYes();
                }
            });
        }

        // Function to clear selected radio buttons in 'st-yes'
        function clearStYes() {
            var gradeRadios = document.querySelectorAll('input[name="grade"]');
            gradeRadios.forEach(function(radio) {
                radio.checked = false;
            });
        }

        function clearStYes() {
            var gradeRadios = document.querySelectorAll('input[name="learning_type"]');
            gradeRadios.forEach(function(radio) {
                radio.checked = false;
            });
        }

        // Function to clear selected radio buttons in 'st-MFIS'
        function clearStMFIS() {
            var gradeRadios = document.querySelectorAll('input[name="st_mfis"]');
            gradeRadios.forEach(function(radio) {
                radio.checked = false;
            });
        }

        // Call the function to handle radio button selection
        handleRadioSelection();

        // Avoid taking '-' and '+' in the age input
        document.getElementById('age').addEventListener('keydown', function(event) {
            if (event.key === '-' || event.key === '+') {
                event.preventDefault();
            }
        });
        </script>

    </div>
</body>

</html>
<?php

include('../../admin/Misc/functions.php');

    // Validate email
    function is_valid_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    //get ip
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
        $email = $frm_data['email'];
        $phone = $frm_data['phone'];
        $age = $frm_data['age'];
        $school = $frm_data['school'];
        $location = $frm_data['location'];
        $ted_event_name = $frm_data['ted_event_name'];

        $gender = "";
        $login_type = "";
        $st_mfis ="";
        $grade = "";
        $ted_event = "";

        // Get user IP address and browser and operating system
        $user_ip = get_client_ip();
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $user_os = php_uname('s');

        if (isset($frm_data['submit'])) {

            if (empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($age) || empty($school) || empty($location) || empty($frm_data['gender']) || empty($frm_data['login_type']) || empty($frm_data['st_mfis']) || empty($frm_data['grade']) || empty($frm_data['ted_event']) || empty($ted_event_name)) {
                alert("error", "Please fill in all required fields","Oops! It seems like you missed filling in some required fields. Please make sure to fill in all the mandatory information and try again.");
                addBodyClassAndStyle();
            } elseif ($frm_data['age'] < 13) {
                alert("error", "Age Requirement Error","We're sorry, but you must be at least 13 years old to submit this form. Please ensure you meet the age requirement before proceeding.");
                addBodyClassAndStyle();
            } elseif (!is_valid_email($email)) {
                alert("error", "Invalid email format","The email address you provided is not in a valid format. Please double-check your email address and ensure it follows the correct format (e.g., example@email.com).");
                addBodyClassAndStyle();
            } else {

                include("../db_con.php");

                $gender = $frm_data['gender'];
                $login_type = $frm_data['login_type'];
                $st_mfis = $frm_data['st_mfis'];
                $grade = $frm_data['grade'];
                $ted_event = $frm_data['ted_event'];

            if (mysqli_connect_errno()) {
                die("Connection error: (" . mysqli_connect_errno() . ") " . mysqli_connect_error());
            } else {
                $SELECT = "SELECT phone FROM user_cred WHERE phone = ? LIMIT 1";
                $INSERT = "INSERT INTO user_cred (first_name, last_name, email, phone, age, school, location, ted_event_name, ip_address, browser, operating_system, st_mfis, login_type, ted_event, gender, grade, submit_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DATE_FORMAT(NOW(), '%Y-%m-%d %h:%i:%s %p'))";


                // Check if phone is already used
                $stmt = $con->prepare($SELECT);
                $stmt->bind_param("i", $phone);
                $stmt->execute();
                $stmt->store_result();
                $rnum = $stmt->num_rows;

                if ($rnum == 0) {
                    $stmt->close();

                    // Insert new data or inform the user that the phone is used
                    $stmt = $con->prepare($INSERT);
                    $stmt->bind_param("sssiisssssssssss", $first_name, $last_name, $email, $phone, $age, $school, $location, $ted_event_name, $user_ip, $user_browser, $user_os, $st_mfis, $login_type, $ted_event, $gender, $grade);
                    $stmt->execute();

                    // Redirect to thanks for submit or display a success message
                    alert("success", "Thanks For Submit","Congratulations! Your details has been successfully submitted. Thanks!");
                    addBodyClassAndStyle();
                    exit;
                } else {
                    alert("error", "Phone is already used","The phone number you entered is already associated with another form. Please use a different phone number.");
                    addBodyClassAndStyle();
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
        <script src="https://kit.fontawesome.com/66081d606d.js" crossorigin="anonymous"></script>
        <link rel="shortcut icon" href="user/images/x-art.png" type="image/x-icon">
        <base href="http://localhost/Me_TEDxMFIS/">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="user/Tickets/style-tickets.css">
        <link rel="stylesheet" href="user/style.css">
        <title>TEDx Manarat AlFarouk School - Spreading ideas, inspiring change.</title>
    </head>

    <body>

        <div class="payment-section">
            <div class="container">
                <div class="payment-wrapper">
                    <div class="payment-right">
                        <div class="main">
                            <h1>Tickets Form</h1>
                            <form id="myForm" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                                <!-- Account Information Start -->
                                <h4>Your Information</h4>
                                <div class="input_group">
                                    <div class="input_box">
                                        <input type="text" class="name" id="first_name" name="first_name"
                                            placeholder=" ">
                                        <label for="first_name"
                                            class="payment-form-label payment-form-label-required">First Name</label>
                                        <!-- <i class="fa fa-user icon"></i> -->
                                        <i class="fi fi-rr-user icon"></i>

                                    </div>
                                    <div class="input_box">
                                        <input type="text" class="name" id="last_name" name="last_name" placeholder=" ">
                                        <label for="last_name"
                                            class="payment-form-label payment-form-label-required">Last Name</label>
                                        <!-- <i class="fa fa-user icon"></i> -->
                                        <i class="fi fi-rr-user icon"></i>
                                    </div>
                                </div>
                                <div class="input_group">
                                    <div class="input_box">
                                        <input type="text" class="name" id="email" name="email" placeholder=" ">

                                        <label for="emai"
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
                                        <input type="radio" id="parent" name="login_type" class="radio"
                                            value="Student In College">
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
                                            School, University or Working Field</label>
                                        <i class="fi fi-rr-school icon"></i>
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
                                <!-- <div class="input_group">
                                <div class="input_box">
                                    <h4>Payment Details</h4>
                                    <input type="radio" name="pay" id="bc1" class="radio" value="cc" >
                                    <label  class="radio-label" for="bc1">
                                        <span>
                                            <i class="fa fa-cc-visa"></i>Credit Card
                                        </span>
                                    </label>
                                    <input type="radio" name="pay" id="bc2" class="radio" value="cash" >
                                    <label class="radio-label" for="bc2">
                                        <span>
                                            <i class="fa-solid fa-money-bills"></i>Cash
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div id="formcc">
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
                            <p class="payment-header-description">Lorem ipsum dolor sit amet consectetur adipisicing</p>
                        </div>
                        <div class="payment-content">
                            <div class="payment-body">
                                <div class="payment-plan">
                                    <div class="payment-plan-type">Basic</div>
                                    <div class="payment-plan-info">
                                        <div class="payment-plan-info-name">Basic Ticket</div>
                                        <div class="payment-plan-info-price">350 EGP</div>
                                    </div>
                                </div>
                                <div class="payment-summary">
                                    <div class="payment-summary-item">
                                        <div class="payment-summary-name">Addtional Fee</div>
                                        <div class="payment-summary-price">10 EGP</div>
                                    </div>
                                    <div class="payment-summary-item">
                                        <div class="payment-summary-name">Discount</div>
                                        <div class="payment-summary-price">-10 EGP</div>
                                    </div>
                                    <div class="payment-summary-divider"></div>
                                    <div class="payment-summary-item payment-summary-total">
                                        <div class="payment-summary-name">Total</div>
                                        <div class="payment-summary-price">350 EGP</div>
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
    <script src="user/script.js"></script>

<!-- <script>

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
document.getElementById("st-no").style.display = "none";
document.getElementById("st-yes").style.display = "none";
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
    studentRadio.addEventListener('change', function () {
        if (this.checked) {
            document.getElementById("st-MFIS").style.display = "flex";
            document.getElementById("st-no").style.display = "none";
            document.getElementById("st-yes").style.display = "none";
        }
    });

    // If 'college' radio is selected
    collegeRadio.addEventListener('change', function () {
        if (this.checked) {
            document.getElementById("st-MFIS").style.display = "none";
            document.getElementById("st-no").style.display = "none";
            document.getElementById("st-yes").style.display = "none";
            clearStYes(); // Clear selected radio buttons in 'st-yes'
            clearStMFIS(); // Clear selected radio button in 'st-mfis'
        }
    });

    // If 'parent' radio is selected
    parentRadio.addEventListener('change', function () {
        if (this.checked) {
            document.getElementById("st-MFIS").style.display = "none";
            document.getElementById("st-no").style.display = "none";
            document.getElementById("st-yes").style.display = "none";
            clearStYes(); // Clear selected radio buttons in 'st-yes'
            clearStMFIS(); // Clear selected radio button in 'st-mfis'
        }
    });

    // If 'ted-event-yes' radio is selected
    tedEventYesRadio.addEventListener('change', function () {
        if (this.checked) {
            document.getElementById("ted-event-yes").style.display = "flex";
        } else {
            document.getElementById("ted-event-yes").style.display = "none";
            tedEventInput.value = ""; // Clear input
        }
    });

    // If 'ted-event-no' radio is selected
    tedEventNoRadio.addEventListener('change', function () {
        if (this.checked) {
            document.getElementById("ted-event-yes").style.display = "none";
            tedEventInput.value = ""; // Clear input
        }
    });

    // If 'yes' or 'no' in 'st-MFIS' is selected
    var mfisYesRadio = document.getElementById("yes");
    var mfisNoRadio = document.getElementById("no");

    mfisYesRadio.addEventListener('change', function () {
        if (this.checked) {
            document.getElementById("st-yes").style.display = "flex";
            document.getElementById("st-no").style.display = "none";
        }
    });

    mfisNoRadio.addEventListener('change', function () {
        if (this.checked) {
            document.getElementById("st-no").style.display = "flex";
            document.getElementById("st-yes").style.display = "none";
            clearStYes(); 
        }
    });
}

// Function to clear selected radio buttons in 'st-yes'
function clearStYes() {
    var gradeRadios = document.querySelectorAll('input[name="grade"]');
    gradeRadios.forEach(function (radio) {
        radio.checked = false;
    });
}

// Function to clear selected radio buttons in 'st-MFIS'
function clearStMFIS() {
    var gradeRadios = document.querySelectorAll('input[name="st_mfis"]');
    gradeRadios.forEach(function (radio) {
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

</script> -->

    </body>
    </html>
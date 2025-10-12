<?php
require("Misc/db_conn.php");

// Function to fetch ticket status (returns same key 'status' like قبل)
function getTicketStatus($con, $ticket_id) {
    $query = "SELECT ticket_status AS status FROM settings WHERE id = ? LIMIT 1";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result ? $result->fetch_assoc() : null;
    $stmt->close();
    return $row['status'] ?? null;
}

// fetch basic ticket detials from tickets (mapped to same keys basic_ticket_price & custom_discount)
function getTicketPriceAndDiscount($con) {
    $query = "SELECT ticket_price AS basic_ticket_price, ticket_discount AS custom_discount FROM settings WHERE id = 1 LIMIT 1";
    $result = $con->query($query);
    return $result ? $result->fetch_assoc() : ['basic_ticket_price' => 0, 'custom_discount' => 0];
}

// fetch group ticket detials from tickets (mapped to same keys group_ticket_price & custom_discount_group)
function getGroupTicketPriceAndDiscount($con) {
    $query = "SELECT ticket_price AS group_ticket_price, ticket_discount AS custom_discount_group FROM settings WHERE id = 2 LIMIT 1";
    $result = $con->query($query);
    return $result ? $result->fetch_assoc() : ['group_ticket_price' => 0, 'custom_discount_group' => 0];
}

$ticket_id1 = 1; // basic ticket id
$ticket_id2 = 2; // group ticket id

$ticket_status1 = getTicketStatus($con, $ticket_id1);
$ticket_status2 = getTicketStatus($con, $ticket_id2);

$ticket_data = getTicketPriceAndDiscount($con);
$ticket_price = $ticket_data['basic_ticket_price'];
$discount = $ticket_data['custom_discount'];
$final_price = $ticket_price - $discount;

$ticket_data_group = getGroupTicketPriceAndDiscount($con);
$ticket_price_group = $ticket_data_group['group_ticket_price'];
$discount_group = $ticket_data_group['custom_discount_group'];
$final_price_group = $ticket_price_group - $discount_group;

$con->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <!--GOOGLE -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JXGKTBFNV3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-JXGKTBFNV3');
    </script>


    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Learn about TEDxManaratAlFaroukSchool, an independent TEDx event dedicated to sharing ideas and inspiring the community through impactful talks and innovative thinking.">
    <meta name="keywords"
        content="TEDx, TEDxManaratAlFaroukSchool, TEDx Manarat AlFarouk School, tedxmfis, TEDXMFIS, TEDx Egypt, TEDxManarat, TEDxManaratAlFarouk, TEDx Manarat AlFarouk, TEDx Manarat Al Farouk, TEDx Manarat Al Farouk School, TEDxManaratAlFaroukSchool home, tedxmfis home, TEDx Manarat AlFarouk School Home">
    <meta name="robots" content="index, follow">
    <meta name="referrer" content="no-referrer">

    <link rel="canonical" href="https://www.tedxmanaratalfaroukschool.com/">

    <meta name="author" content="TEDxManaratAlFaroukSchool">

    <!-- Open Graph Meta Tags (for social media sharing) -->
    <meta property="og:title" content="TEDx Manarat AlFarouk School">
    <meta property="og:description"
        content="Learn about TEDxManaratAlFaroukSchool, an independent TEDx event dedicated to sharing ideas and inspiring the community through impactful talks and innovative thinking.">

    <meta property="og:image" content="https://www.tedxmanaratalfaroukschool.com/images/TEDxMFIS.jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/jpeg">

    <meta property="og:url" content="https://www.tedxmanaratalfaroukschool.com/">
    <meta property="og:type" content="website">

    <!-- Link to Social Media Profiles -->
    <meta property="og:site_name" content="TEDx Manarat AlFarouk School">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Social media -->

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="TEDx Manarat AlFarouk School">
    <meta name="twitter:description" content="Join TEDxManaratAlFaroukSchool for inspiring talks on innovative ideas.">
    <meta name="twitter:image" content="https://www.tedxmanaratalfaroukschool.com/images/TEDxMFIS.jpeg">



    <!-- Font Awesome -->
    <link rel="preload" href="assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <!-- Favicon -->
    <link rel="icon" href="https://www.tedxmanaratalfaroukschool.com/images/x-art.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://www.tedxmanaratalfaroukschool.com/images/x-art.png" type="image/x-icon">

    <!-- Slick Files -->
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="assets\slick-1.8.1\slick-1.8.1\slick\slick.css" />
    <link rel="stylesheet" type="text/css" href="assets\slick-1.8.1\slick-1.8.1\slick\slick-theme.css" />

    <!-- jQuery (required for Slick) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Slick JavaScript -->
    <script type="text/javascript" src="assets\slick-1.8.1\slick-1.8.1\slick\slick.min.js"></script>

    <!-- Splide CSS -->
    <link rel="stylesheet" href="assets\splide-4.1.3\splide-4.1.3\dist\css\splide-core.min.css">
    <link rel="stylesheet" href="assets\splide-4.1.3\splide-4.1.3\dist\css\splide.min.css">
    <link rel="stylesheet" href="assets\splide-4.1.3\splide-4.1.3\dist\css\themes\splide-default.min.css">
    <!-- Base URL -->
    <!-- <base href="http://localhost/TEDxManaratAlfaroukSchool/"> -->
    <base href="https://tedxmanaratalfaroukschool.com/">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-home.css">

    <style>
        .disabled-link {
            pointer-events: none;
            color: currentColor;
            cursor: not-allowed;
            opacity: 0.5;
            text-decoration: none;
        }
    </style>

    <!-- Title -->
    <title>TEDx Manarat AlFarouk School</title>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "TEDxManaratAlFaroukSchool",
            "url": "https://www.tedxmanaratalfaroukschool.com/",
            "description": "An independent TEDx event sharing inspiring ideas.",
            "logo": "https://www.tedxmanaratalfaroukschool.com/images/x-art.png",
            "sameAs": [
                "https://www.facebook.com/TEDxManaratAlFarouk/",
                "https://www.instagram.com/tedx.manaratalfaroukschool/",
                "https://www.tiktok.com/@tedxmfis",
                "https://www.linkedin.com/company/tedxmanaratalfaroukschool"
            ],
            "video": {
                "@type": "VideoObject",
                "name": "TEDxManaratAlFaroukSchool Video",
                "description": "An inspiring video showcasing TEDxManaratAlFaroukSchool's journey and ideas worth spreading.",
                "thumbnailUrl": "https://tedxmanaratalfaroukschool.com/images/videothub.jpg",
                "uploadDate": "2024-11-16T06:28:45+00:00",
                "contentUrl": "https://player.vimeo.com/video/1029355746",
                "embedUrl": "https://player.vimeo.com/video/1029355746",
                "duration": "PT1M",
                "publisher": {
                    "@type": "Organization",
                    "name": "TEDxManaratAlFaroukSchool",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "https://www.tedxmanaratalfaroukschool.com/images/TEDxMFIS.jpeg"
                    }
                }
            }
        }
    </script>

</head>

<body class="home_page">
    <!-- Loader Section -->
    <div class="loader-container">
        <svg viewBox="102 10 300 200" width="100%" height="100%">
            <text x="50%" y="50%" dy=".32em" text-anchor="middle" class="text-body-1">TEDx</text>
            <text x="50%" y="50%" dy=".32em" dx="5.5em" text-anchor="middle" class="text-body-2">ManaratAlFarouk</text>
        </svg>
    </div>
    <!-- End Loader Section -->

    <!-- Header Section -->
    <section class="header home_header" id="headerSection">
        <!-- Navigation -->
        <nav id="navbar">
            <!-- Logo -->
            <a href=""><img src="images\TEDx_logo_place2_RGB_CS2_page-0001.png" alt="TEDx Manarat AlFarouk School Logo"
                    id="tedx_logo"></a>

            <!-- Nav Links -->
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark  burger mark" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="" class="nav_text ">Home</a></li>
                    <li><a href="Speakers/" class="nav_text">Speakers</a></li>
                    <li><a href="Misc/underm.html" class="nav_text">Shop</a></li>
                    <li><a href="Sponsors/" class="nav_text">Sponsors</a></li>
                    <li><a href="About/" class="nav_text">About</a></li>
                    <li><a href="Tickets/" class="nav_text">Tickets</a></li>
                </ul>
            </div>
            <form action="">
                <button class="ticket-button"><a href="Tickets/Early_Bird_Form">Get Ticket</a></button>
            </form>
            <!-- Burger Menu -->
            <i class="fa-solid fa-bars burger" onclick="showMenu()"></i>
        </nav>
    </section>
    <!-- End Header Section -->

    <!-- Hero Text Box -->
    <div class="hero_text_box">
        <h1>
            <div class="text">
                <span class="first-part">TEDx</span>
                <span class="second-part">Manarat AlFarouk School</span>
            </div>
            <span class="text2 third-part ">Spreading ideas, inspiring<br> change.</span>
        </h1>
        <a href="Tickets/Form/" class="hero-btn">Buy Tickets</a>
    </div>
    <!-- End Hero Text Box -->

    <!-- About Us Section -->
    <section class="body_section" id="aboutus">
        <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
        <div class="abt-content">
            <!-- About Section -->
            <div class="abt-right">
                <div class="heading">
                    <h2 class="special-heading">About</h2>
                    <div class="content-under-special-heading">
                        <p class="sub-special-heading">[About Us]</p>
                        <h3 class="special-heading-title">What is Tedx?</h3>
                        <p class="description">In the spirit of ideas worth spreading, TED has created a program called
                            TEDx. TEDx is a program of local,
                            self-organized events that bring people together to share a TED-like experience. Our event
                            is called TEDxManaratAlFaroukSchool,
                            where x = independently organized TED event. At our TEDxManaratAlFaroukSchool event, TED
                            Talks video and
                            live speakers will combine to spark deep discussion and connection in a small group.
                            The TED Conference provides general guidance for the TEDx program, but individual TEDx
                            events, including ours, are self-organized.</p>
                    </div>
                </div>
                <a href="About/" class="hero-btn about_btn">Read More</a>
                <div class="spacing_size spacing_size-initial" style="height:60px;"></div>
            </div>

            <!-- Image Section -->
            <div class="abt-left">
                <img src="images/ted (3).jpg" id="abt_img" alt="What is TEDxManaratAlFaroukSchool?">
            </div>
        </div>

        <!-- Countdown Section -->
        <div class="container">
            <div class="title">
                <h3>
                    <div class="br">Count <span>Every</span></div>
                    <div class="br"><span>Second</span> Until</div>
                    <div class="br">The Event</div>
                </h3>
            </div>

            <div class="time-counter">
                <!-- Days -->
                <div class="days-part">
                    <div class="part-container">
                        <h2 class="days">58</h2>
                        <p class="part-title">[Days]</p>
                    </div>
                </div>

                <!-- Hours -->
                <div class="column">:</div>
                <div class="hours-part">
                    <div class="part-container">
                        <h2 class="hours">Er</h2>
                        <p class="part-title">[Hours]</p>
                    </div>
                </div>

                <!-- Minutes -->
                <div class="column">:</div>
                <div class="minutes-part">
                    <div class="part-container">
                        <h2 class="minutes">r</h2>
                        <p class="part-title">[Minutes]</p>
                    </div>
                </div>

                <!-- Seconds -->
                <div class="column">:</div>
                <div class="seconds-part">
                    <div class="part-container">
                        <h2 class="seconds">or</h2>
                        <p class="part-title">[Seconds]</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Spacing -->
        <div class="inner_content">
            <div class="spacing_size spacing_size-initial" style="height:75px;"></div>
        </div>
    </section>
    <!-- End About Us Section -->
    <!-- Schedule Section -->
    <!--  
    <section class="body_section" id="schedule">
        <div class="inner_content">
            <div class="spacing_size spacing_size-initial" style="height:60px;"></div>

            Special Heading Container 
            <div class="special-heading-container">
                <div class="special-heading">Schedule</div>
                <div class="sub-special-heading">[Our Timetable]</div>
                <div class="special-heading-title">At What Time?</div>
                <div class="description heading_description">Keep track of all event activities with a detailed
                    schedule,
                    outlining the timings of each session to ensure you don't miss a moment.</div>
            </div>
            <div class="spacing_size spacing_size-initial" style="height:50px;"></div>
            -->
    <!-- Schedule Container -->
    <!--  
            <div class="schedule_container slider">
                <div class="schedule_card">
                    <h4 class="schedule_card_time">9.00 am</h4>
                    <div class="schedule_card_line_circle">
                        <div class="time_line-check"><span class="time_line-check_circle" chec
                                style="background: var(--ted-color);"></span></div>
                    </div>
                    <h4 class="schedule_card_title">Regestiration</h4>
                    <div class="schedule_card_desc">Join 600 product managers, designers, founders.</div>
                </div>
                <div class="schedule_card">
                    <h4 class="schedule_card_time">9.00 am</h4>
                    <div class="schedule_card_line_circle">
                        <div class="time_line-check"><span class="time_line-check_circle" chec
                                style="background: #e6481e;"></span></div>
                    </div>
                    <h4 class="schedule_card_title">Coffee Break</h4>
                    <div class="schedule_card_desc">JBreakfast, lunch, and unlimited tea and coffee are all part.</div>
                </div>
                <div class="schedule_card">
                    <h4 class="schedule_card_time">9.00 am</h4>
                    <div class="schedule_card_line_circle">
                        <div class="time_line-check"><span class="time_line-check_circle" chec
                                style="background: #e66b1e;"></span></div>
                    </div>
                    <h4 class="schedule_card_title">Conference</h4>
                    <div class="schedule_card_desc">How startups can work effectively with corporate.</div>
                </div>
                <div class="schedule_card">
                    <h4 class="schedule_card_time">9.00 am</h4>
                    <div class="schedule_card_line_circle">
                        <div class="time_line-check"><span class="time_line-check_circle" chec
                                style="background: #e68e1e;"></span></div>
                    </div>
                    <h4 class="schedule_card_title">Workshops</h4>
                    <div class="schedule_card_desc">Building your own brand in a digital world right now!.</div>
                </div>
                <div class="schedule_card">
                    <h4 class="schedule_card_time">9.00 am</h4>
                    <div class="schedule_card_line_circle">
                        <div class="time_line-check"><span class="time_line-check_circle" chec
                                style="background: #e6b11e;"></span></div>
                    </div>
                    <h4 class="schedule_card_title">After Party</h4>
                    <div class="schedule_card_desc">When the talks end, the party starts! Stick around!.</div>
                </div>
            </div>
            -->
    <!-- <ul class="slick-dots" style="" role="tablist">
                <li class="slick-active" aria-hidden="false" role="presentation" aria-selected="true"
                    aria-controls="navigation00" id="slick-slide00"><button type="button" data-role="none" role="button"
                        aria-required="false" tabindex="0">1</button></li>
                <li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation01"
                    id="slick-slide01"><button type="button" data-role="none" role="button" aria-required="false"
                        tabindex="0">2</button></li>
            </ul> -->
    <!-- 
            <div class="spacing_size spacing_size-initial" style="height:60px;"></div>
        </div>
    </section>
     -->
    <!-- End Schedule Section -->

    <!-- Speakers Section -->
    <section class="body_section" id="speakers">
        <div class="inner_content">
            <div class="spacing_size spacing_size-initial" style="height:50px;"></div>

            <!-- Special Heading Container -->
            <div class="special-heading-container">
                <div class="special-heading">Speakers</div>
                <div class="sub-special-heading">[Our Speakers]</div>
                <div class="special-heading-title">Who's Speaking?</div>
                <div class="description heading_description">Hear 8 inspiring talks, meet the best product people in
                    Egypt, and listen to their talks.</div>
            </div>

            <div class="spacing_size spacing_size-initial" style="height:30px;"></div>

            <!-- Speakers Cards Container -->
            <div class="speakers-cards-container">

                <!-- Speaker Card Host -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/raghad-ahmed.jpg"
                            alt="raghad Ahmed TEDxManaratAlFaroukSchool speaker">

                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.instagram.com/boska_says/" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/@boskasays" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-tiktok"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Raghad Ahmed</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Host]</div>
                    </div>
                </div>


                <!-- Speaker Card 2 -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/abdullah-amer.jpg"
                            alt="abdullah Amer TEDxManaratAlFaroukSchool speaker">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.linkedin.com/in/amership9/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://www.instagram.com/amership9/" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.threads.net/@amership9" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-threads"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Abdullah Amer</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Host]</div>
                    </div>
                </div>



                <!-- Speaker Card 2 -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/diet-cheat.jpg"
                            alt="Diet and Cheat TEDxManaratAlFaroukSchool speaker">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/dietandcheat1/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/@dietandcheat" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-youtube"></i></a>
                            <a href="https://www.instagram.com/dietand.cheat/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://x.com/diet_cheat" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-twitter"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Diet & Cheat</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Health & wellness]</div>
                    </div>
                </div>
                <!-- Speaker Card 3 -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/Zaghaleel.jpg"
                            alt="Zaghaleel TEDxManaratAlFaroukSchool speaker">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/Zaghaleel1" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/@zaghaleel" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-youtube"></i></a>
                            <a href="https://www.instagram.com/zaghaleeel" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/@zaghaleeel" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-tiktok"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Zaghaleel</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Digital creator]</div>
                    </div>
                </div>
                <!-- Speaker Card 3 -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/yasmine-medhat.jpg"
                            alt="Yasmine medhat TEDxManaratAlFaroukSchool speaker">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/yasminemedhat" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/in/yasmine-medhat-423b7a149" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://www.instagram.com/yasminemedhat/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.threads.net/@yasminemedhat" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-threads"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Yasmine Medhat</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Entrepreneur]</div>
                    </div>
                </div>



                <!-- Speaker Card 4 -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/maha-gamil.jpg"
                            alt="Maha Gamil TEDxManaratAlFaroukSchool speaker">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/maha.gamillll/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.tiktok.com/@mahagamil316" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-tiktok"></i></a>
                            <a href="https://www.instagram.com/mahagamilll/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://x.com/MahaGamil9" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-twitter"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Maha Gamil</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Artist]</div>
                    </div>
                </div>
                <!-- Speaker Card 1 -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/rana.jpg"
                            alt="Rana Al Zahar TEDxManaratAlFaroukSchool speaker">

                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/RElZahar/" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/in/rana-el-zahar-56184023b" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://www.instagram.com/ranaelzahar/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/@ranaelzaharr" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-tiktok"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Rana Al Zahar</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Chemistry Doctor]</div>
                    </div>
                </div>
                <!-- Speaker Card 5 -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/shorouqii-eltananii.jpg"
                            alt="Shorouqii El Tananii TEDxManaratAlFaroukSchool speaker">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/shorouqiieltananii" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.youtube.com/@Shorouqiiillustrations" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a>
                            <a href="https://www.instagram.com/shorouqii_illustrations/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.tiktok.com/@shorouqiieltananii" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-tiktok"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Shorouqii El-Tananii</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Content creator]</div>
                    </div>
                </div>

                <!-- Speaker Cards -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/karim-nabil.jpg"
                            alt="Karim Nabil TEDxManaratAlFaroukSchool speaker">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/Eng.Kariim.Nabiil" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/in/kariim-nabiil/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://www.youtube.com/@kariimnabiil-911/featured" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Karim Nabil</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Product Manager]</div>
                    </div>
                </div>


                <!-- Speaker Cards -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/mostafa-gabr.jpg"
                            alt="Mostafa Gabr TEDxManaratAlFaroukSchool speaker">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/mustafaagabr/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/in/mostafaagabr" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://www.instagram.com/mostafa.agabr/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>

                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Mostafa Gabr</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[ProdConsult]</div>
                    </div>
                </div>



                <!-- Speaker Cards -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/hesham-abdelm.jpg"
                            alt="Hesham Abdelmaksoud TEDxManaratAlFaroukSchool">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/heshamAbdelmaksoud99/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/in/hesham-abdelmaksoud-0328a5123" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://www.instagram.com/heshamabdelm/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@heshamabdelmaksoud2/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Hesham Abdelmaksoud</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Performance]</div>
                    </div>
                </div>

                <!-- Speaker Cards -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/lamia-nageb.jpg"
                            alt="Lamia Nageb TEDxManaratAlFaroukSchool">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.facebook.com/lamianagebelyass/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/in/lamia-nageb/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://www.instagram.com/lamianagebvo/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@lamianagebvo" target="_blank" rel="noopener noreferrer"><i
                                    class="fa-brands fa-youtube"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Lamia Nageb</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Performance]</div>
                    </div>
                </div>

                <!-- Speaker Cards -->
                <div class="speaker-card">
                    <!-- Speaker Image -->
                    <div class="speaker-img">
                        <img src="images\generation/2024-event/ayah-nasr.jpg" alt="Ayah Nasr TEDxManaratAlFaroukSchool">
                    </div>

                    <!-- Speaker Information -->
                    <div class="speaker-info">
                        <!-- Social Media Links -->
                        <div class="speaker-nav">
                            <a href="https://www.instagram.com/ayaa_nasr_1/" target="_blank"
                                rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                        <!-- Speaker Name -->
                        <div class="speaker-name">Ayah Nasr</div>
                        <!-- Speaker Job -->
                        <div class="speaker-job">[Performance]</div>
                    </div>
                </div>
            </div>

            <!-- View All Speakers Button -->
            <div class="speaker_button">
                <a href="Speakers/">View All</a>
            </div>
        </div>
        <div class="spacing_size spacing_size-initial" style="height:88px;"></div>
    </section>
    <!-- End Speakers Section -->

    <!-- Video + Tickets Section -->
    <section class="body_section" id="videos">
        <div class="wave_video">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#fff" fill-opacity="1"
                    d="M0,224L80,234.7C160,245,320,267,480,240C640,213,800,139,960,138.7C1120,139,1280,213,1360,250.7L1440,288L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
                </path>
            </svg>
        </div>
        <div class="video-container">



            <div
                style="padding:56.25% 0 0 0;position:relative; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);">
                <iframe
                    src="https://player.vimeo.com/video/1030869419?title=0&amp;byline=0&amp;portrait=0&amp;badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479"
                    frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write"
                    style="position:absolute;top:0;left:0;width:100%;height:100%;" title="2024 Event"></iframe></div>
            <script src="https://player.vimeo.com/api/player.js"></script>
        </div>

    </section>
    <section class="body_section" id="tickets">
        <div class="wave-header wave_tickets">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1"
                    d="M0,224L80,224C160,224,320,224,480,202.7C640,181,800,139,960,133.3C1120,128,1280,160,1360,176L1440,192L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
                </path>
            </svg>
        </div>
        <div class="inner_content">
            <div class="tickets-container">
                <div class="tickets-cards-container">
                    <!-- Ticket Card 1 -->
                    <div class="ticket-card <?php 
            if ($ticket_status1 === 'sold_out'|| $ticket_status1 === 'coming_soon') {
                echo 'disabled-link';
            }
        ?>">
                        <div class="pricing-container">
                            <div class="punch"></div>

                            <!-- ELMAHYY MARKETINGG :D  -->

                            <?php if ($discount > 0): ?>
                            <div class="ticket-price">
                                <span class="ticket-price"
                                    style="text-decoration: line-through; font-size: 33px; opacity: 85%;"><?= htmlspecialchars($ticket_price) ?>
                                    EGP</span>
                                <br>
                                <span class="ticket-price" style="color: white;"><?= htmlspecialchars($final_price) ?>
                                    EGP</span>
                            </div>
                            <?php else: ?>
                            <div class="ticket-price tp-gap">
                                <span class="ticket-price " style="color: white;"><?= htmlspecialchars($ticket_price) ?>
                                    EGP</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="ticket-description">
                            <div class="ticket-type">
                                <h4
                                    style="padding:13px 21px; border:1px solid var(--ted-color); border-radius:25px; position:relative; top:-50%; background-color:#fff; z-index:3;">
                                    <i class="fa-solid fa-check" style="margin-right:5px; color:green;"></i>Early Bird
                                </h4>
                            </div>
                            <ul>
                                <li>Breakfast, lunch, and snack break</li>
                                <li>Access to all student activities</li>
                                <li>Online ticket sent by email</li>
                                <li>Secure online payment</li>
                                <li>8 inspiring speakers</li>
                            </ul>
                        </div>
                        <div class="ticket-button">
                            <a id="actionLink" href="Tickets/Early_Bird_Form/" class="
        <?php 
            if ($ticket_status1 === 'sold_out'|| $ticket_status1 === 'coming_soon') {
                echo 'disabled-link';
            }
        ?>">
                                <?php 
            if ($ticket_status1 === 'sold_out') {
                echo 'Sold Out';
            } elseif ($ticket_status1 === 'coming_soon') {
                echo 'Coming Soon';
            } else {
                echo 'Get Ticket';
            } 
        ?>
                            </a>
                        </div>

                    </div>
                    <!-- Ticket Card 2 -->
                    <div class="ticket_card_down">
                        <div class="spacing_size spacing_size-initial" style="height:70px;"></div>
                        <div class="ticket-card <?php 
            if ($ticket_status2 === 'sold_out'|| $ticket_status2 === 'coming_soon') {
                echo 'disabled-link';
            }
        ?>">
                            <div class="pricing-container">
                                <div class="punch"></div>

                                <!-- ELMAHYY MARKETINGG :D  -->

                                <?php if ($discount_group > 0): ?>
                                <div class="ticket-price">
                                    <span class="ticket-price"
                                        style="text-decoration: line-through; font-size: 33px; opacity: 85%;"><?= htmlspecialchars($ticket_price_group) ?>
                                        EGP</span>
                                    <br>
                                    <span class="ticket-price"
                                        style="color: white;"><?= htmlspecialchars($final_price_group) ?> EGP</span>
                                </div>
                                <?php else: ?>
                                <div class="ticket-price tp-gap">
                                    <span class="ticket-price "
                                        style="color: white;"><?= htmlspecialchars($ticket_price_group) ?> EGP</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="ticket-description">
                                <div class="ticket-type">
                                    <h4
                                        style="padding:13px 21px; border:1px solid var(--ted-color); border-radius:25px; position:relative; top:-50%; background-color:#fff; z-index:3;">
                                        <i class="fa-solid fa-check" style="margin-right:5px; color:green;"></i>Late Owl
                                    </h4>
                                </div>
                                <ul>
                                    <li>Breakfast, lunch, and snack break</li>
                                    <li>Access to all student activities</li>
                                    <li>Online ticket sent by email</li>
                                    <li>Secure online payment</li>
                                    <li>8 inspiring speakers</li>
                                </ul>
                            </div>
                            <div class="ticket-button">
                                <a id="actionLink" href="Tickets/Late_Owl_Form/" class="
        <?php 
            if ($ticket_status2 === 'sold_out'|| $ticket_status2 === 'coming_soon') {
                echo 'disabled-link';
            }
        ?>">
                                    <?php 
            if ($ticket_status2 === 'sold_out') {
                echo 'Sold Out';
            } elseif ($ticket_status2 === 'coming_soon') {
                echo 'Coming Soon';
            } else {
                echo 'Get Ticket';
            } 
        ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tickets-text-container">
                    <!-- Ticket Heading -->
                    <div class="heading">
                        <h2 class="special-heading">Tickets</h2>
                        <div class="content-under-special-heading">
                            <p class="sub-special-heading">[Get Your Ticket]</p>
                            <h3 class="special-heading-title">How Much?</h3>
                            <p class="description ticket_heading_description">We're excited to offer an enriching
                                experience at TEDxManaratAlfaroukSchool. Here’s what you’ll get with your ticket:</p>
                            <ul>
                                <li class="description">Access to all workshops, talks, and student activities.</li>
                                <li class="description">A full day of meals including breakfast, lunch, and a snack
                                    break.</li>
                                <li class="description">Online ticket delivery directly to your email.</li>
                                <li class="description">Secure online payment option.</li>
                                <li class="description">Hear from 8 amazing speakers sharing unique insights.</li>
                                <li class="description">Enjoy additional fun activities and networking opportunities.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Start Testimonials Section -->
    <section class="splide" aria-label="Splide Basic HTML Example" id="testimonials">
        <div class="inner_content  body_section">
            <div class="spacing_size spacing_size-initial" style="height:50px;"></div>
            <!-- Special Heading Container -->
            <div class="special-heading-container">
                <div class="special-heading">They Say</div>
                <div class="sub-special-heading">[Testimonials]</div>
                <div class="special-heading-title">Feedbacks</div>
            </div>
        </div>
        <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
        <div class="testimonials_container splide__track">
            <div class="testimonials_container splide__list">
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">It was really interesting and everyone in the team made a very good job</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">halamohammedshamel</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">It was amazing and the speakers were incredible and the team work was perfect</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">farida__zz</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">You need to do another oneee</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">layal6095</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">The best event I've ever entered bgd 💖</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">ritallossama</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">It was soo good 💗 and thank you for this best event 😘</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">jowairiahhany</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">I loved the speakers so much and I really learned a lot from them</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">gelsy.ibrahim</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">The event was AMAZING</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">l.haneenn</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">Youm touhfa bgd ktr 5rkom bgd 4okran 3la elmghod w el48l dh 💗💗💗</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">rokaia_hussein1</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">The best event in the world really this is the 3rd time and it was the best 💗</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">janaabdelkader48</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">Perfect bgd elspeakres kolhom kano inspiring awy sponsors were amazing w elteam was so friendly</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">_haneenhesham__</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">AMAZING</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">malak_wael_hosny</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">Amazing loved it had so much fun too ❤❤</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">ghena.samehh</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">it was amazing no complaints</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">yasmineayman47</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">100/10</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">omarmohamed_nagy</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">Outstanding</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async"
                                src="images\default-pic.jpg"
                                alt="Ay Had" style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">_.yarakamal._</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="spacing_size spacing_size-initial" style="height:110px;"></div>
    </section>
    <!-- End Testimonials Section -->
    <footer>
        <div class="inner_content">
            <div class="footer-container">
                <div class="fc-col1">
                    <img src="images\TEDx_logo_place2_RGB_CS2_page-0001.png" alt="TEDxManaratAlFarouk logo"
                        class="brand">
                </div>
                <div class="fc-col2">
                    <div class="footer-text">
                        This independent TEDx event is operated under license from TED.
                    </div>
                    <!-- <ul class="fc-menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Speakers</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">Sponsors</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Tickets</a></li>
                    </ul> -->
                </div>
                <div class="fc-col3">
                    <ul class="fc-media-icons">
                        <li class="facebook-icon"><a href="https://www.facebook.com/TEDxManaratAlFarouk/"
                                target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li class="instagram-icon"><a href="https://www.instagram.com/tedx.manaratalfaroukschool/"
                                target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li class="linkedin-icon"><a href="https://eg.linkedin.com/company/tedxmanaratalfaroukschool"
                                target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                        <li class="tiktok-icon"><a href="https://www.tiktok.com/@tedxmfis" target="_blank"><i
                                    class="fa-brands fa-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Video + Tickets Section -->

    <!-- Cursor -->
    <!-- <div class="cursor"></div>
    <div class="cursor2"></div> -->

    <!-- JavaScript -->
    <script>
        document.getElementById('actionLink').addEventListener('click', function (event) {
            <?php if ($checkbox_status): ?>
                event.preventDefault(); // Prevent action if link is disabled
            <?php endif; ?>
        });
    </script>
    <!-- <script src="/script.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('.schedule_container').slick({
                infinite: false,
                slidesToShow: 5,
                slidesToScroll: 3,
                autoplay: false,
                dots: true,
                // autoplaySpeed: 2000,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            infinite: false,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 799,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 479,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            dots: true
                        }
                    }
                ]
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var splide = new Splide('.splide', {
                type: 'loop',
                perPage: 4,
                perMove: 1,
                direction:'ltr',
                pagination: true,
                paginationDirection: 'ltr',
                drag: true,
                snap: true,
                arrows: false,
                autoplay: true,
                pauseOnHover: true,
                pauseOnFocus:  true,
                breakpoints: {
                    1200: {
                        perPage: 3,
                    },
                    850: {
                        perPage: 2,
                    },
                    600: {
                        perPage: 1,
                    },
                },
            });
            splide.mount();
        });
    </script>
    <script src="assets\splide-4.1.3\splide-4.1.3\dist\js\splide.min.js"></script>
    <script src="script-home.js"></script>
    <script src="script.js"></script>
</body>

</html>
<?php
include("../Misc/db_conn.php");

// Function to fetch ticket status
function getTicketStatus($con, $ticket_id) {
    $query = "SELECT ticket_status FROM settings WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $status = $result->fetch_assoc()['ticket_status'] ?? null;
    $stmt->close();
    return $status;
}

// fetch basic ticket details from db
function getBasicTicketDetails($con) {
    $query = "SELECT ticket_price, ticket_discount FROM settings WHERE id = 1 LIMIT 1";
    $result = $con->query($query);
    return $result ? $result->fetch_assoc() : null;
}

// fetch late ticket details from db
function getLateTicketDetails($con) {
    $query = "SELECT ticket_price, ticket_discount FROM settings WHERE id = 2 LIMIT 1";
    $result = $con->query($query);
    return $result ? $result->fetch_assoc() : null;
}

$ticket_id1 = 1;
$ticket_id2 = 2;

$ticket_status1 = getTicketStatus($con, $ticket_id1);
$ticket_status2 = getTicketStatus($con, $ticket_id2);

$basicTicket = getBasicTicketDetails($con);
$basic_ticket_price = $basicTicket['ticket_price'];
$basic_discount = $basicTicket['ticket_discount'];
$final_price = $basic_ticket_price - $basic_discount;

$lateTicket = getLateTicketDetails($con);
$late_ticket_price = $lateTicket['ticket_price'];
$late_discount = $lateTicket['ticket_discount'];
$final_price_late = $late_ticket_price - $late_discount;

$con->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>


<!--GOOGLE -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-JXGKTBFNV3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-JXGKTBFNV3');
</script>

    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Get your tickets for TEDxManaratAlFaroukSchool and be part of an event filled with innovative ideas, inspiring talks, and engaging experiences.">
    <meta name="keywords"
        content="TEDxManaratAlFaroukSchool tickets, buy TEDx tickets, TEDx event, TEDx ticket sales, TEDx participation, attend TEDx, TEDx event tickets">
    <meta name="robots" content="index, follow">
    <meta name="referrer" content="no-referrer">
    <meta name="author" content="TEDxManaratAlFaroukSchool">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets\fontawesome-free-6.6.0-web\fontawesome-free-6.6.0-web\css\all.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/x-art.png" type="image/x-icon">

    <!-- Base URL -->
    <base href="https://tedxmanaratalfaroukschool.com">

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

    <!-- <link rel="stylesheet" href="user/css/style-hero.css"> -->

    <!-- Title -->
    <title>TEDx Manarat AlFarouk School</title>
</head>

<body class="butTicket_page">
    <div class="loader-container">
        <svg viewBox="102 10 300 200" width="100%" height="100%">
            <text x="50%" y="50%" dy=".32em" text-anchor="middle" class="text-body-1">TEDx</text>
            <text x="50%" y="50%" dy=".32em" dx="5.5em" text-anchor="middle" class="text-body-2">ManaratAlFarouk</text>
        </svg>
    </div>
    <!-- Header Start -->
    <section class="header" id="headerSection">
        <!-- Navigation -->
        <nav class="banners_navbar" id="navbar">
            <!-- Logo -->
            <a href=""><img src="images\TEDx_logo_place2_RGB_CS2_page-0003.png" alt="tedx logo" id="tedx_logo"></a>

            <!-- Nav Links -->
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark  burger mark" onclick="hideMenu()" style="color:#333;"></i>
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
    <!-- Header End -->

    <!-- Banner Start -->
    <div class="body_section tickers_banner" id="banner">
        <div class="inner_content">
            <div>
                <h1 class="text">TICKETS</h1>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <section class="body_section" id="buy-tickets-page_tickets_section">
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

                            <?php if ($basic_discount > 0): ?>
                            <div class="ticket-price">
                                <span class="ticket-price"
                                    style="text-decoration: line-through; font-size: 33px; opacity: 85%;"><?= htmlspecialchars($basic_ticket_price) ?>
                                    EGP</span>
                                <br>
                                <span class="ticket-price" style="color: white;"><?= htmlspecialchars($final_price) ?>
                                    EGP</span>
                            </div>
                            <?php else: ?>
                            <div class="ticket-price tp-gap">
                                <span class="ticket-price " style="color: white;"><?= htmlspecialchars($final_price) ?>
                                    EGP</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- END ELMAHYY MARKETINGG D:  -->

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
                            <a id="actionLink" href="Tickets/Form/" class="
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

                                <?php if ($late_discount > 0): ?>
                                <div class="ticket-price">
                                    <span class="ticket-price"
                                        style="text-decoration: line-through; font-size: 33px; opacity: 85%;"><?= htmlspecialchars($late_ticket_price) ?>
                                        EGP</span>
                                    <br>
                                    <span class="ticket-price"
                                        style="color: white;"><?= htmlspecialchars($final_price_late) ?> EGP</span>
                                </div>
                                <?php else: ?>
                                <div class="ticket-price tp-gap">
                                    <span class="ticket-price "
                                        style="color: white;"><?= htmlspecialchars($final_price_late) ?> EGP</span>
                                </div>
                                <?php endif; ?>
                            </div>

                            <!-- END ELMAHYY MARKETINGG D:  -->
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
                                <!-- LINK CHANGE --> 
                                <a id="actionLink" href="Tickets/Form/" class="
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
                                <li class="tiktok-icon"><a href="https://www.tiktok.com/@tedxmfis"
                                target="_blank"><i class="fa-brands fa-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- <div class="cursor"></div>
    <div class="cursor2"></div> -->
    <!-- JS Files -->
    <script src="script-home.js"></script>
    <script src="script.js"></script>

    <script>
        document.getElementById('actionLink').addEventListener('click', function (event) {
            <?php if ($checkbox_status): ?>
                event.preventDefault(); // Prevent action if link is disabled
            <?php endif; ?>
        });
    </script>

</body>

</html>
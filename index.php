<?php
require("Misc/db_conn.php");
require("Misc/security_middleware.php");

// Initialize security middleware
initSecurityMiddleware();


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

    <meta property="og:image" content="https://www.tedxmanaratalfaroukschool.com/images/TEDxMFIS.webp">
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
    <meta name="twitter:image" content="https://www.tedxmanaratalfaroukschool.com/images/TEDxMFIS.webp">



    <!-- Font Awesome -->
    <link rel="preload" href="assets/fontawesome-free-6.6.0-web/fontawesome-free-6.6.0-web/css/all.min.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">

    <!-- Favicon -->
    <link rel="icon" href="images/x-art.webp" type="image/x-icon">
    <link rel="shortcut icon" href="images/x-art.webp" type="image/x-icon">

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
    <!-- <base href="http://localhost:8000/"> -->
    <!-- <base href="https://tedxmanaratalfaroukschool.com/"> -->
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">

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
        "logo": "https://www.tedxmanaratalfaroukschool.com/images/x-art.webp",
        "sameAs": [
            "https://www.facebook.com/TEDxManaratAlFarouk/",
            "https://www.instagram.com/tedx.manaratalfaroukschool/",
            "https://www.tiktok.com/@tedxmfis",
            "https://www.linkedin.com/company/tedxmanaratalfaroukschool"
        ]
    }
    </script>

</head>

<body class="home_page">
    <!-- <div class="cursor"></div> -->

    <!-- Main Navigation -->
    <nav class="main-nav" id="mainNav">
        <div class="nav-container">
            <a href="#home" class="nav-logo">
                <img src="images\tedx-logo-white.webp" alt="">
            </a>

            <ul class="nav-links">
                <li><a href="#home" class="nav-link" data-section="home">Home</a></li>
                <li><a href="About\index.html" class="nav-link">About</a></li>
                <li><a href="Speakers\index.php" class="nav-link">Speakers</a></li>
                <li><a href="Sponsors\index.php" class="nav-link">Sponsors</a></li>
                <li><a href="#tickets" class="nav-cta"><span>Get Tickets</span></a></li>
            </ul>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <ul class="mobile-menu-links">
            <li><a href="#home" class="mobile-menu-link">Home</a></li>
            <li><a href="About\index.html" class="mobile-menu-link">About</a></li>
            <li><a href="Speakers\index.php" class="mobile-menu-link">Speakers</a></li>
            <li><a href="Sponsors\index.php" class="mobile-menu-link">Sponsors</a></li>
        </ul>
        <a href="#tickets" class="mobile-menu-cta">Get Your Ticket</a>
    </div>


    <section class="hero" id="home">
        <!-- Animated Grid Background -->
        <div class="grid-bg"></div>

        <!-- Energy Particles -->
        <div class="particles">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <!-- 3D Open Box -->
        <div class="box-scene">
            <!-- Light Rays -->
            <div class="light-rays"></div>

            <!-- Open Box Structure -->
            <div class="open-box">
                <!-- Box Walls (vertical sides) -->
                <div class="box-face box-wall-front"></div>
                <div class="box-face box-wall-back"></div>
                <div class="box-face box-wall-left"></div>
                <div class="box-face box-wall-right"></div>

                <!-- Open Flaps (folded outward from top of each wall) -->
                <div class="box-flap flap-front"></div>
                <div class="box-flap flap-back"></div>
                <div class="box-flap flap-left"></div>
                <div class="box-flap flap-right"></div>
            </div>

            <!-- Red Stars Escaping -->
            <div class="escaping-ideas">
                <div class="idea-particle">★</div>
                <div class="idea-particle">★</div>
                <div class="idea-particle">★</div>
                <div class="idea-particle">★</div>
                <div class="idea-particle">★</div>
                <div class="idea-particle">★</div>
                <div class="idea-particle">★</div>
                <div class="idea-particle">★</div>
            </div>
        </div>

        <!-- Hero Content -->
        <div class="hero-content">
            <div class="pre-title">TEDxManaratAlFaroukSchool 2025</div>

            <h1 class="main-title">
                <span class="title-word word-out">OUT</span>
                <span class="title-word word-of">OF</span>
                <span class="title-word word-the">THE</span>
                <span class="title-word word-box">BOX</span>
            </h1>

            <p class="subtitle">
                Where <span class="subtitle-highlight">bold ideas</span> break free and
                <span class="subtitle-highlight">innovation</span> knows no boundaries.
            </p>

            <div class="cta-container">
                <a href="#tickets" class="cta-btn cta-primary">
                    <span>Get Your Ticket</span>
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <svg viewBox="0 0 30 50">
                <rect x="5" y="5" rx="10" ry="10" width="20" height="40" />
                <circle cx="15" cy="15" r="3">
                    <animate attributeName="cy" from="15" to="30" dur="1.5s" repeatCount="indefinite" />
                    <animate attributeName="opacity" from="1" to="0" dur="1.5s" repeatCount="indefinite" />
                </circle>
            </svg>
        </div>
    </section>

    <section class="about-section" id="about">
        <!-- Section Header -->
        <div class="section-header">
            <div class="section-tag">Who We Are</div>
            <h1 class="section-title">About TEDx</h1>
            <p class="section-subtitle">
                Independently organized, globally inspired. We're part of a movement spreading ideas worth sharing.
            </p>
        </div>

        <!-- TEDx Mission -->
        <div class="mission-container">
            <div class="mission-split">
                <div class="mission-content">
                    <div class="mission-label">Our Mission</div>
                    <h2 class="mission-title">Ideas Worth Spreading</h2>
                    <p class="mission-text">
                        In the spirit of ideas worth spreading, TED created TEDx - a program of local, self-organized
                        events that bring people together to share a TED-like experience.
                    </p>
                    <p class="mission-text">
                        TEDxManaratAlFaroukSchool operates under license from TED, combining TED Talk videos and live
                        speakers to spark deep discussion and connection in our community.
                    </p>
                    <div class="mission-highlight">
                        <p><strong>This year's theme: "Out of the Box"</strong> challenges us to think beyond
                            conventional boundaries, embrace unconventional solutions, and reimagine what's possible.
                        </p>
                    </div>
                </div>

                <div class="mission-visual">
                    <div class="breaking-box">
                        <div class="box-piece box-piece-1"></div>
                        <div class="box-piece box-piece-2"></div>
                        <div class="box-piece box-piece-3"></div>
                        <div class="box-piece box-piece-4"></div>
                        <div class="box-center">💡</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-container">
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number" data-target="90+">0</span>
                    <span class="stat-label">Speakers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="4000+">0</span>
                    <span class="stat-label">Attendees</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="7">0</span>
                    <span class="stat-label">Generations</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="49">0</span>
                    <span class="stat-label">Sponser</span>
                </div>
            </div>
        </div>

        <!-- What Makes Us Different -->
        <!-- <div class="different-container">
            <div class="different-header">
                <h2>What Makes Us Different</h2>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <span class="feature-icon">🎭</span>
                    <h3>Diverse Perspectives</h3>
                    <p>Speakers from various backgrounds, industries, and disciplines converge to share unique
                        viewpoints that challenge mainstream thinking.</p>
                </div>

                <div class="feature-card">
                    <span class="feature-icon">⚡</span>
                    <h3>High-Impact Format</h3>
                    <p>Short, powerful presentations designed to deliver maximum impact in minimum time. Every word
                        counts, every second matters.</p>
                </div>

                <div class="feature-card">
                    <span class="feature-icon">🌍</span>
                    <h3>Global-Local Fusion</h3>
                    <p>We blend TED's global standards with local innovation, creating an experience that's both
                        internationally relevant and culturally authentic.</p>
                </div>

                <div class="feature-card">
                    <span class="feature-icon">🤝</span>
                    <h3>Community Building</h3>
                    <p>More than an event - we're cultivating a community of forward-thinkers, innovators, and
                        change-makers in Cairo.</p>
                </div>

                <div class="feature-card">
                    <span class="feature-icon">🎯</span>
                    <h3>Action-Oriented</h3>
                    <p>Ideas that inspire action. We don't just talk about change - we equip you with insights to make
                        it happen.</p>
                </div>

                <div class="feature-card">
                    <span class="feature-icon">✨</span>
                    <h3>Unforgettable Experience</h3>
                    <p>Meticulously crafted moments, from stage design to audience engagement, creating memories that
                        spark lasting transformation.</p>
                </div>
            </div>
        </div> -->

        <!-- Final CTA -->
        <div class="about-cta">
            <h2>Ready to Break Out?</h2>
            <p>Join us for an experience that will challenge your thinking, expand your horizons, and connect you with a
                community of innovators.</p>
            <a href="#tickets" class="cta-button">
                <span>Secure Your Spot →</span>
            </a>
        </div>
    </section>
    <section class="speakers-section" id="speakers">
        <!-- Animated Background -->
        <div class="speakers-bg"></div>

        <!-- Spotlight Effect -->
        <div class="spotlight" id="spotlight"></div>

        <!-- Section Header -->
        <div class="section-header">
            <div class="section-tag">Meet The Minds</div>
            <h1 class="section-title">Our Speakers</h1>
            <p class="section-subtitle">
                Visionaries, innovators, and rule-breakers who dared to think differently and transformed their fields
            </p>
        </div>

        <!-- Speakers Grid -->
        <div class="speakers-container">
            <div class="speakers-grid">
                <!-- Regular Speakers -->
                <div class="speaker-card tba">
                    <div class="speaker-image-container">
                        <img src="images\mistryspeaker.webp" alt="mystery speaker" class="speaker-image">
                    </div>
                    <div class="speaker-info">
                        <h3 class="speaker-name">Mystery Speaker</h3>
                        <p class="speaker-title">To Be Announced</p>
                        <p class="speaker-bio">
                            We're finalizing our lineup with more incredible minds who've shattered conventions in their
                            fields. Stay tuned for the reveal!
                        </p>
                        <div class="speaker-topic">
                            <strong>Coming Soon:</strong> A talk that will blow your mind 🤯
                        </div>
                    </div>
                </div>
                <div class="speaker-card tba">
                    <div class="speaker-image-container">
                        <img src="images\mistryspeaker.webp" alt="mystery speaker" class="speaker-image">
                    </div>
                    <div class="speaker-info">
                        <h3 class="speaker-name">Mystery Speaker</h3>
                        <p class="speaker-title">To Be Announced</p>
                        <p class="speaker-bio">
                            We're finalizing our lineup with more incredible minds who've shattered conventions in their
                            fields. Stay tuned for the reveal!
                        </p>
                        <div class="speaker-topic">
                            <strong>Coming Soon:</strong> A talk that will blow your mind 🤯
                        </div>
                    </div>
                </div>
                <!-- Speaker Card -->
                <!-- <div class="speaker-card">
                    <div class="speaker-image-container">
                        <img src="images\speakers_page\abouzaid.webp" alt="Fatima Al-Sayed" class="speaker-image">
                        <div class="expertise-tags">
                            <span class="expertise-tag">Sustainability</span>
                            <span class="expertise-tag">Climate</span>
                        </div>
                    </div>
                    <div class="speaker-info">
                        <h3 class="speaker-name">Fatima Al-Sayed</h3>
                        <p class="speaker-title">Environmental Scientist & Climate Innovator</p>
                        <p class="speaker-bio">
                            Developed groundbreaking sustainable solutions for water scarcity in arid regions. Her work
                            challenges conventional environmental approaches.
                        </p>
                        <div class="speaker-topic">
                            <strong>Talk:</strong> "Desert Innovation: Solving Tomorrow's Problems Today"
                        </div>
                        <div class="speaker-social">
                            <a href="#" class="social-link">in</a>
                            <a href="#" class="social-link">𝕏</a>
                            <a href="#" class="social-link">🌐</a>
                        </div>
                    </div>
                </div> -->


                <!-- TBA Card -->
                <div class="speaker-card tba">
                    <div class="speaker-image-container">
                        <img src="images\mistryspeaker.webp" alt="mystery speaker" class="speaker-image">
                    </div>
                    <div class="speaker-info">
                        <h3 class="speaker-name">Mystery Speaker</h3>
                        <p class="speaker-title">To Be Announced</p>
                        <p class="speaker-bio">
                            We're finalizing our lineup with more incredible minds who've shattered conventions in their
                            fields. Stay tuned for the reveal!
                        </p>
                        <div class="speaker-topic">
                            <strong>Coming Soon:</strong> A talk that will blow your mind 🤯
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="speakers-cta">
            <h3>Don't Miss These Extraordinary Minds</h3>
            <p>Limited seats available. Secure your spot to experience ideas that will reshape your thinking.</p>
            <a href="#tickets" class="cta-button">
                <span>Reserve Your Seat Now →</span>
            </a>
        </div>
    </section>

    <section class="tickets-section" id="tickets">
        <!-- Background -->
        <div class="tickets-bg"></div>

        <!-- Section Header -->
        <div class="section-header">
            <div class="section-tag">Limited Time Offer</div>
            <h1 class="section-title">Secure Your Spot</h1>
            <p class="section-subtitle">
                Get your ticket now before prices increase. Early birds save more!
            </p>
        </div>

        <!-- Section Content -->
        <div class="section-content">
            <div class="container1">
                <!-- Phase Indicator -->
                <div class="phase-indicator">
                    <div class="phase-content">
                        <div class="phase-header">
                            <div class="phase-icon">🐦</div>
                            <h2 class="phase-title" id="phaseTitle">Early Bird Phase Active</h2>
                            <p class="phase-message" id="phaseMessage">Lock in the lowest price before it's gone forever
                            </p>
                        </div>

                        <div class="phase-countdown">
                            <div class="countdown-item">
                                <span class="countdown-number" id="days">00</span>
                                <span class="countdown-label">Days</span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="hours">00</span>
                                <span class="countdown-label">Hours</span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="minutes">00</span>
                                <span class="countdown-label">Minutes</span>
                            </div>
                            <div class="countdown-item">
                                <span class="countdown-number" id="seconds">00</span>
                                <span class="countdown-label">Seconds</span>
                            </div>
                        </div>

                        <div class="price-comparison">
                            <div class="price-box current">
                                <div class="price-label-small">Current Price</div>
                                <div class="price-value" id="currentPrice"><span>EGP</span> <?php echo $final_price ?></div>
                            </div>
                            <div class="price-arrow">→</div>
                            <div class="price-box next">
                                <div class="price-label-small">After Deadline</div>
                                <div class="price-value" id="nextPrice">EGP <?php echo $final_price_group ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- FAQ -->
                <div class="faq-section">
                    <h2 class="faq-title">Common Questions</h2>
                    <div class="faq-grid">
                        <div class="faq-item" onclick="toggleFAQ(this)">
                            <div class="faq-question-wrapper">
                                <div class="faq-question">When is the Early Bird deadline?</div>
                                <div class="faq-toggle"></div>
                            </div>
                            <div class="faq-answer-wrapper">
                                <p class="faq-answer">
                                    Early Bird tickets are available until December 3rd, 2025, or until they sell out
                                    (whichever comes first). After that, Late Owl tickets will be available at a higher
                                    price.
                                </p>
                            </div>
                        </div>

                        <div class="faq-item" onclick="toggleFAQ(this)">
                            <div class="faq-question-wrapper">
                                <div class="faq-question">What's the difference between Early Bird and Late Owl?</div>
                                <div class="faq-toggle"></div>
                            </div>
                            <div class="faq-answer-wrapper">
                                <p class="faq-answer">
                                    Both tickets include exactly the same benefits and access. The only difference is
                                    the price - Early Bird tickets are <?php echo $final_price ?>EGP while Late Owl tickets are <?php echo $final_price_group ?>EGP. Same
                                    experience, different timing!
                                </p>
                            </div>
                        </div>

                        <div class="faq-item" onclick="toggleFAQ(this)">
                            <div class="faq-question-wrapper">
                                <div class="faq-question">Can I get a refund if I can't attend?</div>
                                <div class="faq-toggle"></div>
                            </div>
                            <div class="faq-answer-wrapper">
                                <p class="faq-answer">
                                    No! tickets are non-refundable.
                                </p>
                            </div>
                        </div>

                        <div class="faq-item" onclick="toggleFAQ(this)">
                            <div class="faq-question-wrapper">
                                <div class="faq-question">Is there a group discount available?</div>
                                <div class="faq-toggle"></div>
                            </div>
                            <div class="faq-answer-wrapper">
                                <p class="faq-answer">
                                    Unfortunately group tickets are not available this year.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Ticket Card -->
            <div class="ticket-container">
                <div class="ticket-card">

                    <div class="ticket-header">
                        <h3 class="ticket-name" id="ticketName">Early Bird Ticket</h3>
                        <p class="ticket-description">
                            Full access to TEDxManaratAlFaroukSchool 2025 - Out of the Box
                        </p>
                    </div>

                    <div class="ticket-price">
                        <div class="price-amount">
                            <span class="price-currency">EGP</span><span id="ticketPrice"><?php echo $final_price ?></span>
                        </div>
                        <p class="price-label">Per Person</p>
                        <span class="price-savings" id="savings">Save <?php echo $discount ?> EGP from regular price!</span>
                    </div>
                    <!-- 
                    <div class="spots-alert">
                        <span class="spots-icon">⚠️</span>
                        <div>
                            <p class="spots-text">
                                Only <span class="spots-number" id="spotsRemaining">87</span> Early Bird tickets left!
                            </p>
                            <div class="spots-bar">
                                <div class="spots-fill" id="spotsFill"></div>
                            </div>
                        </div>
                    </div> -->

                    <div class="ticket-includes">
                        <h4 class="includes-title">What's Included</h4>
                        <div class="includes-grid">
                            <div class="include-item">

                                <div class="include-text">
                                    <strong> <span class="include-icon">🎤</span> All Speaker Sessions</strong>
                                    Access to 7+ incredible talks from world-class speakers
                                </div>
                            </div>
                            <div class="include-item">

                                <div class="include-text">
                                    <strong><span class="include-icon">🤝</span> Sponsers Area</strong>
                                    Access to all student activities, sponsers and games
                                </div>
                            </div>
                            <div class="include-item">

                                <div class="include-text">
                                    <strong><span class="include-icon">🔒</span>Secure Payment</strong>
                                    Your transaction is encrypted and 100% secure
                                </div>
                            </div>
                            <div class="include-item">

                                <div class="include-text">
                                    <strong><span class="include-icon">📧</span> Instant Confirmation</strong>
                                    Receive your ticket immediately via email
                                </div>
                            </div>
                            <div class="include-item">

                                <div class="include-text">
                                    <strong> <span class="include-icon">🍽️</span> Refreshments</strong>
                                    Breakfast, lunch, and snack break
                                </div>
                            </div>
                            <div class="include-item">

                                <div class="include-text">
                                    <strong> <span class="include-icon">📸</span> Event Photos</strong>
                                    Professional photography and access to event gallery
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="ticket-cta"
                        href="Tickets\Early_Bird_Form\index.php" id="ticket-link">
                        <span id="ticketCtaText">
                            Reserve My Early Bird Ticket Now
                            <span class="cta-subtext">🔒 Secure checkout • Instant confirmation</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>



    </section>
    <!-- Start Testimonials Section -->
    <section class="splide testimonial-section" aria-label="Splide Basic HTML Example" id="testimonials">
        <!-- Special Heading Container -->
        <div class="section-header">
            <div class="section-tag">They Say</div>
            <h1 class="section-title">Testimonials</h1>
            <p class="section-subtitle">
                Our attendees feedback
            </p>
        </div>
        <div class="testimonials_container splide__track">
            <div class="testimonials_container splide__list">
                <div class="testimonial_item splide__slide">
                    <div class="testimonial_content">
                        <div class="testimonial_titles">
                            <div class="testimonial_date">9 December, 2024</div>
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">It was really interesting and everyone in the team made a very good
                            job</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">It was amazing and the speakers were incredible and the team work
                            was perfect</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">You need to do another oneee</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">The best event I've ever entered bgd 💖</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">It was soo good 💗 and thank you for this best event 😘</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">I loved the speakers so much and I really learned a lot from them
                        </p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">The event was AMAZING</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">Youm touhfa bgd ktr 5rkom bgd 4okran 3la elmghod w el48l dh 💗💗💗
                        </p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event" id="behind-title">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">The best event in the world really this is the 3rd time and it was
                            the best 💗</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">Perfect bgd elspeakres kolhom kano inspiring awy sponsors were
                            amazing w elteam was so friendly</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">AMAZING</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">Amazing loved it had so much fun too ❤❤</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">it was amazing no complaints</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">100/10</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
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
                            <div class="testimonial_event behind_event">ما وراء الكواليس</div>
                        </div>
                        <p class="testimonial_text">Outstanding</p>
                    </div>
                    <div class="testimonial_meta">
                        <div class="testimonial_image">
                            <img decoding="async" src="images\default-pic.webp" alt="Ay Had"
                                style="width:50px; height:50px; ">
                        </div>
                        <div class="testimonial_meta_names">
                            <h3 class="testimonial_name">_.yarakamal._</h3>
                            <span class="testimonial_status">[Attendee]</span>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
    <!-- End Testimonials Section -->
    <footer>
        <div class="inner_content">
            <div class="footer-container">
                <div class="fc-col1">
                    <img src="images\tedx-logo-white.webp" alt="TEDxManaratAlFarouk logo" class="brand">
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
                    <!-- <ul class="fc-media-icons">
                        <li class="facebook-icon"><a href="https://www.facebook.com/TEDxManaratAlFarouk/"
                                target="_blank"></a></li>
                        <li class="instagram-icon"><a href="https://www.instagram.com/tedx.manaratalfaroukschool/"
                                target="_blank"></a></li>
                        <li class="linkedin-icon"><a href="https://eg.linkedin.com/company/tedxmanaratalfaroukschool"
                                target="_blank"></a></li>
                        <li class="tiktok-icon"><a href="https://www.tiktok.com/@tedxmfis" target="_blank"><i
                                    class="fa-brands fa-tiktok"></i></a></li>
                    </ul> -->
                    <ul class="speaker-social" style="opacity: 1; margin-top: 0px; transform: translateY(0px);">
                        <a href="https://www.facebook.com/TEDxManaratAlFarouk/" class="social-link"><i
                                class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/tedx.manaratalfaroukschool/" class="social-link"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://eg.linkedin.com/company/tedxmanaratalfaroukschool" class="social-link"><i
                                class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://www.tiktok.com/@tedxmfis" class="social-link"><i
                                class="fa-brands fa-tiktok"></i></a></li></a>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top -->
    <div class="scroll-top" id="scrollTop"></div>

    <!-- JavaScript -->
    <script>
    // Configuration - SET YOUR ACTUAL DATES HERE
    const EARLY_BIRD_DEADLINE = new Date('2025-12-05T23:59:59').getTime();
    const EVENT_DATE = new Date('2025-12-12T18:00:00').getTime();

    const EARLY_BIRD_PRICE = <?php echo $final_price ?>;
    const LATE_OWL_PRICE = <?php echo $final_price_group ?>;


    // Current phase tracking
    let currentPhase = 'early-bird'; // or 'late-owl'

    // Update countdown timer
    function updateCountdown() {
        const now = new Date().getTime();
        const isEarlyBird = now < EARLY_BIRD_DEADLINE;

        // Determine which deadline to count down to
        const targetDate = isEarlyBird ? EARLY_BIRD_DEADLINE : EVENT_DATE;
        const distance = targetDate - now;

        // Calculate time units
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Update display
        document.getElementById('days').textContent = String(days).padStart(2, '0');
        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');

        // Check if we need to switch phases
        if (currentPhase === 'early-bird' && !isEarlyBird) {
            switchToLateOwl();
        }

        // If countdown is over
        if (distance < 0) {
            if (currentPhase === 'late-owl') {
                document.querySelector('.phase-indicator').innerHTML = `
                        <div class="phase-content">
                            <div class="phase-header">
                                <div class="phase-icon">🎉</div>
                                <h2 class="phase-title">Tickets Sold Out!</h2>
                                <p class="phase-message">Thank you for your interest. </p>
                            </div>
                        </div>
                    `;
            }
        }
    }

    // Switch to Late Owl phase
    function switchToLateOwl() {
        currentPhase = 'late-owl';

        // Update phase indicator
        document.getElementById('phaseTitle').textContent = 'Late Owl Phase Active';
        document.getElementById('phaseMessage').textContent = 'Last chance to secure your spot!';
        document.querySelector('.phase-icon').textContent = '🦉';

        // Update prices
        document.getElementById('currentPrice').textContent =LATE_OWL_PRICE;
        document.getElementById('nextPrice').textContent = 'Sold Out';

        // Update ticket card
        document.getElementById('ticketName').textContent = 'Late Owl Ticket';
        document.getElementById('ticketPrice').textContent = LATE_OWL_PRICE;
        document.getElementById('savings').textContent = 'Limited spots remaining!';
        document.getElementById('savings').style.background = 'rgba(255, 193, 7, 0.2)';
        document.getElementById('savings').style.borderColor = 'rgba(255, 193, 7, 0.4)';
        document.getElementById('savings').style.color = '#FFC107';


        // Update CTA button
        document.getElementById('ticketCtaText').innerHTML = `
                Reserve My Late Owl Ticket Now
                <span class="cta-subtext">🔒 Secure checkout • Instant confirmation</span>
            `;
        document.querySelector('.ticket-cta').href =
            'Tickets/Late_Owl_Form/index.php'; // Update with actual purchase link

        // Add animation to indicate change
        document.querySelector('.ticket-card').style.animation = 'none';
        setTimeout(() => {
            document.querySelector('.ticket-card').style.animation = 'phaseSwitch 0.8s ease';
        }, 10);
    }




    // Initialize
    updateCountdown();
    setInterval(updateCountdown, 1000);

    // Add phase switch animation
    const style = document.createElement('style');
    style.textContent = `
            @keyframes phaseSwitch {
                0% { transform: perspective(1000px) rotateY(0deg); opacity: 1; }
                50% { transform: perspective(1000px) rotateY(90deg); opacity: 0.5; }
                100% { transform: perspective(1000px) rotateY(0deg); opacity: 1; }
            }
        `;
    document.head.appendChild(style);

    // Smooth scroll for any anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });


    </script>
    <script>
    // Spotlight follows mouse
    const spotlight = document.getElementById('spotlight');
    const speakersSection = document.querySelector('.speakers-section');

    speakersSection.addEventListener('mousemove', (e) => {
        const rect = speakersSection.getBoundingClientRect();
        const x = e.clientX;
        const y = e.clientY;

        spotlight.style.left = x + 'px';
        spotlight.style.top = y + 'px';
    });

    // 3D card tilt effect
    document.querySelectorAll('.speaker-card:not(.tba)').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const percentX = (x - centerX) / centerX;
            const percentY = (y - centerY) / centerY;

            const rotateY = percentX * 10;
            const rotateX = -percentY * 10;

            card.style.transform = `
                    translateY(-30px) 
                    translateZ(50px) 
                    rotateX(${rotateX}deg) 
                    rotateY(${rotateY}deg)
                `;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
        });
    });

    // Smooth scroll for CTA
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    </script>
    <script>
    // Counter Animation
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;

        const updateCounter = () => {
            current += step;
            if (current < target) {
                element.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                element.textContent = target + (target === 500 || target === 1000 ? '+' : '');
            }
        };

        updateCounter();
    }

    // Intersection Observer for Stats
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll('.stat-number');
                counters.forEach(counter => {
                    if (counter.textContent === '0') {
                        animateCounter(counter);
                    }
                });
                statsObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });

    const statsContainer = document.querySelector('.stats-container');
    if (statsContainer) {
        statsObserver.observe(statsContainer);
    }

    // Parallax effect on feature cards
    document.querySelectorAll('.feature-card').forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const percentX = (x - centerX) / centerX;
            const percentY = (y - centerY) / centerY;

            card.style.transform = `
                    rotate(${percentX * 5}deg) 
                    translateY(-10px)
                    perspective(1000px)
                    rotateY(${percentX * 10}deg)
                    rotateX(${-percentY * 10}deg)
                `;
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'rotate(0deg)';
        });
    });

    // Smooth scroll for CTA
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // Intersection Observer for mobile/tablet box animation
    if (window.innerWidth <= 968) {
        const missionVisual = document.querySelector('.mission-visual');

        const observerOptions = {
            threshold: 0.4, // Trigger when 40% visible
            rootMargin: '0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                const missionContainer = entry.target.closest('.mission-container');

                if (entry.isIntersecting) {
                    // Add in-view class when entering viewport
                    if (missionContainer) {
                        missionContainer.classList.add('in-view');
                        missionContainer.classList.remove('out-of-view');
                    }
                } else {
                    // Add out-of-view class when leaving viewport
                    if (missionContainer) {
                        missionContainer.classList.remove('in-view');
                        missionContainer.classList.add('out-of-view');
                    }
                }
            });
        }, observerOptions);

        if (missionVisual) {
            observer.observe(missionVisual);
        }
    }
    </script>
    <script>
    // Elements
    const mainNav = document.getElementById('mainNav');
    const scrollTop = document.getElementById('scrollTop');
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');
    const sectionDots = document.querySelectorAll('.section-dot');

    let lastScroll = 0;

    // Hide/Show Nav on Scroll
    function handleNavScroll() {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            mainNav.classList.add('scrolled');
        } else {
            mainNav.classList.remove('scrolled');
        }

        if (currentScroll > lastScroll && currentScroll > 200) {
            mainNav.classList.add('hidden');
        } else {
            mainNav.classList.remove('hidden');
        }

        lastScroll = currentScroll;
    }

    // Show/Hide Section Nav and Scroll Top
    function handleElementsVisibility() {
        const scrollPosition = window.pageYOffset;

        if (scrollPosition > 300) {
            scrollTop.classList.add('visible');
        } else {
            scrollTop.classList.remove('visible');
        }
    }

    // Smooth Scroll
    function smoothScroll(target) {
        const element = document.querySelector(target);
        if (element) {
            window.scrollTo({
                top: element.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    }

    // Mobile Menu Toggle
    menuToggle.addEventListener('click', () => {
        menuToggle.classList.toggle('active');
        mobileMenu.classList.toggle('active');
        document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
    });

    // Close mobile menu when link clicked
    mobileMenuLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = link.getAttribute('href');
            menuToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
            smoothScroll(target);
        });
    });

    // Scroll to top
    scrollTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Logo click
    document.querySelector('.nav-logo').addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Scroll Events
    window.addEventListener('scroll', () => {
        handleNavScroll();
        handleElementsVisibility();
    });

    // Initial calls
    handleElementsVisibility();
    </script>
    <script>
    // Custom Cursor
    const cursor = document.querySelector('.cursor');
    let mouseX = 0,
        mouseY = 0;
    let cursorX = 0,
        cursorY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    function animateCursor() {
        cursorX += (mouseX - cursorX) * 0.15;
        cursorY += (mouseY - cursorY) * 0.15;

        cursor.style.left = cursorX + 'px';
        cursor.style.top = cursorY + 'px';

        requestAnimationFrame(animateCursor);
    }
    animateCursor();

    // Cursor Trail
    let trailTimer;
    document.addEventListener('mousemove', (e) => {
        clearTimeout(trailTimer);
        trailTimer = setTimeout(() => {
            const trail = document.createElement('div');
            trail.className = 'cursor-trail';
            trail.style.left = e.clientX + 'px';
            trail.style.top = e.clientY + 'px';
            document.body.appendChild(trail);

            setTimeout(() => trail.remove(), 500);
        }, 10);
    });

    // Hover effect on CTAs
    document.querySelectorAll('.cta-btn').forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            cursor.style.transform = 'scale(2)';
        });
        btn.addEventListener('mouseleave', () => {
            cursor.style.transform = 'scale(1)';
        });
    });

    // Parallax effect on mouse move
    const boxScene = document.querySelector('.box-scene');
    document.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth - 0.5) * 30;
        const y = (e.clientY / window.innerHeight - 0.5) * 30;
        boxScene.style.transform = `rotateX(${20 + y}deg) rotateY(${x}deg)`;
    });

    // Toggle FAQ accordion
    function toggleFAQ(element) {
        // Close all other FAQs
        const allFAQs = document.querySelectorAll('.faq-item');
        allFAQs.forEach(faq => {
            if (faq !== element && faq.classList.contains('active')) {
                faq.classList.remove('active');
            }
        });

        // Toggle clicked FAQ
        element.classList.toggle('active');
    }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var splide = new Splide('.splide', {
            type: 'loop',
            perPage: 4,
            perMove: 1,
            direction: 'ltr',
            pagination: true,
            paginationDirection: 'ltr',
            drag: true,
            snap: true,
            arrows: false,
            autoplay: true,
            pauseOnHover: true,
            pauseOnFocus: true,
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
</body>

</html>
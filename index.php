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
    <base href="http://localhost/Me_TEDxMFIS/">
    <!-- <base href="https://tedxmanaratalfaroukschool.com/"> -->

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
    <div class="cursor"></div>

    <!-- Main Navigation -->
    <nav class="main-nav" id="mainNav">
        <div class="nav-container">
            <a href="#home" class="nav-logo">
                <img src="images\TEDx_logo_place2_RGB_CS2_page-0003.png" alt="">
            </a>

            <ul class="nav-links">
                <li><a href="#home" class="nav-link active" data-section="home">Home</a></li>
                <li><a href="#about" class="nav-link" data-section="about">About</a></li>
                <li><a href="#speakers" class="nav-link" data-section="speakers">Speakers</a></li>
                <li><a href="#schedule" class="nav-link" data-section="schedule">Schedule</a></li>
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
            <li><a href="#home" class="mobile-menu-link active" data-section="home">Home</a></li>
            <li><a href="#about" class="mobile-menu-link" data-section="about">About</a></li>
            <li><a href="#speakers" class="mobile-menu-link" data-section="speakers">Speakers</a></li>
            <li><a href="#schedule" class="mobile-menu-link" data-section="schedule">Schedule</a></li>
        </ul>
        <a href="#tickets" class="mobile-menu-cta">Get Your Ticket</a>
    </div>


    <section class="hero">
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
                <rect x="5" y="5" rx="15" ry="15" width="20" height="40" />
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

        <!-- Three Stages Story -->
        <!-- REMOVED: story-container section -->

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
                    <span class="stat-number" data-target="10">0</span>
                    <span class="stat-label">Speakers</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="500">0</span>
                    <span class="stat-label">Attendees</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="8">0</span>
                    <span class="stat-label">Hours of Content</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" data-target="1000">0</span>
                    <span class="stat-label">Ideas Shared</span>
                </div>
            </div>
        </div>

        <!-- What Makes Us Different -->
        <div class="different-container">
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
        </div>

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

    <!-- Section Navigation (Side Dots) -->
    <div class="section-nav" id="sectionNav">
        <div class="section-dot active" data-section="home" data-label="Home"></div>
        <div class="section-dot" data-section="about" data-label="About Us"></div>
        <div class="section-dot" data-section="speakers" data-label="Speakers"></div>
        <div class="section-dot" data-section="schedule" data-label="Schedule"></div>
        <div class="section-dot" data-section="tickets" data-label="Tickets"></div>
    </div>

    <!-- Scroll to Top -->
    <div class="scroll-top" id="scrollTop"></div>

    <!-- JavaScript -->
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
    const progressBar = document.getElementById('progressBar');
    const sectionNav = document.getElementById('sectionNav');
    const scrollTop = document.getElementById('scrollTop');
    const menuToggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');
    const sectionDots = document.querySelectorAll('.section-dot');

    let lastScroll = 0;

    // Progress Bar Update
    function updateProgressBar() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const progress = (scrollTop / scrollHeight) * 100;
        progressBar.style.transform = `scaleX(${progress / 100})`;
    }

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
            sectionNav.classList.add('visible');
            scrollTop.classList.add('visible');
        } else {
            sectionNav.classList.remove('visible');
            scrollTop.classList.remove('visible');
        }
    }

    // Update Active Section
    function updateActiveSection() {
        const sections = document.querySelectorAll('section');
        const scrollPosition = window.pageYOffset + 200;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');

            if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                // Update nav links
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-section') === sectionId) {
                        link.classList.add('active');
                    }
                });

                // Update mobile menu links
                mobileMenuLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-section') === sectionId) {
                        link.classList.add('active');
                    }
                });

                // Update section dots
                sectionDots.forEach(dot => {
                    dot.classList.remove('active');
                    if (dot.getAttribute('data-section') === sectionId) {
                        dot.classList.add('active');
                    }
                });
            }
        });
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

    // Navigation link clicks
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = link.getAttribute('href');
            smoothScroll(target);
        });
    });

    // Section dot clicks
    sectionDots.forEach(dot => {
        dot.addEventListener('click', () => {
            const section = dot.getAttribute('data-section');
            smoothScroll(`#${section}`);
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
        updateProgressBar();
        handleNavScroll();
        handleElementsVisibility();
        updateActiveSection();
    });

    // Initial calls
    updateProgressBar();
    updateActiveSection();
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
    </script>
    <script>
    document.getElementById('actionLink').addEventListener('click', function(event) {
        <?php if ($checkbox_status): ?>
        event.preventDefault(); // Prevent action if link is disabled
        <?php endif; ?>
    });
    </script>
    <!-- <script src="/script.js"></script> -->
    <script type="text/javascript">
    $(document).ready(function() {
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
    <script src="script.js"></script>
</body>

</html>
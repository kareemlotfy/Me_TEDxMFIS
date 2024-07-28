<!DOCTYPE html>
<html lang="en">


<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/66081d606d.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="user/images/x-art.png" type="image/x-icon">

    <!-- Base URL -->
    <base href="http://localhost/Me_TEDxMFIS/">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="user/style.css">
    <link rel="stylesheet" href="user/Home/style-home.css">
    <!-- <link rel="stylesheet" href="user/css/style-hero.css"> -->

    <!-- Title -->
    <title>TEDx Manarat AlFarouk School</title>
</head>

<body>

    <section class="header" id="headerSection">
        <!-- Navigation -->
        <nav class="banners_navbar" id="navbar">
            <!-- Logo -->
            <a href="user/Home/index.php"><img src="user\images\TEDx_logo_place2_RGB_CS2_page-0003.png" alt="tedx logo"
                    id="tedx_logo"></a>

            <!-- Nav Links -->
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark  burger mark" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="user/Home/index.php" class="nav_text ">Home</a></li>
                    <li><a href="user/Speakers/speakers.php" class="nav_text">Speakers</a></li>
                    <li><a href="user/shop/index.php?page=products" class="nav_text">Shop</a></li>
                    <li><a href="user/Sponsors/sponsors.php" class="nav_text">Sponsors</a></li>
                    <li><a href="user/About/about.html" class="nav_text">About</a></li>
                    <li><a href="user/Tickets/buy-tickets.html" class="nav_text">Tickets</a></li>
                </ul>
            </div>
            <form action="">
                <button class="ticket-button"><a href="user/Tickets/tickets.php">Get Ticket</a></button>
            </form>
            <!-- Burger Menu -->
            <i class="fa-solid fa-bars burger" onclick="showMenu()"></i>
        </nav>
    </section>

    <div class="body_section speakers_banner" id="banner">
        <div class="inner_content">
            <div>
                <h1 class="text">SPEAKERS</h1>
            </div>
        </div>
    </div>
    <footer>
        <div class="inner_content">
            <div class="footer-container">
                <div class="fc-col1">
                    <img src="user\images\TEDx_logo_place2_RGB_CS2_page-0001.png" alt="TEDxManaratAlFarouk logo"
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
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- <div class="cursor"></div>
<div class="cursor2"></div> -->

    <script src="user/script.js"></script>
</body>

</html>
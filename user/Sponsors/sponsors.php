<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/66081d606d.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="user/images/x-art.png" type="image/x-icon">
    <!-- Slick Files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <base href="http://localhost/Me_TEDxMFIS/">
    <link rel="stylesheet" href="user/Sponsors/style-sponsers.css">
    <link rel="stylesheet" href="user/style.css">
    <link rel="stylesheet" href="user/Home/style-home.css">
    <title>TEDx Manarat AlFarouk School - Spreading ideas, inspiring change.</title>
</head>

<body>

    <section class="header" id="headerSection">
        <!-- Navigation -->
        <nav id="navbar">
            <!-- Logo -->
            <a href="user/Home/index.php"><img src="user\images\TEDx_logo_place2_RGB_CS2_page-0001.png" alt="tedx logo"
                    id="tedx_logo"></a>

            <!-- Nav Links -->
            <div class="nav-links" id="navLinks">
                <!-- <i class="fa-solid fa-xmark  burger mark" onclick="hideMenu()"></i> -->
                <ul>
                    <li><a href="user/Home/index.php" class="nav_text ">Home</a></li>
                    <li><a href="user/Speakers/speakers.php" class="nav_text">Speakers</a></li>
                    <li><a href="user/shop/index.php?page=products" class="nav_text">Shop</a></li>
                    <li><a href="user/Sponsors/sponsors.php" class="nav_text">Sponsors</a></li>
                    <li><a href="user/About/about.php" class="nav_text">About</a></li>
                    <li><a href="user/Tickets/buy-tickets.php" class="nav_text">Tickets</a></li>
                </ul>
            </div>
            <form action="">
                <button class="ticket-button"><a href="user/Tickets/tickets.php">Get Ticket</a></button>
            </form>
            <!-- Burger Menu -->
            <!-- <i class="fa-solid fa-bars burger" onclick="showMenu()"></i> -->
        </nav>
    </section>

    <div class="cards" id="banner">
        <div>
            <h1 class="text">SPONSORS</h1>
        </div>
    </div>

    <section class="body_section" id="sponsors">
        <div class="inner_content">
            <div class="spacing_size spacing_size-initial" style="height:41px;"></div>
            <div class="sponsor_slick_title">
                <h4><span style="font-weight: 400;" class="genesisexpo_font-weight">Gold Sponsors</span></h4>
            </div>
            <div class="sponsors_slider slider">
                <div class="sponsor_card">
                    <img src="user\images\sponsers\sp (1).png" alt="">
                </div>
                <div class="sponsor_card">
                    <img src="user\images\sponsers\sp (2).png" alt="">
                </div>
                <div class="sponsor_card">
                    <img src="user\images\sponsers\sp (3).png" alt="">
                </div>
                <div class="sponsor_card">
                    <img src="user\images\sponsers\sp (4).png" alt="">
                </div>
                <div class="sponsor_card">
                    <img src="user\images\sponsers\sp (5).png" alt="">
                </div>
                <div class="sponsor_card">
                    <img src="user\images\sponsers\sp (6).png" alt="">
                </div>
                <div class="sponsor_card">
                    <img src="user\images\sponsers\sp (7).png" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- <div class="cursor"></div>
<div class="cursor2"></div> -->

    <script>


        function setDynamicPadding() {
            var windowWidth = window.innerWidth;

            // Check if window width is less than or equal to 600px
            if (windowWidth <= 600) {
                // Remove inline styles added by JavaScript
                var elements = document.querySelectorAll('.body_section');
                elements.forEach(function (element) {
                    element.style.removeProperty('padding-left');
                    element.style.removeProperty('padding-right');
                });
                return; // Exit the function
            }

            var mainContentWidth = document.querySelector('.inner_content').offsetWidth;
            var paddingValue = windowWidth - mainContentWidth;
            var paddingLR = paddingValue / 2;

            // Apply padding to the desired class
            var elements = document.querySelectorAll('.body_section');
            elements.forEach(function (element) {
                element.style.paddingLeft = paddingLR + 'px';
                element.style.paddingRight = paddingLR + 'px';
            });
        }

        // Call the function initially and on window resize
        window.onload = setDynamicPadding;
        window.addEventListener('resize', setDynamicPadding);
    </script>
</body>

</html>
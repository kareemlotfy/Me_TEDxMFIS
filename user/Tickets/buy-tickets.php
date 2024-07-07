<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/66081d606d.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="user/images/x-art.png" type="image/x-icon">
    <base href="http://localhost/TEDxManaratAlfaroukSchool/">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="user/Tickets/style-buy-tickets.css">
    <link rel="stylesheet" href="user/style.css">
    <link rel="stylesheet" href="user/Home/style-home.css">
    <title>TEDx Manarat AlFarouk School - Spreading ideas, inspiring change.</title>
</head>
<body>
    <!-- Header Start -->
    <section class="header" id="headerSection">
        <nav id="navbar">
            <a href="user/php/index.php"><img src="user\images\TEDx_logo_place2_RGB_CS2_page-0003.png" alt="tedx logo" id="tedx_logo"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa-solid fa-xmark burger mark" onclick="hideMenu()"></i>
                <ul>
                    <li><a href="user/Home/index.php" class="nav_text">Home</a></li>
                    <li><a href="user/Speakers/speakers.php" class="nav_text">Speakers</a></li>
                    <li><a href="user/shop/index.php?page=products" class="nav_text">Shop</a></li>
                    <li><a href="user/Sponsors/sponsors.php" class="nav_text">Sponsors</a></li>
                    <li><a href="user/About/about.php" class="nav_text">About</a></li>
                    <li><a href="user/Tickets/buy-tickets.php" class="nav_text">Tickets</a></li>
                </ul>
            </div>
            <form action="">
                <button class="ticket-button"><a href="">Get Ticket</a></button>
            </form>
            <i class="fa-solid fa-bars burger" onclick="showMenu()"></i>
        </nav>
    </section>
    <!-- Header End -->

    <!-- Banner Start -->
    <div class="cards" id="banner">
        <div class="banner-content">
            <h1 class="banner-header">Tickets</h1>
            <h2 class="banner-description">Get Your Ticket Right Now</h2>
            <div class="ticket-button">
                <a href="user/Tickets/tickets.php">Get Ticket</a>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <section class="cards" id="buy-tickets-page_tickets_section">
        <div class="inner_content">
            <div class="tickets-container">
                <div class="tickets-cards-container">
                    <div class="ticket-card">
                        <div class="pricing-container">
                            <div class="punch"></div>
                            <div class="ticket-price">$399.00</div>
                        </div>
                        <div class="ticket-description">
                            <ul>
                                <li>Access to all workshops</li>
                                <li>View all the bazaar</li>
                                <li>Watch all the talks</li>
                                <li>Read all the books</li>
                            </ul>
                        </div>
                        <div class="ticket-button">
                            <a href="user/php/tickets.php">Get Ticket</a>
                        </div>
                    </div>
                    <div class="ticket_card_down">
                        <div class="spacing_size spacing_size-initial" style="height:70px;"></div>
                        <div class="ticket-card">
                            <div class="pricing-container">
                                <div class="punch"></div>
                                <div class="ticket-price">$399.00</div>
                            </div>
                            <div class="ticket-description">
                                <ul>
                                    <li>Access to all workshops</li>
                                    <li>View all the bazaar</li>
                                    <li>Watch all the talks</li>
                                    <li>Read all the books</li>
                                </ul>
                            </div>
                            <div class="ticket-button">
                                <a href="user/php/tickets.php">Get Ticket</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="tickets-text-container">
                    <div class="heading">
                        <div class="content-under-special-heading">
                            <h3 class="special-heading-title">How Much?</h3>
                            <p class="description ticket_heading_description">Building great products is hard. A little over 5 years ago, we started TEDxManaratAlfaroukSchool to learn from those who’ve been there and done it.</p>
                            <ul>
                                <li class="description">Access to the conference and a workshop of your choice.</li>
                                <li class="description">Includes coffee, breakfast, lunch and open-bar.</li>
                                <li class="description">Stick around for music, craft beer, cocktails and chats.</li>
                            </ul>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
   </section>
   <div class="cursor"></div>
   <div class="cursor2"></div>
    <!-- JS Files -->
    <script src="user/script.js"></script>
</body>
</html>

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

    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <!-- Slick JS -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js">
    </script>


    <!-- Stylesheets -->
    <link rel="stylesheet" href="user/style.css">
    <link rel="stylesheet" href="user/Home/style-home.css">
    <link rel="stylesheet" href="user/Speakers/style-speakers.css">
    <!-- Title -->
    <title>TEDx Manarat AlFarouk School</title>
</head>

<body class="speakers_page">
    
    <div class="loader-container">
        <svg viewBox="102 10 300 200" width="100%" height="100%">
            <text x="50%" y="50%" dy=".32em" text-anchor="middle" class="text-body-1">TEDx</text>
            <text x="50%" y="50%" dy=".32em" dx="5.5em" text-anchor="middle" class="text-body-2">ManaratAlFarouk</text>
        </svg>
    </div>

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
                    <li><a href="user/Home/index.html" class="nav_text ">Home</a></li>
                    <li><a href="user/Speakers/speakers.php" class="nav_text">Speakers</a></li>
                    <li><a href="Misc/underm.html" class="nav_text">Shop</a></li>
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
    <div class="speakers-slider">
        <!-- Meccano Section -->
        <section class="body_section speakers_section" id="meccano_speakers">
            <div class="inner_content">
                <div class="special-heading-container">
                    <button type="button" class="slick-prev"><</button>
                    <div class="special-heading">Meccano</div>
                    <button type="button" class="slick-next">></button>
                </div>
                <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                <!-- Speakers Cards Container -->
                <div class="speakers-cards-container">
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/MeccanoO.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="spacing_size spacing_size-initial" style="height:50px;"></div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Our 5th Event</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[3/3/2023]</div>
                        </div>
                    </div>
                    <!-- Speaker Card 1 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/amer.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Ahmed Amer</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Contetn Creator]</div>
                        </div>
                    </div>
                    <!-- Speaker Card 2 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/kemia.jpeg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Ahmed Kemia</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Content Creator]</div>
                        </div>
                    </div>



                    <!-- Speaker Card 3 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/abouzaid.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Ahmed Abouzaid</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Content Creator]</div>
                        </div>
                    </div>

                    <!-- New Div with Image -->


                    <!-- Speaker Card 4 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/shahin.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Ahmed Shahin</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Content Creator]</div>
                        </div>
                    </div>
                    <!-- Speaker Card 5 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/ahmed-yassin.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Ahmed Yassin</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Web Developer]</div>
                        </div>
                    </div>
                    <!-- Speaker Cards -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/amr-sherif.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Amr Sherif</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Food Blogger]</div>
                        </div>
                    </div>
                    <!-- Speaker Cards -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/mamado.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Mamado Ebn Reda</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Biker]</div>
                        </div>
                    </div>
                    <!-- Speaker Cards -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/mohammedhazem.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Mohammed Hazem</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Therapy]</div>
                        </div>
                    </div>

                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/nour.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Nour</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Dont Know]</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Luminour Section -->
        <section class="body_section speakers_section" id="luminous_speakers">
            <div class="inner_content">
                <div class="special-heading-container">
                    <button type="button" class="slick-prev"><</button>
                    <div class="special-heading">Luminous</div>
                    <button type="button" class="slick-next">></button>
                </div>
                <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                <!-- Speakers Cards Container -->
                <div class="speakers-cards-container">
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/Luminous.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="spacing_size spacing_size-initial" style="height:50px;"></div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Our 4th Event</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[23/3/2022]</div>
                        </div>
                    </div>
                    <!-- Speaker Card 1 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/amer.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Abdullah Amer</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Host]</div>
                        </div>
                    </div>

                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/shahin.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Ahmed Shahin</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Content Creator]</div>
                        </div>
                    </div>



                    <!-- Speaker Card 2 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/nofal.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Zeyad Nofal</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Tashkenter]</div>
                        </div>
                    </div>

                    <!-- Speaker Card 3 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/aysha.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Aysha Shreif</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Don't Know]</div>
                        </div>
                    </div>
                    <!-- Speaker Card 4 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/alaa.jpg" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Alaa Usama</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Don't Know]</div>
                        </div>
                    </div>
                    <!-- Speaker Card 5 -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/abdelsalam.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Omar Abdelsalam</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Don't Know]</div>
                        </div>
                    </div>
                    <!-- Speaker Cards -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/abousamra.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Mostafa AbouSamra</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Caizo]</div>
                        </div>
                    </div>
                    <!-- Speaker Cards -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/elgamal.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Mahmoud El Gamal</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Don't Know]</div>
                        </div>
                    </div>
                    <!-- Speaker Cards -->
                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/khaled.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Khaled El Degwy</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Don't Know]</div>
                        </div>
                    </div>

                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/atya.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Gamel Atya</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Dont Know]</div>
                        </div>
                    </div>

                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/fadl.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Mohammed Fadl</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Dont Know]</div>
                        </div>
                    </div>

                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/elhamzawy.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Ehab Elhamzawy</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Dont Know]</div>
                        </div>
                    </div>

                    <div class="speaker-card">
                        <!-- Speaker Image -->
                        <div class="speaker-img">
                            <img src="user/images/speakers_page/sokkar.png" alt="speaker image">
                        </div>

                        <!-- Speaker Information -->
                        <div class="speaker-info">
                            <!-- Social Media Links -->
                            <div class="speaker-nav">
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-linkedin"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-instagram"></i></a>
                                <a href="" target="_blank" rel="noopener noreferrer"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </div>
                            <!-- Speaker Name -->
                            <div class="speaker-name">Juayria Sokkar</div>
                            <!-- Speaker Job -->
                            <div class="speaker-job">[Dont Know]</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('.speakers-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true,
                prevArrow: $('.slick-prev'),
                nextArrow: $('.slick-next'),
            });
        });
    </script>
    
    
</body>

</html>
<?php require_once __DIR__ . '/../config.php'; ?>
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
        content="Discover inspiring talks and profiles of the speakers at TEDxManaratAlFaroukSchool. Meet the minds shaping the future and sharing impactful ideas.">
    <meta name="keywords"
        content="TEDxManaratAlFaroukSchool, TEDx speakers, TED speakers, inspiring talks, speaker profiles, speakers, ted, mfis, event">
    <meta name="robots" content="index, follow">
    <meta name="referrer" content="no-referrer">
    <meta name="author" content="TEDxManaratAlFaroukSchool">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="..\assets\fontawesome-free-6.6.0-web\fontawesome-free-6.6.0-web\css\all.min.css">

    <!-- Favicon -->
    <link rel="shortcut icon" href="images/x-art.webp" type="image/x-icon">

    <!-- Base URL -->
    <base href="<?php echo BASE_URL; ?>">


    <!-- Splide CSS -->
    <link rel="stylesheet" href="assets\splide-4.1.3\splide-4.1.3\dist\css\splide-core.min.css">
    <link rel="stylesheet" href="assets\splide-4.1.3\splide-4.1.3\dist\css\splide.min.css">
    <link rel="stylesheet" href="assets\splide-4.1.3\splide-4.1.3\dist\css\themes\splide-default.min.css">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Speakers/style-speakers.css">
    <link rel="stylesheet" href="style-home.css">
    <!-- Title -->
    <title>TEDx Manarat AlFarouk School</title>
</head>

<body class="speakers_page">
    <div id="speakers">

        <!-- Main Navigation -->
    <nav class="main-nav sub-nav" id="mainNav">
        <div class="nav-container">
            <a href="#home" class="nav-logo">
                <img src="images\tedx-logo-white.webp" alt="">
            </a>

            <ul class="nav-links">
                <li><a href="#home" class="nav-link" data-section="home">Home</a></li>
                <li><a href="About\index.php" class="nav-link">About</a></li>
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
            <li><a href="index.php" class="mobile-menu-link">Home</a></li>
            <li><a href="About\index.php" class="mobile-menu-link">About</a></li>
            <li><a href="Speakers\index.php" class="mobile-menu-link">Speakers</a></li>
            <li><a href="Sponsors\index.php" class="mobile-menu-link">Sponsors</a></li>
        </ul>
        <a href="#tickets" class="mobile-menu-cta">Get Your Ticket</a>
    </div>


        <div class="body_section  speakers_banner" id="banner">
            <div class="inner_content">

                <h1 class="text">SPEAKERS</h1>

            </div>
        </div>

        <div class="speakers-slider splide">
            <div class="splide__track">
                <ul class="splide__list">
                    <!-- Behind The Scene -->
                    <li class="body_section  speakers-container splide__slide" id="meccano_speakers">
                        <div class="inner_content">
                            <div class="special-heading-container">
                                <div class="special-heading" id="behind-title">ما وراء الكواليس</div>
                            </div>
                            <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                            <!-- Speakers Cards Container -->
                            <div class="speakers-grid">
                                <!-- Event Card -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/behind the scenes/behind.webp" alt="Our 5th Event"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Event</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Our 6th Event</h3>
                                        <p class="speaker-title">[12/6/2024]</p>
                                        <div class="speaker-social">
                                            <!-- No social links for event card -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card Host - Raghad Ahmed -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/raghad-ahmed.webp"
                                            alt="Raghad Ahmed TEDxManaratAlFaroukSchool speaker" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Host</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Raghad Ahmed</h3>
                                        <p class="speaker-title">[Host]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.instagram.com/boska_says/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://www.tiktok.com/@boskasays" target="_blank"
                                                rel="noopener noreferrer" class="social-link" aria-label="TikTok">TT</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Abdullah Amer -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/abdullah-amer.webp"
                                            alt="Abdullah Amer TEDxManaratAlFaroukSchool speaker" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Host</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Abdullah Amer</h3>
                                        <p class="speaker-title">[Host]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.linkedin.com/in/amership9/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/amership9/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://www.threads.net/@amership9" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Threads">th</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Diet & Cheat -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/diet-cheat.webp"
                                            alt="Diet and Cheat TEDxManaratAlFaroukSchool speaker"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Health & Wellness</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Diet & Cheat</h3>
                                        <p class="speaker-title">[Health & wellness]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/dietandcheat1/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.youtube.com/@dietandcheat" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                            <a href="https://www.instagram.com/dietand.cheat/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://x.com/diet_cheat" target="_blank" rel="noopener noreferrer"
                                                class="social-link" aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Zaghaleel -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/Zaghaleel.webp"
                                            alt="Zaghaleel TEDxManaratAlFaroukSchool speaker" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Digital Creator</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Zaghaleel</h3>
                                        <p class="speaker-title">[Digital creator]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/Zaghaleel1" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.youtube.com/@zaghaleel" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                            <a href="https://www.instagram.com/zaghaleeel" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://www.tiktok.com/@zaghaleeel" target="_blank"
                                                rel="noopener noreferrer" class="social-link" aria-label="TikTok">TT</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Yasmine Medhat -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/yasmine-medhat.webp"
                                            alt="Yasmine medhat TEDxManaratAlFaroukSchool speaker"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Entrepreneur</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Yasmine Medhat</h3>
                                        <p class="speaker-title">[Entrepreneur]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/yasminemedhat" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/yasmine-medhat-423b7a149"
                                                target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/yasminemedhat/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://www.threads.net/@yasminemedhat" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Threads">th</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Maha Gamil -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/maha-gamil.webp"
                                            alt="Maha Gamil TEDxManaratAlFaroukSchool speaker" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Artist</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Maha Gamil</h3>
                                        <p class="speaker-title">[Artist]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/maha.gamillll/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.tiktok.com/@mahagamil316" target="_blank"
                                                rel="noopener noreferrer" class="social-link" aria-label="TikTok">TT</a>
                                            <a href="https://www.instagram.com/mahagamilll/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://x.com/MahaGamil9" target="_blank" rel="noopener noreferrer"
                                                class="social-link" aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Rana Al Zahar -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/rana.webp"
                                            alt="Rana Al Zahar TEDxManaratAlFaroukSchool speaker" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Chemistry Doctor</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Rana Al Zahar</h3>
                                        <p class="speaker-title">[Chemistry Doctor]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/RElZahar/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/rana-el-zahar-56184023b"
                                                target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/ranaelzahar/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://www.tiktok.com/@ranaelzaharr" target="_blank"
                                                rel="noopener noreferrer" class="social-link" aria-label="TikTok">TT</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Shorouqii El-Tananii -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/shorouqii-eltananii.webp"
                                            alt="Shorouqii El Tananii TEDxManaratAlFaroukSchool speaker"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Content Creator</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Shorouqii El-Tananii</h3>
                                        <p class="speaker-title">[Content creator]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/shorouqiieltananii" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.youtube.com/@Shorouqiiillustrations" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                            <a href="https://www.instagram.com/shorouqii_illustrations/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://www.tiktok.com/@shorouqiieltananii" target="_blank"
                                                rel="noopener noreferrer" class="social-link" aria-label="TikTok">TT</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Karim Nabil -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/karim-nabil.webp"
                                            alt="Karim Nabil TEDxManaratAlFaroukSchool speaker" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Product Manager</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Karim Nabil</h3>
                                        <p class="speaker-title">[Product Manager]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/Eng.Kariim.Nabiil" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/kariim-nabiil/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.youtube.com/@kariimnabiil-911/featured" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mostafa Gabr -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/mostafa-gabr.webp"
                                            alt="Mostafa Gabr TEDxManaratAlFaroukSchool speaker" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">ProdConsult</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mostafa Gabr</h3>
                                        <p class="speaker-title">[ProdConsult]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/mustafaagabr/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/mostafaagabr" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/mostafa.agabr/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Hesham Abdelmaksoud -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/hesham-abdelm.webp"
                                            alt="Hesham Abdelmaksoud TEDxManaratAlFaroukSchool" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Performance</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Hesham Abdelmaksoud</h3>
                                        <p class="speaker-title">[Performance]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/heshamAbdelmaksoud99/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/hesham-abdelmaksoud-0328a5123"
                                                target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/heshamabdelm/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://www.youtube.com/@heshamabdelmaksoud2/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Lamia Nageb -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/lamia-nageb.webp"
                                            alt="Lamia Nageb TEDxManaratAlFaroukSchool" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Performance</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Lamia Nageb</h3>
                                        <p class="speaker-title">[Performance]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/lamianagebelyass/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/lamia-nageb/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/lamianagebvo/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://www.youtube.com/@lamianagebvo" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Ayah Nasr -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images\generation\behind the scenes/ayah-nasr.webp"
                                            alt="Ayah Nasr TEDxManaratAlFaroukSchool" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Performance</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ayah Nasr</h3>
                                        <p class="speaker-title">[Performance]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.instagram.com/ayaa_nasr_1/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Meccano Section -->
                    <li class="body_section  speakers-container splide__slide" id="meccano_speakers">
                        <div class="inner_content">
                            <div class="special-heading-container">
                                <div class="special-heading">Meccano</div>
                            </div>
                            <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                            <!-- Speakers Cards Container -->
                            <div class="speakers-grid">
                                <!-- Event Card -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/meccano.webp" alt="Our 5th Event"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Event</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Our 5th Event</h3>
                                        <p class="speaker-title">[3/3/2023]</p>
                                        <div class="speaker-social">
                                            <!-- No social links for event card -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 4 - Ahmed Shahin -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/ahmed-shahin.webp" alt="Ahmed Shahin"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Host</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ahmed Shahin</h3>
                                        <p class="speaker-title">[Host]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/AhmedShahinOfficial/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/ahmedshahinofficial" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/ahmedshahinofficial" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://x.com/Coach_Shahin" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 1 - Abdullah Amer -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/abdullah-amer.webp" alt="Abdullah Amer"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Abdullah Amer</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 2 - Ahmed Kemia -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/ahmed-gouda.webp" alt="Ahmed Kemia"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ahmed Kemia</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/kemyaa/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/kemya" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/kemyaa/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://x.com/kemyaa" target="_blank" rel="noopener noreferrer"
                                                class="social-link" aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 2 - Zeyad Nofal -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/zeyad.webp" alt="Zeyad Nofal"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Zeyad Nofal</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/zeyad_nofal1/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 3 - Ahmed Abouzaid -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/ahmed-abouzaid.webp" alt="Ahmed Abouzaid"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ahmed Abouzaid</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/ahmed.abouzaid.58/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://eg.linkedin.com/in/ahmed-abouzaid-abab75b7" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/abouzaid_official/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 5 - Ahmed Yassin -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/ahmed-yassin.webp" alt="Ahmed Yassin"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ahmed Yassin</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/ahmedyassinyusuf/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Amr Sherif -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/amr-sherif.webp" alt="Amr Sherif"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Amr Sherif</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/amrsherif.yt/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.youtube.com/c/AmrSherifofficial" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                            <a href="https://www.instagram.com/amr.sherif.adel" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://x.com/amr_sherif_adel" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mamado Ebn Reda -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/mamado-ebnreda.webp" alt="Mamado Ebn Reda"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mamado Ebn Reda</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mohammed Hazem -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/muhammed-hazem.webp" alt="Mohammed Hazem"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohammed Hazem</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Nour -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/meccano/nour.webp" alt="Nour" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Nour</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Luminour Section -->
                    <li class="body_section speakers-container speakers_section splide__slide" id="luminous_speakers">
                        <div class="inner_content">
                            <div class="special-heading-container">
                                <div class="special-heading">Luminous</div>
                            </div>
                            <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                            <!-- Speakers Cards Container -->
                            <div class="speakers-grid">
                                <!-- Event Card -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous//Luminous.webp" alt="Our 4th Event"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Event</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Our 4th Event</h3>
                                        <p class="speaker-title">[23/3/2022]</p>
                                        <div class="speaker-social">
                                            <!-- No social links for event card -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 1 - Abdullah Amer -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/abdullah_amer.webp" alt="Abdullah Amer"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Host</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Abdullah Amer</h3>
                                        <p class="speaker-title">[Host]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Ahmed Shahin -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/ahmedshahin.webp" alt="Ahmed Shahin"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ahmed Shahin</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/AhmedShahinOfficial/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="https://www.linkedin.com/in/ahmedshahinofficial" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/ahmedshahinofficial" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="https://x.com/Coach_Shahin" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 3 - Aysha Shreif -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/aysha.webp" alt="Aysha Shreif"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Aysha Shreif</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 4 - Alaa Usama -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/alaa.webp" alt="Alaa Usama"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Alaa Usama</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 5 - Omar Abdelsalam -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/abdelsalam.webp" alt="Omar Abdelsalam"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Omar Abdelsalam</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mostafa AbouSamra -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/abousamra.webp" alt="Mostafa AbouSamra"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mostafa AbouSamra</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/moustafa.abousamra/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/moustafaabousamra/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mahmoud El Gamal -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/elgamal.webp" alt="Mahmoud El Gamal"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mahmoud El Gamal</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Rawam Tarek -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/rawam-tarek.webp" alt="Rawam Tarek"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Rawam Tarek</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Khaled El Degwy -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/khaled.webp" alt="Khaled El Degwy"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Khaled El Degwy</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/p/Khaled-El-Degwy-Energize-100063756968223/"
                                                target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Gamel Atya -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/atya.webp" alt="Gamel Atya"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Gamel Atya</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mohammed Fadl -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/fadl.webp" alt="Mohammed Fadl"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohammed Fadl</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/mohamedfadl" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Ehab Elhamzawy -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/elhamzawy.webp" alt="Ehab Elhamzawy"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ehab Elhamzawy</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="https://www.facebook.com/ehab.elhamzawy.9/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/ehabelhamzawy/" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Juayria Sokkar -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/luminous/sokkar.webp" alt="Juayria Sokkar"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Juayria Sokkar</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="https://www.instagram.com/juayriaskitchen" target="_blank"
                                                rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Eunoia Section -->

                    <li class="body_section speakers-container splide__slide speakers_section" id="eunoia_speakers">
                        <div class="inner_content">
                            <div class="special-heading-container">
                                <div class="special-heading">EUNOIA</div>
                            </div>
                            <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                            <!-- Speakers Cards Container -->
                            <div class="speakers-grid">
                                <!-- Event Card -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/eunoia.webp" alt="Our 3rd Event"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Event</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Our 3rd Event</h3>
                                        <p class="speaker-title">[22/2/2020]</p>
                                        <div class="speaker-social">
                                            <!-- No social links for event card -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 1 - Abdullah Amer -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/abdullah-amer.webp" alt="Abdullah Amer"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Host</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Abdullah Amer</h3>
                                        <p class="speaker-title">[Host]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 2 - Ahmed Elgamal -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/ahmed-elgamal.webp" alt="Ahmed Elgamal"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ahmed Elgamal</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 3 - Kareem Elsayed -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/kareem-elsayed.webp" alt="Kareem Elsayed"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Kareem Elsayed</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 4 - Mohamed Goabas -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/mohamed-goabas.webp" alt="Mohamed Goabas"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohamed Goabas</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 5 - Elham Elkomy -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/elham-elkomy.webp" alt="Elham Elkomy"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Elham Elkomy</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Ahmed Elnadi -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/ahmed-elnadi.webp" alt="Ahmed Elnadi"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ahmed Elnadi</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Haitham Shokry -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/haitham-shokry.webp" alt="Haitham Shokry"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Haitham Shokry</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mohamed Ibrahim -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/mohamed-ibrahim.webp" alt="Mohamed Ibrahim"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohamed Ibrahim</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mohamed Khedr -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/mohamed-khedr.webp" alt="Mohamed Khedr"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohamed Khedr</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Nahla Elnemr -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/nahla-elnemr.webp" alt="Nahla Elnemr"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Nahla Elnemr</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Shahd Eltegany -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/shahd-eltegany.webp" alt="Shahd Eltegany"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Shahd Eltegany</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mohammed Essam -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/mohammed-essam.webp" alt="Mohammed Essam"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Performer</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohammed Essam</h3>
                                        <p class="speaker-title">[Performer]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Ola Bashir -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/eunoia/ola-bashir.webp" alt="Ola Bashir"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Performer</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ola Bashir</h3>
                                        <p class="speaker-title">[Performer]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Dimensions Section -->

                    <li class="body_section speakers-container splide__slide speakers_section" id="Dimensions_speakers">
                        <div class="inner_content">
                            <div class="special-heading-container">
                                <div class="special-heading">Dimensions</div>
                            </div>
                            <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                            <!-- Speakers Cards Container -->
                            <div class="speakers-grid">
                                <!-- Event Card -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/dimensions.webp" alt="Our 2nd Event"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Event</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Our 2nd Event</h3>
                                        <p class="speaker-title">[14/12/2018]</p>
                                        <div class="speaker-social">
                                            <!-- No social links for event card -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 1 - Hossam Heikal -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/hossam-heikal.webp" alt="Hossam Heikal"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Host</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Hossam Heikal</h3>
                                        <p class="speaker-title">[Host]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 2 - Ahmed Osama -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/ahmed-osama.webp" alt="Ahmed Osama"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ahmed Osama</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 3 - Anwar Elkamony -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/anwar-elkamony.webp" alt="Anwar Elkamony"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Anwar Elkamony</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 4 - Eslam Wageed -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/eslam-wageed.webp" alt="Eslam Wageed"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Eslam Wageed</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 5 - Nour Samir -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/nour-samir.webp" alt="Nour Samir"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Nour Samir</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Farida Elsharkawy -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/farida-elsharkawy.webp"
                                            alt="Farida Elsharkawy" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Farida Elsharkawy</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Kareem Khaled -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/kareem-khaled.webp" alt="Kareem Khaled"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Kareem Khaled</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mahmoud youssef -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/mahmoud-youssef.webp"
                                            alt="Mahmoud youssef" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mahmoud youssef</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mohammed Elsawy -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/mohamed-elsawy.webp"
                                            alt="Mohammed Elsawy" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohammed Elsawy</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mohammed Hamed -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/mohamed-hamed.webp" alt="Mohammed Hamed"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohammed Hamed</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Sahar Elbazar -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/dimensions/sahar-elbazar.webp" alt="Sahar Elbazar"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Sahar Elbazar</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- SemiColon Section -->

                    <li class="body_section speakers-container splide__slide speakers_section" id="Semicolon_speakers">
                        <div class="inner_content">
                            <div class="special-heading-container">
                                <div class="special-heading">Semicolon</div>
                            </div>
                            <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                            <!-- Speakers Cards Container -->
                            <div class="speakers-grid">
                                <!-- Event Card -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/semicolon/semicolon.webp" alt="Our Salon Event"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Salon Event</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Our Salon Event</h3>
                                        <p class="speaker-title">[8/3/2019]</p>
                                        <div class="speaker-social">
                                            <!-- No social links for event card -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 1 - Lena Fakhany -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/semicolon/lena-fakhany.webp" alt="Lena Fakhany"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Host</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Lena Fakhany</h3>
                                        <p class="speaker-title">[Host]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 2 - Hesham Alarkay -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/semicolon/hesham-alarkay.webp" alt="Hesham Alarkay"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Hesham Alarkay</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 3 - Mahmoud Anwar -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/semicolon/mahmoud-anwar.webp" alt="Mahmoud Anwar"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mahmoud Anwar</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 4 - Asmaa Abdelhamed -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/semicolon/asmaa-abdelhamed.webp"
                                            alt="Asmaa Abdelhamed" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Asmaa Abdelhamed</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 5 - Sama Atef -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/semicolon/sama-atef.webp" alt="Sama Atef"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Sama Atef</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Seif Selim -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/semicolon/seif-selim.webp" alt="Seif Selim"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Seif Selim</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Mahmoud Tamer -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/semicolon/mahmoud-tamer.webp" alt="Mahmoud Tamer"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mahmoud Tamer</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Secret Code Section -->

                    <li class="body_section speakers-container splide__slide speakers_section" id="SecretCode_speakers">
                        <div class="inner_content">
                            <div class="special-heading-container">
                                <div class="special-heading">Secret Code</div>
                            </div>
                            <div class="spacing_size spacing_size-initial" style="height:30px;"></div>
                            <!-- Speakers Cards Container -->
                            <div class="speakers-grid">
                                <!-- Event Card -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/secret-code.webp" alt="Our 1st Event"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">First Event</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Our 1st Event</h3>
                                        <p class="speaker-title">[11/11/2017]</p>
                                        <div class="speaker-social">
                                            <!-- No social links for event card -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 1 - Hossam Heikal -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/hossam-heikal.webp" alt="Hossam Heikal"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Host</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Hossam Heikal</h3>
                                        <p class="speaker-title">[Host]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 2 - Bahaa Soliman -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/bahaa-soliman.webp" alt="Bahaa Soliman"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Bahaa Soliman</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 3 - Andrew Ashraf -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/andrew-ashraf.webp" alt="Andrew Ashraf"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Andrew Ashraf</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 4 - Mohammed Moustafa -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/mohamed-moustafa.webp"
                                            alt="Mohammed Moustafa" class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Mohammed Moustafa</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card 5 - Reham Elnidany -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/reham-elnidany.webp" alt="Reham Elnidany"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Reham Elnidany</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Ziad Tarek -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/ziad-tarek.webp" alt="Ziad Tarek"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Ziad Tarek</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="YouTube">YT</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Bassel Yasser -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/bassel-yasser.webp" alt="Bassel Yasser"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Bassel Yasser</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Nada Raafat -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/nada-raafat.webp" alt="Nada Raafat"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Nada Raafat</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Hesham Afifi -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/hesham-afifi.webp" alt="Hesham Afifi"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Hesham Afifi</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Speaker Card - Hanan Saied -->
                                <div class="speaker-card">
                                    <div class="speaker-image-container">
                                        <img src="images/generation/secretcode/hanan-saied.webp" alt="Hanan Saied"
                                            class="speaker-image">
                                        <div class="expertise-tags">
                                            <span class="expertise-tag">Speaker</span>
                                        </div>
                                    </div>
                                    <div class="speaker-info">
                                        <h3 class="speaker-name">Hanan Saied</h3>
                                        <p class="speaker-title">[Speaker]</p>
                                        <div class="speaker-social">
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Facebook">f</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="LinkedIn">in</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Instagram">ig</a>
                                            <a href="" target="_blank" rel="noopener noreferrer" class="social-link"
                                                aria-label="Twitter">𝕏</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


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
                    <ul class="speaker-social" style="opacity: 1; margin-top: 0px; transform: translateY(0px);">
                        <a href="https://www.facebook.com/TEDxManaratAlFarouk/" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/tedx.manaratalfaroukschool/" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="https://eg.linkedin.com/company/tedxmanaratalfaroukschool" class="social-link"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://www.tiktok.com/@tedxmfis" class="social-link"><i class="fa-brands fa-tiktok"></i></a></li></a>
                    </ul>
                    </div>
                </div>
            </div>
        </footer>

        <script src="script.js"></script>
        <script src="assets\splide-4.1.3\splide-4.1.3\dist\js\splide.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.speakers-slider', {
                type: 'loop',
                perPage: 1,
                // gap: '1rem',
                autoplay: false,
                perMove: 1,
                interval: 3000,
                pagination: true,
                arrows: true,
            }).mount();
        });
        </script>


    </div>
</body>

</html>
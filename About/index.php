<?php require_once __DIR__ . '/../config.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--GOOGLE -->
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=G-JXGKTBFNV3"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());

      gtag("config", "G-JXGKTBFNV3");
    </script>

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="..\assets\fontawesome-free-6.6.0-web\fontawesome-free-6.6.0-web\css\all.min.css"
    />
    <meta
      name="description"
      content="TEDxManaratAlFaroukSchool brings the spirit and passion surrounding TED and TEDx to link the school’s generations."
    />
    <meta
      name="keywords"
      content="ted, tedx, tedxmanaratalfaroukschool, about, who are we?, ted event"
    />
    <link rel="shortcut icon" href="images/x-art.webp" type="image/x-icon" />
    <base href="<?php echo BASE_URL; ?>" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style-home.css" />
    <link rel="stylesheet" href="About/style-about.css" />
    <title>
      TEDx Manarat AlFarouk School - Spreading ideas, inspiring change.
    </title>
  </head>

  <body class="about_page" style="background-color: black;">
    <div id="about">
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

      <div class="body_section about_banner" id="banner">
        <div class="inner_content">
          <div>
            <h1 class="text">ABOUT</h1>
          </div>
        </div>
      </div>

      <!-- About Us Start -->
      <section class="body_section" id="aboutus">
        <div class="inner_content">
          <div class="abt-content">
            <div class="abt-right">
              <div class="heading">
                <h3 class="special-heading-title">What is TED?</h3>
                <p class="description">
                  TED is a non-profit organization whose mission is to spread
                  valuable ideas around the world.<br />
                  TED stands for Technology, Entertainment, Design: it is a
                  non-profit organization with the purpose of sharing "ideas
                  worth spreading" where the world's leading players in
                  "thinking" and "doing" are invited to talk about their ideas
                  in talks of up to 18 minutes. Their talks are later made
                  available for free online to inspire as many people as
                  possible! TED started as a conference in California in the
                  1980s, and today has grown in its 'mission' through multiple
                  initiatives to support ideas that can change the world for the
                  better.
                </p>
              </div>
            </div>
            <div class="abt_left_container">
              <div class="abt-left">
                <div class="test">
                  <img
                    class="first_img"
                    src="images\about\about (7).webp"
                    alt=""
                    id="ted-img"
                  />
                </div>

                <img
                  class="second_img"
                  src="images\about\about (5).webp"
                  alt="second-image-with-parallax"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="inner_content">
          <div class="abt-content" id="tedx-content">
            <div class="abt-right">
              <div class="heading">
                <h3 class="special-heading-title">What is TEDx?</h3>
                <p class="description">
                  In the spirit of ideas worth spreading, TED has created a
                  program called TEDx. TEDx is a program of local,
                  self-organized events that bring people together to share a
                  TED-like experience. Our event is called
                  TEDxManaratAlFaroukSchool, where x = independently organized
                  TED event. At our TEDxManaratAlFaroukSchool event, TED Talks
                  video and live speakers will combine to spark deep discussion
                  and connection in a small group. The TED Conference provides
                  general guidance for the TEDx program, but individual TEDx
                  events, including ours, are self-organized.
                </p>
              </div>
            </div>
            <div class="abt-left">
              <div class="test">
                <img
                  class="first_img"
                  src="images\about\about (3).webp"
                  alt=""
                  id="ted-img"
                />
              </div>

              <img
                class="second_img"
                src="images\about\about (1).webp"
                alt="second-image-with-parallax"
              />
            </div>
          </div>
        </div>
        <div class="inner_content">
          <div class="abt-content">
            <div class="abt-right">
              <div class="heading">
                <h3 class="special-heading-title tedxmfis_heading">
                  What is TEDxManaratAlFarouk?
                </h3>
                <p class="description">
                  In the spirit of ideas worth spreading, TED has created a
                  program called TEDx. TEDx is a program of local,
                  self-organized events that bring people together to share a
                  TED-like experience. Our event is called
                  TEDxManaratAlFaroukSchool, where x = independently organized
                  TED event. At our TEDxManaratAlFaroukSchool event, TED Talks
                  video and live speakers will combine to spark deep discussion
                  and connection in a small group. The TED Conference provides
                  general guidance for the TEDx program, but individual TEDx
                  events, including ours, are self-organized.
                </p>
              </div>
            </div>
            <div class="abt-left">
              <div class="test">
                <img
                  class="first_img"
                  src="images\about\about (9).webp"
                  alt=""
                  id="ted-img"
                />
              </div>

              <img
                class="second_img"
                src="images\about\about (2).webp"
                alt="second-image-with-parallax"
              />
            </div>
          </div>
        </div>
      </section>
      <footer>
        <div class="inner_content">
            <div class="footer-container">
                <div class="fc-col1">
                    <img src="images\tedx-logo-white.webp" alt="TEDxManaratAlFarouk logo"
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
                        <a href="https://www.facebook.com/TEDxManaratAlFarouk/" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/tedx.manaratalfaroukschool/" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="https://eg.linkedin.com/company/tedxmanaratalfaroukschool" class="social-link"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="https://www.tiktok.com/@tedxmfis" class="social-link"><i class="fa-brands fa-tiktok"></i></a></li></a>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
      <!-- About Us End -->
      <!-- <div class="cursor"></div>
    <div class="cursor2"></div> -->
      <script src="script.js"></script>
    </div>
  </body>
</html>

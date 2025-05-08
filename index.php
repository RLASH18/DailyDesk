<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyDesk</title>
    <link rel="stylesheet" href="../DailyDesk/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../DailyDesk/assets/css/style.css">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="../DailyDesk/index" class="logo d-flex align-items-center me-auto">
                <h1 class="sitename">DailyDesk</h1>
            </a>

            <nav class="navmenu" id="navmenu">
                <ul>
                    <li><a href="#hero">Home<br></a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Features</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a href="../DailyDesk/auth/login" class="btn-getstarted">Login</a>
        </div>
    </header>

    <main class="main">

        <!--home section-->
        <section class="hero section" id="hero">
            <img src="../DailyDesk/assets/images/dailydesk-bg.jpg" alt="" data-aos="fade-in">

            <div class="container">
                <div class="row justify-content-center" data-aos="zoom-out">
                    <div class="col-xl-7 col-lg-9 text-center">
                        <h1>DailyDesk</h1>
                        <p>Your all-in-one space to organize tasks, journal thoughts, track budgets, and stay in control of your day.</p>
                    </div>
                </div>

                <div class="text-center" data-aos="zoom-out" data-aos-delay="100">
                    <a href="../DailyDesk/auth/register" class="btn-get-started">Get Started</a>
                </div>

                <div class="row gy-4 mt-5">
                    <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-check2-square"></i></div>
                            <h4 class="title"><a href="">Stay Productive</a></h4>
                            <p class="description">Keep track of your tasks and get things done with an intuitive to-do list.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-journal-text"></i></div>
                            <h4 class="title"><a href="">Capture Your Thoughts</a></h4>
                            <p class="description">Write down your ideas, reflections, and daily experiences in your personal journal.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-piggy-bank"></i></div>
                            <h4 class="title"><a href="">Manage Finances</a></h4>
                            <p class="description">Track your expenses and budgets to take control of your financial well-being.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3" data-aos="zoom-out" data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-person-circle"></i></div>
                            <h4 class="title"><a href="">Personalize Your Space</a></h4>
                            <p class="description">Customize your profile and settings to make DailyDesk truly yours.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--about section-->
        <section id="about" class="about section">

            <div class="container section-title" data-aos="fade-up">
                <h2>About<br></h2>
                <p>Helping you stay organized, productive, and in control—one task at a time.</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <p>
                            DailyDesk is designed to simplify your daily life. Whether you're managing tasks, writing notes, or tracking expenses, we bring everything together in one easy-to-use platform.
                        </p>
                        <ul>
                            <li><i class="bi bi-check2-circle"></i> <span>Plan your day effortlessly with an intuitive to-do list.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Capture thoughts, reflections, and ideas in a personal journal.</span></li>
                            <li><i class="bi bi-check2-circle"></i> <span>Track your finances and stay in control of your budget.</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <p>
                            At DailyDesk, we believe productivity should be simple and stress-free. Our platform is built with a user-friendly interface, ensuring you spend less time organizing and more time focusing on what matters.
                        </p>
                        <a href="#" class="read-more"><span>Learn More</span><i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- services Section -->
        <section id="services" class="services section light-background">

            <div class="container section-title" data-aos="fade-up">
                <h2>Features</h2>
                <p>Daily Desk is your all-in-one personal productivity hub, designed to help you stay organized and efficient.</p>
            </div>

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item item-cyan position-relative">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                                </svg>
                                <i class="bi bi-list-check"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>To-Do List</h3>
                            </a>
                            <p>Stay on top of your tasks with an easy-to-use to-do list, ensuring you never miss a deadline.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item item-orange position-relative">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                                </svg>
                                <i class="bi bi-journal"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Journal Notes</h3>
                            </a>
                            <p>Capture your thoughts, ideas, and daily reflections in a structured digital journal.</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item item-teal position-relative">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
                                </svg>
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <a href="#" class="stretched-link">
                                <h3>Budget Tracker</h3>
                            </a>
                            <p>Manage your expenses and track your budget efficiently to stay financially organized.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- team Section -->
        <section id="team" class="team section light-background">

            <div class="container section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>This are the developers/engineer that made this web for you.</p>
            </div>

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="../DailyDesk/assets/images/team-1.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href="https://www.facebook.com/LeBron"><i class="bi bi-facebook"></i></a>
                                    <a href="https://www.instagram.com/kingjames"><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Lebron James</h4>
                                <span>The Kambing</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="../DailyDesk/assets/images/team-2.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Ryan Lester I</h4>
                                <span>Frontend Developer</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="../DailyDesk/assets/images/team-3.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Ryan Lester II</h4>
                                <span>Backend Developer</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
                        <div class="team-member">
                            <div class="member-img">
                                <img src="../DailyDesk/assets/images/team-4.jpg" class="img-fluid" alt="">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href="https://www.facebook.com/JhayLacdang18"><i class="bi bi-facebook"></i></a>
                                    <a href="https://www.instagram.com/ryanlester_18"><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>Ryan Lester Original</h4>
                                <span>Junior Web Developer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>Get in touch with us for any inquiries, feedback, or support regarding your Daily Desk experience.</p>
            </div>

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
                    <iframe
                        style="border:0; width: 100%; height: 270px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1010.9578383017998!2d121.09199009172755!3d14.70000660737208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397bbf5a9da7c53%3A0xd88d551303fa64c6!2sEverlasting%20open%20court!5e1!3m2!1sen!2sph!4v1744952170692!5m2!1sen!2sph" 
                        frameborder="0"
                        allowfullscreen
                        loading="lazy">
                    </iframe>
                </div>

                <div class="row gy-4">

                    <div class="col-lg-4">
                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h3>Address</h3>
                                <p>Litex po, studyante</p>
                            </div>
                        </div>

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-telephone flex-shrink-0"></i>
                            <div>
                                <h3>Call Us</h3>
                                <p>0920 ikaw nang bahala sa pito</p>
                            </div>
                        </div>

                        <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h3>Email Us</h3>
                                <p>CtrlAltDelMyLife@gmail.com</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">

                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="error-message"></div>
                                    <button type="submit">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer light-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">DailyDesk</span>
                    </a>
                    <p>Stay on top of your tasks, track your budget, and organize your notes effortlessly with DailyDesk. Your all-in-one personal productivity hub designed to keep you focused and efficient.</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Features</h4>
                    <ul>
                        <li><a href="#">To-Do List</a></li>
                        <li><a href="#">Journal Notes</a></li>
                        <li><a href="#">Budget Tracker</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>AICS Bldg., Commonwealth Ave., Holy Spirit</p>
                    <p>Drive, Brgy Don Antonio Dr, Quezon City</p>
                    <p>Philippines</p>
                    <p class="mt-4"><strong>Phone:</strong> <span>0920 ikaw nang bahala sa pito</span></p>
                    <p><strong>Email:</strong> <span>CtrlAltDelMyLife@gmail.com</span></p>
                </div>
            </div>
        </div>

        <div class="container-fluid copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">DailyDesk</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="#team">Group ni Lebron</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="../DailyDesk/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../DailyDesk/assets/js/script.js"></script>
</body>
</html>
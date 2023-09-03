<?php

    session_start();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnyPy</title>

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="../style/style.css">

    <!-- IconScout CDN -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Google Font Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--------------------------------------- Navigation Bar ------------------------------------->
    <?php include 'header.php';?>
    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>

    <!----------------------------------------- hero section -------------------------------------->
    <section class="hero-section_1">
        <div class="content_1">
            <h2>Grow your <span style="color: #fe8171;">skills</span> to advance <br> your career path.</h2>
            <p>LearnyPy is an online eduction platfrom</p><br>
            <div class="buttons_1">
                <a href="./signup.html" class="get-started-button_1">Get Started</a>
                <a href="./courses.html" class="browse-courses-button_1">Browse Courses</a>
            </div>
        </div>
        <div class="image-container_1">
            <img src="../images/banar1.jpg" alt="Image">
        </div>
    </section>

    <!--------------------------------------- Feature ----------------------------------->
    <section class="feature-section_1">
        <h2>Explore Our Categories</h2>
        <div class="row_1">
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    <!-- <i class="fas fa-code"></i> -->
                    <i class="fa-brands fa-free-code-camp"></i>
                    <h3>Programming</h3>
                    <small>7 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    <!-- <i class="fas fa-cogs"></i> -->
                    <i class="fa-brands fa-html5"></i>
                    <h3>Development</h3>
                    <small>2 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    <!-- <i class="fas fa-chart-bar"></i> -->
                    <!-- <i class="fa-solid fa-chart-pie"></i> -->
                    <i class="fa-solid fa-atom"></i>
                    <h3>Data Science</h3>
                    <small>4 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    <!-- <i class="fas fa-camera"></i> -->
                    <i class="fa-solid fa-camera-retro"></i>
                    <h3>Photography</h3>
                    <small>3 Courses</small>
                </a>
            </div>
        </div>
        <div class="row_1">
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    <!-- <i class="fas fa-network-wired"></i> -->
                    <i class="fa-solid fa-diagram-project"></i>
                    <h3>Networking</h3>
                    <small>1 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    <!-- <i class="fas fa-paint-brush"></i> -->
                    <i class="fa-solid fa-palette"></i>
                    <h3>Art & Design</h3>
                    <small>2 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    <!-- <i class="fas fa-pen-square"></i> -->
                    <i class="fa-brands fa-uikit"></i>
                    <h3>UX/UI Design</h3>
                    <small>4 Courses</small>
                </a>
            </div>
            <div class="feature-box_1">
                <a href="./category-posts.html">
                    <!-- <i class="fas fa-money-bill-alt"></i> -->
                    <i class="fa-solid fa-sack-dollar"></i>
                    <h3>Finance</h3>
                    <small>1 Courses</small>
                </a>
            </div>
        </div>
    </section>


    <!--------------------------------------- Start Category ----------------------------------->
    <!-- <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="./category-posts.html" class="category__button">Programming</a>
            <a href="./category-posts.html" class="category__button">Development</a>
            <a href="./category-posts.html" class="category__button">Data Science</a>
            <a href="./category-posts.html" class="category__button">Photography</a>
            <a href="./category-posts.html" class="category__button">Networking</a>
            <a href="./category-posts.html" class="category__button">Art & Design</a>
            <a href="./category-posts.html" class="category__button">Sale & Marketing</a>
            <a href="./category-posts.html" class="category__button">UX/UI Design</a>
        </div>
    </section> -->
    <!--------------------------------------- End Category ----------------------------------->

    <!--------------------------------------- Start Footer ----------------------------------->
    <footer>
        <div class="footer__socials">
            <a href="https://www.linkedin.com/in/fahad-bd/" target="_blank"><i class="uil uil-linkedin"></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class="uil uil-youtube"></i></a>
            <a href="https://www.facebook.com/fahadahammedbd" target="_blank"><i class="uil uil-facebook"></i></a>
            <a href="https://twitter.com/fahadbd01" target="_blank"><i class="uil uil-twitter"></i></a>
            <a href="https://www.instagram.com/fahadahammedbd/" target="_blank"><i
                    class="uil uil-instagram-alt"></i></a>
        </div>
        <div class="container footer__container">
            <article style="margin-right: 50px;">
                <img src="../images/logo1.png" alt="">
                <small>Join LearnyPy, the ultimate online learning platform! Explore a vast range of courses, gain new
                    skills, and unlock your potential from anywhere, at any time.</small>
                <!-- <h4>xyz</h4> -->
                <!-- <ul>
                    <li><a href="">a</a></li>
                    <li><a href="">a</a></li>
                    <li><a href="">a</a></li>
                    <li><a href="">a</a></li>
                    <li><a href="">a</a></li>
                </ul> -->
            </article>

            <article>
                <h4>Important Link</h4>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">Courses</a></li>
                    <li><a href="">Instructors</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Signin</a></li>
                </ul>
            </article>

            <article>
                <h4>Contact</h4>
                <ul>
                    <li><a href="">Call Numbers</a></li>
                    <li><a href="">Email</a></li>
                    <li><a href="">Facebook</a></li>
                    <li><a href="">Twitter</a></li>
                    <li><a href="">LinkedIn</a></li>
                </ul>
            </article>

            <article>
                <h4>Permalinks</h4>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">East West University</a></li>
                    <li><a href="">Bangladesh Govt</a></li>
                    <li><a href="">Ministry of Education</a></li>
                    <li><a href="">Police</a></li>
                </ul>
            </article>
        </div>
        <div class="footer__copyright">
            <small>Copyright &copy; 2024 <span style="color: orange;">Learny</span>Py</small>
        </div>
    </footer>
    <!--------------------------------------- End Footer ----------------------------------->


    <!-------------------------------------- Custom Js File -------------------------------------->
    <script src="js/main.js"></script>

    <!-------------------------------------- Font Awesome ---------------------------------------->
    <script src="https://kit.fontawesome.com/924def979f.js" crossorigin="anonymous"></script>

</body>

</html>
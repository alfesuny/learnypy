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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ca603e05a0.js" crossorigin="anonymous"></script>
</head>
<body>
    <!--------------------------------------- Navigation Bar ------------------------------------->
    <?php include 'header.php';?>
    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>

    <!----------------------------------------- Start Single Course Body --------------------------------------->
    <br>
    <section class="posts">
        <!-------------------------------------------- Video  ------------------------------------->
        <h2 style="margin-left: 50px;">Video</h2>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray; margin: 20px; margin-left: 40px;">
        <div class="container posts__container">
            <article class="post">
                <div>
                    <video height="200" width="300" controls style="border: 1px solid gray;">
                        <source src="../video/This is MIT.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./singleVideo.html">Lecture 1</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero tempore quasi, numquam voluptatem unde facere?
                    </p>
                </div>
            </article>


            <article class="post">
                <div>
                    <video height="200" width="300" controls style="border: 1px solid gray;">
                        <source src="../video/This is MIT.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./singleVideo.html">Lecture 2</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero tempore quasi, numquam voluptatem unde facere?
                    </p>
                </div>
            </article>


            <article class="post">
                <div>
                    <video height="200" width="300" controls style="border: 1px solid gray;">
                        <source src="../video/This is MIT.mp4" type="video/mp4">
                    </video>
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./singleVideo.html">Lecture 3</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero tempore quasi, numquam voluptatem unde facere?
                    </p>
                </div>
            </article>
            
            
        </div>


        <!------------------------------------- Pdf ---------------------------------------->
        <h2 style="margin-left: 50px;">PDF</h2>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray; margin: 20px; margin-left: 40px;">


        <div class="container posts__container">
            <article class="post">
                <div class="post__thumbnail">
                    <object data="../pdf/One Piece, Volume 2.pdf" type="application/pdf" width="100%" height="300px">
                        <p>Unable to display PDF file. <a href="../pdf/One Piece, Volume 2.pdf">Download</a> instead.</p>
                    </object>
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./singlePdf.html">One Piece</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero tempore quasi, numquam voluptatem unde facere? Impedit unde dolores nulla mollitia! Inventore, ipsa distinctio?
                    </p>
                </div>
            </article>


            <article class="post">
                <div class="post__thumbnail">
                    <object data="../pdf/One Piece, Volume 2.pdf" type="application/pdf" width="100%" height="300px">
                        <p>Unable to display PDF file. <a href="../pdf/One Piece, Volume 2.pdf">Download</a> instead.</p>
                    </object>
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./singlePdf.html">One Piece</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero tempore quasi, numquam voluptatem unde facere? Impedit unde dolores nulla mollitia! Inventore, ipsa distinctio?
                    </p>
                </div>
            </article>


            <article class="post">
                <div class="post__thumbnail">
                    <object data="../pdf/One Piece, Volume 2.pdf" type="application/pdf" width="100%" height="300px">
                        <p>Unable to display PDF file. <a href="../pdf/One Piece, Volume 2.pdf">Download</a> instead.</p>
                    </object>
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./singlePdf.html">One Piece</a>
                    </h3>
                    <p class="post__body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero tempore quasi, numquam voluptatem unde facere? Impedit unde dolores nulla mollitia! Inventore, ipsa distinctio?
                    </p>
                </div>
            </article>
        </div>


        <!------------------------------------- Quiz ---------------------------------------->
        <h2 style="margin-left: 50px;">Quize</h2>
        <hr style="height:2px;border-width:0;color:gray;background-color:gray; margin: 20px; margin-left: 40px;">

        <div class="container posts__container">
            <article class="post">
                <!-- <div class="post__thumbnail">
                    <img src="images/pic/blog2.jpg" alt="">
                </div> -->
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./singleQuize.html">Quiz 1</a>
                    </h3>
                    <p class="post__body">
                        About: Variable and Data types.
                    </p>
                </div>
            </article>
        </div>


        
    </section>
    <!--------------------------------------- End Course Body ----------------------------------->


    <!--------------------------------------- Start Category ----------------------------------->
    <section class="category__buttons">
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
    </section>
    <!--------------------------------------- End Category ----------------------------------->

    <!--------------------------------------- Start Footer ----------------------------------->
    <footer>
        <div class="footer__socials">
            <a href="https://www.linkedin.com/in/fahad-bd/" target="_blank"><i class="uil uil-linkedin"></i></a>
            <a href="https://www.youtube.com/" target="_blank"><i class="uil uil-youtube"></i></a>
            <a href="https://www.facebook.com/fahadahammedbd" target="_blank"><i class="uil uil-facebook"></i></a>
            <a href="https://twitter.com/fahadbd01" target="_blank"><i class="uil uil-twitter"></i></a>
            <a href="https://www.instagram.com/fahadahammedbd/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
        </div>
        <div class="container footer__container">
            <article style="margin-right: 50px;">
                <img src="../images/logo1.png" alt="">
                <small>Join LearnyPy, the ultimate online learning platform! Explore a vast range of courses, gain new skills, and unlock your potential from anywhere, at any time.</small>
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
            <small>Copyright &copy; 2024 LearnyPy</small>
        </div>
    </footer>
    <!--------------------------------------- End Footer ----------------------------------->


    <!-------------------------------------- Custom Js File -------------------------------------->
    <script src="js/main.js"></script>

</body>
</html>
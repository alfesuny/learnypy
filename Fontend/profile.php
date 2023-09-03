<?php

    session_start();

    if ( !isset($_SESSION['active_status'])  ) {
        header("Location: ./index.php");
        exit();
    }

    $image_should = null;
    if($_SESSION['user_type']=='instructor'){
        $image_should = $_SESSION['user_name'];
    }
    elseif($_SESSION['user_type'] == 'student'){
        $image_should =  $_SESSION['email'];
    }
    else{
        $image_should = "admin";
    }

    $image_name = '';

    $dirPath = '../pic/'.$_SESSION['user_type'];

    $files = scandir($dirPath);  
    foreach ($files as $file) {
        $filePath = $dirPath . '/' . $file;
        // echo $filePath;
        // echo $file;
        if (is_file($filePath)) {
            $name= explode('.',$file);
            if( $name[0] == $image_should ){
                $image_name = $file ;
                break;
            }
            if($_SESSION['user_type'] == 'student' ){
                $first_part = explode('.',$image_should);
                if($name[0] == $first_part[0]){
                    $image_name = $file ;
                    break;
                }
            }
        }
    }

   // exit();


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
    <!----------------------------------------- Start Single Instructor Body --------------------------------------->
    <section class="singlepost">
        <div class="container singleInstructor__container">
            
    
            <div>
                <h2>Welecome  <?php echo $_SESSION['user_name']; ?>    
                </h2><br>
                <!-- <small>Instructor</small> -->
            </div>

            <div class="singInstructor__thumbnail">
                <img style="border-radius: 50%; width : 8cm" class="singlepost__thumbnail_img" src="../pic/<?php echo $_SESSION['user_type']; ?>/<?php echo  $image_name ?>" alt="">
            </div>
            <div>
           
            <?php
                    echo $_SESSION['user_type'];
            ?>

            <table class="table custom-table">
                <tr>
                    <td><i class="uil uil-user-circle"></i> Designation</td>
                    <td> <?php echo $_SESSION['user_type']; ?> </td>
                </tr>
                <tr>
                    <td><i class="uil uil-user"></i> Name</td>
                    <td>Alfe Suny</td>
                </tr>
            </table>

            <style>
                .custom-table {
                    border: 1px solid white;
                }
                
                .custom-table td {
                    border: 1px solid white;
                    padding: 10px; /* Optional: Add padding to cells */
                    font-size: 18px; /* Optional: Adjust font size */
                }
            </style>

            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <h2 style="margin-left: 50px;">Courses</h2>
            <hr style="height:2px;border-width:0;color:gray;background-color:gray; margin: 20px; margin-left: 40px;">

            <!-- <article class="post">
                <div class="post__thumbnail">
                    <img src="../images/blog17.jpg" alt="">
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./course.html">Structure Programming</a>
                    </h3>
                </div>
            </article> -->
        

        <div class="singleInstructor__courses">
            <div class="singleInstructor__courses_div">
                <div class="">
                    <img class="singleInstructor__courses_thumbnail" src="../images/blog17.jpg" alt="">
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./course.html">Structure Programming</a>
                    </h3>
                </div>
            </div>


            <div class="singleInstructor__courses_div">
                <div class="">
                    <img class="singleInstructor__courses_thumbnail" src="../images/blog17.jpg" alt="">
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./course.html">Structure Programming</a>
                    </h3>
                </div>
            </div>


            <div class="singleInstructor__courses_div">
                <div class="">
                    <img class="singleInstructor__courses_thumbnail" src="../images/blog17.jpg" alt="">
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./course.html">Structure Programming</a>
                    </h3>
                </div>
            </div>


            <div class="singleInstructor__courses_div">
                <div class="">
                    <img class="singleInstructor__courses_thumbnail" src="../images/blog17.jpg" alt="">
                </div>
                <div class="post__info">
                    <h3 class="post__title">
                        <a href="./course.html">Structure Programming</a>
                    </h3>
                </div>
            </div>


        </div></div>

    </section>
    <!--------------------------------------- End Single Instructor Body ----------------------------------->

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
            <small>Copyright &copy; 2024 LearnyPy</small>
        </div>
    </footer>
    <!--------------------------------------- End Footer ----------------------------------->


    <!-------------------------------------- Custom Js File -------------------------------------->
    <script src="js/main.js"></script>

    <!-------------------------------------- Font Awesome ---------------------------------------->
    <script src="https://kit.fontawesome.com/924def979f.js" crossorigin="anonymous"></script>

</body>

</html>
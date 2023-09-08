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
    <?php include 'header.php' ?>
    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>
    <!----------------------------------------- Start Single Instructor Body --------------------------------------->

    <section class="singlepost">
        <div class="container singleInstructor__container">

        <?php
                $user_name = $_GET['user_name'];
                

                $link = mysqli_connect("localhost", "root", "", "learnypy");

                // Check connection
                if(!$link){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                $query = "SELECT * FROM instructor_info WHERE instructor_username ='$user_name'";

                $result = mysqli_query($link, $query);

                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        
                        // Output data for each row
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo '   
                            <div class="instructor__single">
                                <div>
                                    
                                    <a href="./singleInstructor.php?user_name='.$row['instructor_username'].'">
                                    <img src="../pic/instructor/'.$row['instructor_username'].'.jpg" alt="Image Failed to Load">
                                    </a>
                                </div>
                                <div class="instructor__name">
                                    <h3>
                                        <a href="./singleInstructor.html">'.$row['instructor_fname']. '  '.$row['instructor_lname'].'</a>
                                    </h3>
                                    <small>Instructor</small>
                                </div>
                            </div>
                            ';
                        
                        }
                    }
                }
                mysqli_close($link);

            ?>
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
        
        <section class="posts">
        <div class="container courses__container__grid">

            <?php
                 $user_name = $_GET['user_name'];
                // Establish a database connection
                $link = mysqli_connect("localhost", "root", "", "learnypy") or die("ERROR: Could not connect. " . mysqli_connect_error());
            
                // Check if the database connection is successful
                if ($link) {
                    // Perform the JOIN query
                   $query = "SELECT i.instructor_fname, i.instructor_lname, c.course_name, c.course_category, c.course_description, i.instructor_username
                    FROM instructor_info i
                    INNER JOIN course c
                    ON i.instructor_username = c.course_instructor
                    WHERE i.instructor_username = '" .$user_name . "'";
          
            
                    $result = mysqli_query($link, $query);
            
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            // Output data for each row
                            while ($row = mysqli_fetch_assoc($result)) {


                                echo '
                                <div class="course__container_in_corses">
                                <div>
                                    <img class="course__container_in_corses_banar" src="../images/blog39.jpg" alt="">
                                </div>
                                <div>
                                    <div>
                                        <div style="margin-bottom: 5px; margin-top: 5px;">
                                           
                                        </div>
                                        <h4 style="margin-top: 5px; margin-bottom: 5px;"><a href="./course.html">'. $row['course_name'] . '</a></h4>
                
                                        <div style="margin-bottom: 5px; margin-top: 5px;">
                                            <i class="fa-regular fa-circle-user"></i> <small>Enroll 23</small>
                                            <i class="fa-regular fa-file-lines"></i> <small>12 Lesson</small>
                                            
                                        </div>
                
                                        <hr
                                            style="height:1px;border-width:0;color:rgb(175, 175, 175);background-color:rgb(200, 200, 200);">
                
                                    </div>
                
                                    <div style="margin-top: 15px;" class="courses__instructor">
                                        <div class="courses__author_profile_pic">
                                            <img src="../pic/instructor/'.$row['instructor_username'].'.jpg" alt="">
                                            <a href="./singleInstructor.html">
                                                <h5 style="margin-left: 15px;">'. $row['instructor_lname'].'</h5>
                                            </a>
                                        </div>
                                       
                                       
                                    </div>
                
                                </div>
                            </div>
                                
                                
                                ';
                               
                            }
                        } else {
                            echo "No matching records found.";
                        }
                    } else {
                        echo "Error: " . mysqli_error($link);
                    }
            
                    // Close the database connection
                    mysqli_close($link);
                } else {
                    echo "Failed to connect to the database.";
                }
                


            ?>



        
           


   





          

            


        </div>
    </section>
    <br>

        <!-- <div class="singleInstructor__courses">
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


        </div></div> -->

    </section>
    <!--------------------------------------- End Single Instructor Body ----------------------------------->

    <!--------------------------------------- Start Category ----------------------------------->
  
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
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="./courses.php">Courses</a></li>
                    <li><a href="./instructors.php">Instructors</a></li>
                   
                    <li><a href="./signin.php">Signin</a></li>
                </ul>
            </article>

            <article>
                <h4>Contact</h4>
                <ul>
               
                    <li><a href="https://www.facebook.com">Facebook</a></li>
                    <li><a href="https://www.twitter.com">Twitter</a></li>
                    <li><a href="https://www.linkedin.com">LinkedIn</a></li>
                </ul>
            </article>

            <article>
                <h4>Permalinks</h4>
                <ul>
                    <li><a href="./index.php">Home</a></li>
                    <li><a href="https://www.ewubd.edu/">East West University</a></li>
                    <li><a href="https://bangladesh.gov.bd/index.php">Bangladesh Govt</a></li>
                    <li><a href="https://moedu.gov.bd/">Ministry of Education</a></li>
                    <li><a href="https://www.police.gov.bd/">Police</a></li>
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
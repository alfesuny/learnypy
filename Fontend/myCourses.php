<?php

    session_start();
    if ( !isset($_SESSION['active_status']) ) {
        header("Location: ./index.php");
        exit();
    }
    if( $_SESSION['user_type'] != "instructor"){
        header("Location: ./index.php");
        exit();
    }

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
    <br><br>
    <section>
        <div class="container instructor__top">
            <div style="margin-left: 30px; ">
                <h2>Your Courses !</h2>
            </div>
            <div style="margin: 10px;">
                <img class="instructor__top_banar" src="../images/courses_banar.gif" alt="">
            </div>
        </div>
    </section>



    <!--------------------------------------- Start Course ----------------------------------->
    <section class="posts">
        <div class="container courses__container__grid">

            <?php
                
                // Establish a database connection
                $link = mysqli_connect("localhost", "root", "", "learnypy") or die("ERROR: Could not connect. " . mysqli_connect_error());
            
                // Check if the database connection is successful
                if ($link) {
                    // Perform the JOIN query
                   $query = "SELECT i.instructor_fname, i.instructor_lname, c.course_name, c.course_category, c.course_description, i.instructor_username
                    FROM instructor_info i
                    INNER JOIN course c
                    ON i.instructor_username = c.course_instructor
                    WHERE i.instructor_username = '" . $_SESSION["user_name"] . "'";
          
            
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
                                        <div>
                                        
                                        <button class="btn__enrole" type="submit"><a href="classroom.php?course_name='. $row['course_name'] . '&course_category='. $row['course_category'] . '&instructor_username='. $_SESSION["user_name"] . '"> Enter  </a> </button> 
                                    
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

    <!--------------------------------------- End Course --------------------------------------->

    <!--------------------------------------- Feedback from students ----------------------------------->

    <br>

    <!--------------------------------------- Start Category ----------------------------------->
    <!-- <section class="category__buttons">
        <div class="container category__buttons-container">
            <a href="" class="category__button">Programming</a>
            <a href="" class="category__button">Development</a>
            <a href="" class="category__button">Data Science</a>
            <a href="" class="category__button">Photography</a>
            <a href="" class="category__button">Networking</a>
            <a href="" class="category__button">Art & Design</a>
            <a href="" class="category__button">Sale & Marketing</a>
            <a href="" class="category__button">UX/UI Design</a>
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
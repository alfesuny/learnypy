<?php
    session_start();
// ... Database connection code here ...
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "learnypy";

    // Create a database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check the connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
     }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        
            
            $selectedOption = $_POST["course_info"];
            
            $courseName;
            $courseInstructor;
            $courseCategory;

            $exploded = explode("-", $selectedOption);
            
        
            list($courseName, $courseInstructor , $courseCategory) = $exploded;
            // echo "course_name: ". $courseName ."<br>";
            // echo "course_instructor: " .$courseInstructor ."<br>";
            // echo "course_category: " .$courseCategory ."<br>";
            
            
            $course_review = $_POST['course_review'];
            $course_star = $_POST['course_star'];
            $email = $_SESSION['email'];

            $sql = "UPDATE student_course SET course_review_bool='true',
            course_review_star='$course_star',course_review='$course_review' 
            WHERE course_category = '$courseCategory' AND course_name = '$courseName' AND
            course_instructor='$courseInstructor' AND student_email = '$email'";
                   
            mysqli_query($conn, $sql);
           

    }


        // ... HTML form for editing the course ...
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

    <!-- Course update  -->
    <section class="form__section">
        <section class="form__section">
            <div class="container form__section-container">
                <h2>Course Review</h2>
            
                <form action="course_evaluation.php" method="POST" enctype="multipart/form-data">
                    
                    Select Your Enrolled Course
                    <select name="course_info" id="course_info">

                <?php

                        $link = mysqli_connect("localhost", "root", "", "learnypy");



                        // Check connection
                        if (!$link) {
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }

                        $email =  $_SESSION['email'];
                        $query = "SELECT * FROM student_course WHERE course_review_bool = 'false' AND student_email  = '$email' ";

                        $result = mysqli_query($link, $query);
                        
                        if ($result) {
                            if (mysqli_num_rows($result) > 0) {
                               
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="'.$row['course_name'].'-'.$row['course_instructor'].'-'.$row['course_category'].'">'.'Course Name:'.$row['course_name'].' | Course Category:'.$row['course_instructor'].'</option>' ;
                                }
                            }
                            else{
                                
                            }
                        }
                        mysqli_close($link);


                ?>

                    </select>

                    <label for="course_star">How Many Stars do you want to Give ? (out of Five) </label>
                    <input type="text" name="course_star" id="course_star">

                    <label for="course_review">Write a Review About the Course ! </label>
                    <input type="text" name="course_review" id="course_review">
              
                <?php
                    if (mysqli_num_rows($result) > 0){
                        
                        echo '<button class="btn" type="submit">Submit Review</button>';
                        
                    }
                    else{
                       echo ' <p>"Sorry You have no courses to Leave a review"</p> ';
                    }

                ?>

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
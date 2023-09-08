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
    
    
     <!---------checkliza---->
   
     <!---end check liza--->

    <section>
    <?php

        $course_name =  $_GET['course_name'];
        $intructor_name = $_GET['instructor_username'];
        $course_category = $_GET['course_category'];

        // echo $course_category;
        // echo $course_name;
        // echo $intructor_name;

        

            $link = mysqli_connect("localhost", "root", "", "learnypy");

            // Check connection
            if (!$link) {
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }
            
            $query = "SELECT DISTINCT course_material_type FROM course_material WHERE course_name = '$course_name' AND course_instructor = '$intructor_name' AND course_category = '$course_category' ";
            
            $result = mysqli_query($link, $query);
            
            $courseMaterialTypes = array(); // Initialize an empty array to store the unique course_material_types
            
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    // Output data for each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Store the course_material_type in the array
                        $courseMaterialTypes[] = $row['course_material_type'];
                    }
                }
            }
            
        echo '<section class="posts">';
            foreach($courseMaterialTypes as $type){

                $query = "SELECT * FROM course_material WHERE course_name = '$course_name' AND 
                    course_instructor = '$intructor_name' AND course_category = '$course_category'
                    AND  course_material_type = '$type' ";
                
                $result = mysqli_query($link, $query);
                if ($result) {
                    echo "<h2 style='margin-left: 50px;'>". strtoupper($type) ."</h2>";
                    echo '<hr style="height:2px;border-width:0;color:gray;background-color:gray; margin: 20px; margin-left: 40px;">';
                    echo '<div class="container posts__container">';
                    
                    if (mysqli_num_rows($result) > 0) {
                        // Output data for each row
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            $folder_name= $course_name."-".$course_category."-".$intructor_name;
                            $media_type = " ";
                            if($type == 'jpg'){
                                $media_type = 'image/png';
                            
                            }
                            if($type == 'png'){
                                $media_type = 'image/jpg';
                            
                            }
                            if($type == 'pdf'){
                                $media_type = 'application/pdf';
                            
                            }
                            
                            if($type == 'mp4'){
                                $media_type = 'video/mp4';
                            
                            }

                            if ($type == 'quiz') {
                                $quizUrl = "./quizq.php" .
                                    "?course_name=" . urlencode($row['course_name']) .
                                    "&course_category=" . urlencode($row['course_category']) .
                                    "&course_instructor=" . urlencode($intructor_name);
                            
                                if ($_SESSION['user_type'] != "instructor") {
                                    echo '
                                    <article class="post">
                                        <div>
                                            <a href="' . $quizUrl . '" style="background-color: navy; cursor: pointer; text-decoration: none; padding: 10px 20px; border-radius: 5px;">
                                                <button style="background-color: navy; cursor: pointer; color: white; font-weight: bold;">Attend Quiz</button>
                                            </a>
                                        </div>
                                    </article>';
                                    break;
                                } elseif ($_SESSION['user_type'] == "instructor") {
                                    echo '
                                    <article class="post">
                                        <div>
                                            <a href="' . $quizUrl . '" style="background-color: navy; cursor: pointer; text-decoration: none; padding: 10px 20px; border-radius: 5px;">
                                                <button style="background-color: navy; cursor: pointer; color: white; font-weight: bold;">Manage Quiz</button>
                                            </a>
                                        </div>
                                    </article>';
                                    break;
                                }
                            }
                            

                            if($type != 'quiz'){
                                
                                echo '
                                <article class="post">
                                <div class="post__thumbnail">
                                    <object data="../course_material/'.$folder_name.'/'.$row['course_material_name'].'" type="'.$media_type.'" width="100%" height="300px">
                                        <p>Unable to display file. <a href="../course_material/'.$folder_name.'/'.$row['course_material_name'].'.'.$type.'">Download</a> instead.</p>
                                    </object>
                                </div>
                                <div class="post__info">
                                    <h3 class="post__title">
                                        <a href="../course_material/'.$folder_name.'/'.$row['course_material_name'].'" >'.$row['course_material_name'].'</a>
                                    </h3>
                                    <p class="post__body">
                                        '.$row['course_material_description'].'
                                    </p>
                                </div>
                            </article>
                                
                                
                                ';
                            }

                        }
                    }
                    echo "</div>";
                }
                

            }
        echo '</section>';


    ?>

    
    </section>
   









    










    <!--------------------------------------- End Course Body ----------------------------------->




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

</body>
</html>
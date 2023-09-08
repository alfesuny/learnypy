<?php



    session_start();

    

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "learnypy";

    $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $email = $_SESSION['email'];
        $course_name = $_POST['course_name'];
        $course_category = $_POST['course_category'];
        $course_instructor = $_POST['course_instructor'];
        $query = "INSERT INTO student_course (student_email,course_name,course_category,course_instructor) VALUES
            ('$email','$course_name','$course_category','$course_instructor')";
            
        

        echo "Email:" . $email . "<br>";
        echo "CourseName:" . $course_name . "<br>";
        echo "Course_category:" . $course_category . "<br>";
       


        $result = mysqli_query($conn, $query);
        if($result){
        echo "Course added Succesfully";
        }
        
    }
       












    $query = "SELECT * FROM student_course WHERE course_review_bool != 'false' ";
    $result = mysqli_query($conn, $query);
    $dataArray = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dataArray[] = $row;
        }
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
            <div style="margin-left: 30px;">
                <h2>Courses</h2>
            </div>
            <div style="margin: 10px;">
                <img class="instructor__top_banar" src="../images/courses_banar.gif" alt="">
            </div>
        </div>
    </section>

    <section class="posts">
        <div class="courses__full_title">
            <br>
            <h2>Explore Our Courses</h2>
        </div>


        <div>
            <div class="courses__category__button">
                <!-- <button style="background-color: white; color: black;" class="btn">All Courses</button>
                <button class="btn">Programming</button>
                <button class="btn">Development</button>
                <button class="btn">Data Science</button>
                <button class="btn">Design</button>
                <button class="btn">Photography</button>
                <button class="btn">Networking</button>
                <button class="btn">Marketing</button> -->


                <?php
                                                
                       
                        
                        $sql = "SELECT category_name FROM course_category";

                        // Execute the query
                        $result = mysqli_query($conn, $sql);
                        
                        // Check if any rows were returned
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $categoryName = $row["category_name"];
                                echo '<button class="btn" onclick="redirectToCourses(\'' . $row["category_name"] . '\')">' . $row["category_name"] . '</button>';
                            }
                        } else {
                            echo "No categories found.";
                        }
                        
                    ?>
            </div>
        </div>
    </section>

    <script>
        // JavaScript function to send a GET request with category_name
        function redirectToCourses(categoryName) {
            window.location.href = 'courses.php?category_name=' + encodeURIComponent(categoryName);
        }
    </script>









    <!--------------------------------------- Start Course ----------------------------------->
    <section class="posts">
        <div class="container courses__container__grid">

            <?php
                
                // Establish a database connection
                $link = mysqli_connect("localhost", "root", "", "learnypy") or die("ERROR: Could not connect. " . mysqli_connect_error());
            
                // Check if the database connection is successful
                if ($link) {
                    // Perform the JOIN query
                    $query = '';

                    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'student'  && isset($_GET['category_name'])){

                    

                        $email = $_SESSION['email'];
                        $category_name = $_GET['category_name'] ;
                        
                        $query ="SELECT ci.course_name, ci.course_category, ci.course_instructor, ii.instructor_fname, ii.instructor_lname ,ii.instructor_username
                        FROM course ci
                        LEFT JOIN student_course sc 
                        ON ci.course_name = sc.course_name 
                        AND ci.course_category = sc.course_category 
                        AND ci.course_instructor = sc.course_instructor 
                        AND sc.student_email = '$email'
                        LEFT JOIN instructor_info ii
                        ON ci.course_instructor = ii.instructor_username
                        WHERE sc.student_email IS NULL AND  ci.course_category = '$category_name' ";
                    }
                    elseif(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'student'){
                       

                        $email = $_SESSION['email'];

                        $query ="SELECT ci.course_name, ci.course_category, ci.course_instructor, ii.instructor_fname, ii.instructor_lname,ii.instructor_username
                        FROM course ci
                        LEFT JOIN student_course sc 
                        ON ci.course_name = sc.course_name 
                        AND ci.course_category = sc.course_category 
                        AND ci.course_instructor = sc.course_instructor 
                        AND sc.student_email = '$email'
                        LEFT JOIN instructor_info ii
                        ON ci.course_instructor = ii.instructor_username
                        WHERE sc.student_email IS NULL ";
                    }
                    elseif(isset($_GET['category_name']) ){

                        $category_name = $_GET['category_name'] ;
                        $query = "SELECT i.instructor_fname, i.instructor_lname, c.course_name, c.course_category, c.course_description , i.instructor_username
                                    FROM instructor_info i
                                    INNER JOIN course c
                                    ON i.instructor_username = c.course_instructor 
                                    WHERE c.course_category = '$category_name' " ;

                    }
                    else{

                        $query = "SELECT i.instructor_fname, i.instructor_lname, c.course_name, c.course_category, c.course_description , i.instructor_username
                            FROM instructor_info i
                            INNER JOIN course c
                            ON i.instructor_username = c.course_instructor ";

                    }
          
            
                    $result = mysqli_query($link, $query);
            
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            // Output data for each row
                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                <div class="course__container_in_corses">
                                    <div>
                                        <img class="course__container_in_corses_banar" src="../images/blog39.jpg" alt="">
                                    </div>
                                    <div>
                                        <div>
                                            <div style="margin-bottom: 5px; margin-top: 5px"></div>
                                            <h4 style="margin-top: 5px; margin-bottom: 5px;">
                                                <?= $row['course_name'] ?>
                                            </h4>
                                            <div style="margin-bottom: 5px; margin-top: 5px;">
                                                <i class="fa-regular fa-circle-user"></i> <small>Enroll 23</small>
                                                <i class="fa-regular fa-file-lines"></i> <small>12 Lesson</small>
                                            </div>
                                            <hr
                                                style="height:1px;border-width:0;color:rgb(175, 175, 175);background-color:rgb(200, 200, 200);">
                                        </div>
                                        <div style="margin-top: 15px;" class="courses__instructor">
                                            <div class="courses__author_profile_pic">
                                                <img src="../pic/instructor/<?= $row['instructor_username'] ?>.jpg" alt="">
                                                <a href="./singleInstructor.php?user_name=<? echo $row['instructor_username'] ?>">
                                                    
                                                    <h5 style="margin-left: 15px;"><?= $row['instructor_fname'] . ' ' . $row['instructor_lname'] ?></h5>
                                                </a>
                                            </div>
                                            <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'student') { ?>
                                                <div>
                                                    <form method="POST" action="courses.php">
                                                        <input type="hidden" name="course_name" value="<?= $row['course_name'] ?>">
                                                        <input type="hidden" name="course_instructor" value="<?= $row['instructor_username'] ?>">
                                                        <input type="hidden" name="course_category" value="<?= $row['course_category'] ?>">
                                                        <div>
                                                            <button class="btn__enrole" type="submit">Enrole</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>


                        <?php

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
    <section class="posts">
        <div class="courses__full_title">
            <br>
            <h2>Feedback From Students</h2>
        </div>

        <?php
               echo '<div class="container courses__feedback__grid">' ;
                for($i=0 ; $i< sizeof($dataArray) ; $i++){
                    if($i % 3 == 0 && $i!=0){
                        echo '</div>';
                        echo '<div class="container courses__feedback__grid">';
                    }
                    echo '
                        <div class="courses__feedback_container">
                            <div>
                            <h2 style="text-align:center">'.$dataArray[$i]['course_name'].'('. $dataArray[$i]['course_instructor'].')</h2>
                                <div style="margin-top: 15px;" class="courses__instructor">
                                    <div class="courses__author_profile_pic">
                                        <img src="../pic/student/'.$dataArray[$i]['student_email'].'.jpg" alt="">

                                        <div>
                                            <h5 style="margin-left: 10px;">'.$dataArray[$i]['student_email'].'</h5>
                                            
                                        </div>

                                    </div>
                                </div>

                                <div>

                                    <p style="margin: 10px;">
                                        '. $dataArray[$i]['course_review'].'
                                    </p>


                                    <hr
                                        style="height:1px;border-width:0;color:rgb(175, 175, 175);background-color:rgb(200, 200, 200);">

                                    <div style="margin-bottom: 5px; margin-top: 5px;">
                                        <small>'.$dataArray[$i]['course_review_star'].'</small> ' ;
                                       
                                        for($j=1 ; $j<=5 ; $j++){
                                            if( $j<=$dataArray[$i]['course_review_star'])
                                            echo ' <i class="fa-solid fa-star star__golden_color"></i> ';
                                            else{
                                            echo '<i class="fa-solid fa-star"></i>';
                                            }
                                        }
                echo'        
                                    </div>

                                </div>

                            </div>


                        


                        </div>  
                    ';
                }
                echo '</div>';


        ?>

        <!-- <div class="container courses__feedback__grid">

            <div class="courses__feedback_container">
                <div>
                    <div style="margin-top: 15px;" class="courses__instructor">
                        <div class="courses__author_profile_pic">
                            <img src="../images/avatar8.jpg" alt="">

                            <div>
                                <h5 style="margin-left: 10px;">Fahad Ahmad</h5>
                                <h6 style="margin-left: 10px;">Marketing Student</h6>
                            </div>

                        </div>
                    </div>

                    <div>

                        <p style="margin: 10px;">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit porro quibusdam et nisi in. Ea
                            nihil ullam pariatur ut, quos consectetur unde dolores, veniam minima reprehenderit
                            molestias! Dolorum, provident voluptates!
                        </p>


                        <hr
                            style="height:1px;border-width:0;color:rgb(175, 175, 175);background-color:rgb(200, 200, 200);">

                        <div style="margin-bottom: 5px; margin-top: 5px;">
                            <small>4.0</small>
                            <i class="fa-solid fa-star star__golden_color"></i>
                            <i class="fa-solid fa-star star__golden_color"></i>
                            <i class="fa-solid fa-star star__golden_color"></i>
                            <i class="fa-solid fa-star star__golden_color"></i>
                            <i class="fa-solid fa-star"></i>
                            <small>(4.0) Review</small>
                        </div>

                    </div>

                </div>


               


            </div>

        </div> -->
        
    </section>
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
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
    
    

    <section>
    <div class="container instructor__top">
        <div style="margin-left: 30px;">
        <?php
        $link = mysqli_connect("localhost", "root", "", "learnypy");
        if ($_SESSION['user_type'] == "instructor") {

            $course_name = $_GET['course_name'];
            $course_category = $_GET['course_category'];
            $course_instructor = $_GET['course_instructor'];

            $query = "SELECT * FROM quiz_ans WHERE course_name = '$course_name' AND course_category = '$course_category' AND course_instructor = '$course_instructor'";

            $result = mysqli_query($link, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<table >
                        <tr>
                            <th>Student Email</th>
                            <th>Course Name</th>
                            <th>Course Category</th>
                            <th>Course Instructor</th>
                            <th>Quiz Ans</th>
                            <th>Quiz Marks</th>
                            <th>Give Marks</th>
                            <th>Action</th>
                        </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<form action="" method="post" ><tr>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['student_email'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['course_name'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['course_category'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['course_instructor'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['quiz_ans'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['quiz_marks'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">
                                <input style="width:70px;" type="text" name="quiz_marks" value="' . $row['quiz_marks'] . '">
                            </td>
                            <td style="border: 1px solid white; padding: 5px;">
                                <input  type="hidden" name="student_email" value="' . $row['student_email'] . '">
                                <input  type="submit" name="submit_marks" value="Marks">
                            </td>
                        </tr></form>';
                }

                if (isset($_POST['submit_marks'])) {
                    $student_email = $_POST['student_email'];
                    $new_quiz_marks = $_POST['quiz_marks'];
                    $update_query = "UPDATE quiz_ans SET quiz_marks = '$new_quiz_marks' WHERE student_email = '$student_email'";
                    mysqli_query($link, $update_query);
                    // You can add a success message here if needed
                }

                echo '</table>';
            }
        }

        elseif ($_SESSION['user_type'] != "instructor") {
            $student_email = $_SESSION['email'];
            //echo $student_email;
            $course_name = $_GET['course_name'];
            $course_category = $_GET['course_category'];
            $course_instructor = $_GET['course_instructor'];
            
            $query = "SELECT * FROM quiz_ans WHERE course_name = '$course_name' AND course_category = '$course_category' AND course_instructor = '$course_instructor' AND student_email = '$student_email'" ;

            $result = mysqli_query($link, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<table border="1" style="border: 2px solid white; padding: 5px;">
                        <tr>
                            <th>Student Email</th>
                            <th>Course Name</th>
                            <th>Course Category</th>
                            <th>Course Instructor</th>
                            <th>Quiz Ans</th>
                            <th>Quiz Marks</th>
                            
                            
                        </tr>';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<form action="" method="post" ><tr>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['student_email'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['course_name'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['course_category'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['course_instructor'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['quiz_ans'] . '</td>
                            <td style="border: 1px solid white; padding: 5px;">' . $row['quiz_marks'] . '</td>
                           
                            
                        </tr></form>';
                }

               

                echo '</table>';
            }
        }

        ?>
        </div>
    </div>
</section>









   
    

     


    <!--------------------------------------- End Course Body ----------------------------------->


<br>

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
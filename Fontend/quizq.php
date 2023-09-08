<?php
    session_start();

    $link = mysqli_connect("localhost", "root", "", "learnypy");

    if($_SESSION['user_type'] == 'student'){
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $student_email =  $_SESSION['email'];

                $quiz_serial = $_POST['quiz_serial'];
                $quiz_ans =$_POST['quiz_ans'];
                $course_name = $_POST['course_name'];
                $course_category = $_POST['course_category'];
                $course_instructor = $_POST['course_instructor'];
        
                
                
                if (empty($quiz_ans)) {
                    $ansmessage="please ans the question!";
                }
                else{
                        $query = "INSERT INTO quiz_ans (student_email, course_name, course_category, course_instructor, quiz_ans,quiz_serial)
                        VALUES ('$student_email', '$course_name', '$course_category', '$course_instructor', ' $quiz_ans' , '$quiz_serial');
                        ";
                    
                        if($result = mysqli_query($link, $query)){
                            $success="Quiz ans script successfully uploaded";
                            echo $success;
                            header("Location: ./enrolledcourses.php");
                        }
                        else{
                            echo "There's some problem";
                            exit();

                        }
                }
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
            <h2>Quiz</h2>
        </div>
        <div style="margin: 10px;">
            <img class="instructor__top_banar" src="../images/courses_banar.gif" alt="">
        </div>
    </div>
</section>
<br>
<section>
    <?php
        $course_name = $_GET['course_name'];
        $course_category = $_GET['course_category'];
        $course_instructor = $_GET['course_instructor'];
      

        $link = mysqli_connect("localhost", "root", "", "learnypy");

        // Check connection
        if (!$link) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        
        $query = "SELECT * FROM course_quiz WHERE course_name = '$course_name' AND course_category = '$course_category'
            AND course_instructor = '$course_instructor' ";
        
        $result = mysqli_query($link, $query);
        $counter = 1;

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $quizquestion= $row['course_quiz_question'];
                
                echo '<section>
                        <div class="container instructor__top">
                            
                            <div style="margin-left: 30px;">
                               <h3>Question No. ' . $counter . '</h3>
                                <p>' . $row['course_quiz_question'] . '</p>
                            </div>

                            <div style="margin: 10px;">
                                <p>' . $row['course_quiz_marks'] . '</p>
                            </div>';
        
                // Check user type and add a link/button accordingly
                if ($_SESSION['user_type'] == "instructor") {
                    $deletequizUrl = "./deletequizUrl.php" .
                    "?course_name=" . urlencode($row['course_name']) .
                    "&course_category=" . urlencode($row['course_category']) .
                    "&course_instructor=" . urlencode($course_instructor).
                    "&course_quiz_question=" . urlencode($quizquestion);

                    echo '<a href="' . $deletequizUrl . '" style="background-color: rgb(139, 0, 0); cursor: pointer; text-decoration: none; padding: 5px 5px; border-radius: 5px;">
                             <button style="background-color: rgb(139, 0, 0); cursor: pointer; color: white; font-weight: bold;">Delete</button>
                          </a>';
                }
        
                echo '
                         </div>
                    </section> ';

                if($_SESSION['user_type'] == 'student'){

                    $email = $_SESSION['email'];
                    $quiz_serial = $row['quiz_serial'];
                    
                    $check_sql = "SELECT * FROM quiz_ans WHERE student_email = '$email' AND quiz_serial = '$quiz_serial' ";
                    $new_result = mysqli_query($link, $check_sql);
                 
                    if(mysqli_num_rows($new_result) > 0){
                        
                       echo 'Already submitted the Ans.';
                    }
                    else{

                   echo'   <section class="form__section">
                            <div class="container form__section-container">
                                <h2>Your Answer </h2>
                                
                                <form action="quizq.php" method="POST" enctype="multipart/form-data">

                                    <input type="hidden"  name="quiz_serial" value="'.$quiz_serial.'">
                                    <input type="hidden"  name="course_instructor" value="'.$course_instructor.'">
                                    <input type="hidden"  name="course_category" value="'.$course_category.'">
                                    <input type="hidden"  name="course_name" value="'.$course_name.'">

                                    <textarea name="quiz_ans" id="" cols="50" rows="20"  placeholder="Your Answer"></textarea>
                                    <button class="btn" type="submit">Add Ans</button>
                                </form>
                            </div>
                        </section> ';
                       
                        break;

                    }

                    
                        
                    

                }
                $counter++;
            }
        }
        
    ?>
</section>

<section>
    
        
    <?php 
    if ($_SESSION['user_type'] == "instructor") {
         $course_name = $_GET['course_name'];
         $course_category = $_GET['course_category'];
         $course_instructor = $_GET['course_instructor'];
         $quizansUrl = "./quizansUrl.php" .
                    "?course_name=" . urlencode($course_name) .
                    "&course_category=" . urlencode($course_category) .
                    "&course_instructor=" . urlencode($course_instructor).
                    "&course_quiz_question=" . urlencode($quizquestion);

        // echo $course_name;
        // echo  $course_category ;
        // echo $course_instructor;
        ?>
        <article class="post">
            <div style="text-align:center;">
              
              
                <a href="<?php echo $quizansUrl; ?>" style="background-color: navy; cursor: pointer; text-decoration: none; padding: 10px 20px; border-radius: 5px;">
                    <button style="background-color: navy; cursor: pointer; color: white; font-weight: bold;">See Student progress</button>
                </a>
            </div>
        </article>
    <?php }
    if ($_SESSION['user_type'] != "instructor") {
        $course_name = $_GET['course_name'];
        $course_category = $_GET['course_category'];
        $course_instructor = $_GET['course_instructor'];
        $quizansUrl = "./quizansUrl.php" .
                   "?course_name=" . urlencode($course_name) .
                   "&course_category=" . urlencode($course_category) .
                   "&course_instructor=" . urlencode($course_instructor).
                   "&course_quiz_question=" . urlencode($quizquestion);

       // echo $course_name;
       // echo  $course_category ;
       // echo $course_instructor;
       ?>
       <br>
       <br>
       <article class="post">
           <div style="text-align:center;">
             
             
               <a href="<?php echo $quizansUrl; ?>" style="background-color: navy; cursor: pointer; text-decoration: none; padding: 10px 20px; border-radius: 5px;">
                   <button style="background-color: navy; cursor: pointer; color: white; font-weight: bold;">My marks</button>
               </a>
           </div>
       </article>
   <?php }
    ?>
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
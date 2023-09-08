<?php

    session_start();

    if ( !isset($_SESSION['active_status'])  ) {
        header("Location: ./signin.php");
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
                    <?php
                    if($_SESSION['user_type'] == "student"){
                        
                        echo '<td><i class="uil uil-user"></i> Email</td> ';
                        echo '<td>'.$_SESSION['email'].'</td> ';
                    }
                    else{
                        echo '<td><i class="uil uil-user"></i> User Name</td> ';
                        echo '<td>'.$_SESSION['user_name'].'</td> ';
                    }


                    ?>
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
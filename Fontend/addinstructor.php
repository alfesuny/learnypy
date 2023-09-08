
<?php
    
    $message_toggle = 'off';
    $message_type = '';
    $message_body = '';
   
    
    session_start();
    if ( !isset($_SESSION["user_type"])  ) {
        //not logged in -> redirect
        header("Location: ./signin.php");
        exit();
    }
    if( $_SESSION["user_type"] == 'student' || $_SESSION["user_type"] == 'instructor'){ 
        // Student or instructor- > redirect 

        header("Location: ./index.php");
        exit();

    }



    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $link = mysqli_connect("localhost", "root", "", "learnypy") or die("ERROR: Could not connect. " . mysqli_connect_error());

        
        $username = $_POST["username"];
        $password = $_POST['password'];
        $type = $_POST['type'];

        if( $type == 'instructor'){

            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            
            $check_sql = "SELECT * FROM instructor_info WHERE instructor_username = '$username'";
            $check_result = mysqli_query($link, $check_sql);
            if (mysqli_num_rows($check_result) > 0) {
                // Username already exists, show an error message or take appropriate action
                $message_toggle = 'on';
                $message_type = 'error';
                $message_body = 'User Name already Exists';
            }
            else {
                // Username doesn't exist, proceed with the INSERT query
                $sql = "INSERT INTO instructor_info (instructor_username, instructor_fname, instructor_lname, instructor_password) 
                VALUES ('$username', '$fname', '$lname','$password')";
                
                if (mysqli_query($link, $sql)) {

                    $targetDirectory = "../pic/instructor/"; // Specify the target directory where you want to save the uploaded file
                    $filename = $username .'.jpg';
                    $targetFile = $targetDirectory . basename($filename); // Specify the target file path
                    
                    // if(is_dir($targetDirectory)){
                    //     echo "IS IT A DIRECTORY <br>";
                    // }

                    // if(is_writable($targetDirectory)){
                    //     echo "DESTIONATION DIRECTORY IS WRITABLE <br>";
                    // }
                    
                    // exit();
                    
                    // Check if the file already exists
                    if (file_exists($targetFile)) {
                        echo "File already exists. Please choose a different file.";
                    } else {
                        // Check if the file was uploaded successfully
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                            
                            echo "The file " . $username . " has been uploaded.";
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }



                    $message_toggle = 'on';
                    $message_type = 'success';
                    $message_body = "Account Created !." ;
                } 
                
            }

        }
        elseif ($type == 'admin') {
            # code...
      
            $check_sql = "SELECT * FROM admin_info WHERE username = '$username'";
            $check_result = mysqli_query($link, $check_sql);
            if (mysqli_num_rows($check_result) > 0) {
                // Username already exists, show an error message or take appropriate action
                $message_toggle = 'on';
                $message_type = 'error';
                $message_body = 'User Name already Exists';
            }
            else {
                // Username doesn't exist, proceed with the INSERT query
                $sql = "INSERT INTO admin_info (username,password) 
                VALUES ('$username','$password')";
                if (mysqli_query($link, $sql)) {
                    $message_toggle = 'on';
                    $message_type = 'success';
                    $message_body = "Account Created !." ;
                } 
                
            }

        }
    
    
        // Check if the username already exists
    
       
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
    <nav>
        <div class="container nav__container">
            <a href="./index.php"><img class="nav__logo" src="../images/logo1.png" alt="logo"></a>
            <ul class="nav__items">
                <li><a href="./index.php">Home</a></li>
            </ul>

            <!-- hamburger icon -->
            <!-- <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-times-square"></i></button> -->
        </div>
    </nav>
    
    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>


    <!-- add course -->
    <section class="form__section">

        
        
        <div class="container form__section-container">
            
        <?php
            if($message_toggle=='on' && $message_type == 'success'){
                echo'

                <div class="alert__message success">
                    <p>Account Created !</p>
                </div>

                ';
            }

            elseif($message_toggle=='on' && $message_type == 'error'){

                echo"

                <div class='alert__message error'>
                    <p> " . $message_body ."!</p>
                </div>

                ";

            }
        ?>
            
            <h2>Add Admin / Instructor </h2>
            
            <!-- <div class="alert__message error">
                <p>This is an error message</p>
            </div> -->


            <!-- <form action="addinstructor.php" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="UserName" name='username'>
                <input type="password" placeholder="Password" name='password'>
                <select name='type'>
                    <option value="admin">Admin</option>
                    <option value="instructor">Instructor</option>
                </select>
                <button class="btn" type="submit">Create Account </button>
            </form> -->

            <form action="addinstructor.php" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="First Name" name="fname" id="fname" style="display: none;">
                <input type="text" placeholder="Last Name" name="lname" id="lname" style="display: none;">
                
                
                
                
                <input type="text" placeholder="UserName" name="username">
                <input type="password" placeholder="Password" name="password">
                
                <div id="profilePictureContainer" style="display: none;">
                    <label for="avatar">User Profile Picture</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                
                <select name="type" id="userType">
                    <option value="admin">Admin</option>
                    <option value="instructor">Instructor</option>
                </select>
                
                <!-- Additional input fields initially hidden -->

                


                <button class="btn" type="submit">Create Account</button>
            </form>

            <script>
                // Get references to the select element and additional input fields
                const userTypeSelect = document.getElementById("userType");
                const fnameInput = document.getElementById("fname");
                const lnameInput = document.getElementById("lname");
                const profilePictureContainer = document.getElementById("profilePictureContainer");

                // Add an event listener to the select element
                userTypeSelect.addEventListener("change", function () {
                    if (userTypeSelect.value === "instructor") {
                        // Show the additional input fields when 'instructor' is selected
                        fnameInput.style.display = "block";
                        lnameInput.style.display = "block";
                        profilePictureContainer.style.display = "block";

                    } else {
                        // Hide the additional input fields for other options
                        fnameInput.style.display = "none";
                        lnameInput.style.display = "none";
                    }
                });
            </script>

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
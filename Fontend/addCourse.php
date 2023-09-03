<?php



    session_start();
    $show_error = false;
    $error_message = '';

    if ( !isset($_SESSION['active_status']) ) {
        // not logged in -> redirect
        header("Location: ./index.php");
        exit();
    }
    if( $_SESSION['user_type'] == "student"){
        // student -> redirect
        header("Location: ./index.php");
        exit();
    }



    
    // Check if the form is submitted using POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection settings
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "learnypy";
    
        // Create a database connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
    
        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        // Retrieve data from the form
        $courseTitle = $_POST['course_title'];
        $courseCategory = $_POST['course_category'];
        $courseInstructor = $_POST['course_instructor'];
        $courseDescription = $_POST['course_description'];
        $courseDifficulty = $_POST['course_difficulty'];
    
        // SQL query to check if a record with the same title, category, and instructor exists
        $checkQuery = "SELECT * FROM course WHERE course_name = '$courseTitle' AND course_category = '$courseCategory' AND course_instructor = '$courseInstructor'";
    
        $result = mysqli_query($conn, $checkQuery);
    
        // Check if a record with the same criteria exists
        if (mysqli_num_rows($result) == 0) {
            // No matching record found, insert the new course
            $insertQuery = "INSERT INTO course (course_name, course_category, course_instructor, course_description, course_difficulty)
                            VALUES ('$courseTitle', '$courseCategory', '$courseInstructor', '$courseDescription', '$courseDifficulty')";
    
            if (mysqli_query($conn, $insertQuery)) {
                echo "Course added successfully!";
                 
                
                $folder_name = "{$courseTitle}-{$courseCategory}-{$courseInstructor}";

                $base_directory = "../course_material"; // Change this to your desired directory path

                // Create the full path of the new folder
                $folder_path = "{$base_directory}/{$folder_name}";

                // Check if the folder already exists
                if (!file_exists($folder_path)) {
                    // Create the folder if it doesn't exist
                    if (mkdir($folder_path, 0777, true)) {
                        echo "Folder '{$folder_name}' created successfully!";
                    } else {
                        echo "Error creating folder.";
                    }
                } else {
                    echo "Folder '{$folder_name}' already exists.";
                }

                


            } 
            else {
                echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
            }
        } else {

            $show_error = true;
            $error_message = 'A course with the same title, category, and instructor already exists.';

            //echo "A course with the same title, category, and instructor already exists.";
        }
    
        // Close the database connection
        mysqli_close($conn);
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


    <!-- add course -->
    <section class="form__section">
        <div class="container form__section-container">
            <h2>Create Course</h2>

            <?php
            if($show_error == true){
               echo '
               <div class="alert__message error">
               <p>A course with the same title, category, and instructor already exists.</p>
               </div>
               ' ;
            }
            
            
            ?>
            <form action="addCourse.php" enctype="multipart/form-data" method='POST'>

                Course Title
                <input type="text" placeholder="Title" name = "course_title">
                
                Course Category
                <select name = 'course_category'>
                    <?php


                                                
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "learnypy";

                        $conn = mysqli_connect($servername, $username, $password, $dbname);
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        
                        $sql = "SELECT category_name FROM course_category";

                        // Execute the query
                        $result = mysqli_query($conn, $sql);
                        
                        // Check if any rows were returned
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $categoryName = $row["category_name"];
                                echo '<option value="' . $categoryName . '">' . $categoryName . '</option>';
                            }
                        } else {
                            echo "No categories found.";
                        }
                        
                    ?>
                
                </select>
               
                Course Instructor
                <select name = 'course_instructor'>
                    <?php


                                                    // Check if the connection was successful
                                                 
                                                if($_SESSION['user_type'] == 'admin'){
                                                    
                                                    // SQL query to fetch all usernames where user_type is "instructor"
                                                    $query = "SELECT instructor_username FROM instructor_info " ;
                                                    $result = mysqli_query($conn, $query);

                                                    if (mysqli_num_rows($result) > 0) {
                                                        // Start the select element
                                                        

                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            // Generate an option tag for each username
                                                            $username = $row['instructor_username'];
                                                            echo "<option value='$username'>$username</option>";
                                                        }

                                                        // Close the select element
                                                        
                                                    } else {
                                                        echo "No instructors found.";
                                                    }

                                                    // Close the database connection
                                                    mysqli_close($conn);

                                                }
                                                else{
                                                    $username = $_SESSION["user_name"];
                                                    echo "<option value='$username'>$username</option>";
                                                }


                    ?>
                </select>
                
                Course Description
                <textarea rows="10" placeholder="Course Description" name = 'course_description'></textarea>
                
                Course Difficulty
                <select name = "course_difficulty">
                    <option value="introductory">Introductory</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>

                <!-- <div class="form__control">
                    <label for="thumbnail">Add Video</label>
                    <input type="file" name="" id="thumbnail">
                </div>

                <div class="form__control">
                    <label for="thumbnail">Add Pdf</label>
                    <input type="file" name="" id="thumbnail">
                </div>

                <div class="form__control">
                    <label for="thumbnail">Add Quize</label>
                    <input type="file" name="" id="thumbnail">
                </div> -->

                
                
                <button class="btn" type="submit">Add Course</button>
            </form>
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
            <a href="https://www.instagram.com/fahadahammedbd/" target="_blank"><i class="uil uil-instagram-alt"></i></a>
        </div>
        <div class="container footer__container">
            <article style="margin-right: 50px;">
                <img src="../images/logo1.png" alt="">
                <small>Join LearnyPy, the ultimate online learning platform! Explore a vast range of courses, gain new skills, and unlock your potential from anywhere, at any time.</small>
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
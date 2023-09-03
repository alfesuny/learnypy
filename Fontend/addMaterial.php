<?php

    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "learnypy";

    // Create a database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname) or  die("Connection failed: " . mysqli_connect_error());



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

        $selectedOption = $_POST["course_information"];
        $filetype = $_POST['fileType'];
        $fileDescription = $_POST['fileDescription'];
        $courseName;
        $courseInstructor;
        $courseCategory;

        $exploded = explode("-", $selectedOption);
        
    
        list($courseName, $courseInstructor , $courseCategory) = $exploded;
        
        $targetDirectory = "../course_material/$courseName-$courseCategory-$courseInstructor/"; // Specify the target directory where you want to save the uploaded file

        // Get the original file name
        $originalFileName = $_FILES["file"]["name"];
        $targetFile = $targetDirectory . $originalFileName; // Specify the target file path

        // echo "course_name: " . $courseName . "<br>";
        // echo "course_instructor: " . $courseInstructor . "<br>";
        // echo "course_category: " . $courseCategory . "<br>";
        // echo "Target Directory: " . $targetDirectory . "<br>";

        if (file_exists($targetFile)) {
            echo "File already exists. Please choose a different file.";
        } else {
            // Check if the file was uploaded successfully
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                //echo "The file " . $originalFileName . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $query ="INSERT INTO course_material (course_name, course_category, course_instructor, course_material_type, course_material_name ,course_material_description)
        VALUES ('$courseName', '$courseCategory', '$courseInstructor', '$filetype', '$originalFileName','$fileDescription')";
        mysqli_query($conn,$query);


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
           
            

            <h1> Add Course Material</h1>

                <form id="uploadForm" action="addMaterial.php" method="POST" enctype="multipart/form-data">

                    <select name="course_information" id="">

                        <?php
                        $username = $_SESSION['user_name'];
                        $query = "SELECT * FROM COURSE WHERE course_instructor = '$username' ";
                        $result = mysqli_query($conn, $query);
                        if($result){
                            
                            while( $row = mysqli_fetch_assoc($result) ){
                                echo '<option value="'.$row['course_name'].'-'.$row['course_instructor'].'-'.$row['course_category'].'">'.'Course Name:'.$row['course_name'].' | Course Instructor:'.$row['course_category'].'</option>' ;
                            }
                        }
                        else{
                            echo "You Are not Taking any Courses Right now !";
                        }

                        
                        ?>

                    </select>

                        <label for="file">Select File:</label>
                        <input type="file" id="file" name="file" accept=".pdf, .jpg, .jpeg, .png, .mp4" required>
                        
                        <label for="fileType">Select File Type:</label>
                        <select id="fileType" name="fileType" required>
                            <option value="pdf">PDF</option>
                            <option value="jpg">JPG</option>
                            <option value="mp4">MP4</option>
                        </select>

                        <label for="fileDescription">Description About File:</label>
                        <input type="text" id='fileDescription' name="fileDescription" required>
                    
                    
                    <button class="btn" type="submit">Add Item to</button>
                </form>

    
            
        </div>
    </section>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission

            // Get selected file and file type
            const fileInput = document.getElementById('file');
            const fileTypeSelect = document.getElementById('fileType');
            const selectedFileType = fileTypeSelect.value;

            if (fileInput.files.length > 0) {
                const selectedFile = fileInput.files[0];

                // Check if the selected file type matches the chosen file type
                const allowedFileExtensions = {
                    'pdf': ['.pdf'],
                    'jpg': ['.jpg', '.jpeg', '.png'],
                    'mp4': ['.mp4']
                };

                const selectedFileExtension = selectedFile.name.split('.').pop().toLowerCase();
                if (allowedFileExtensions[selectedFileType].includes('.' + selectedFileExtension)) {
                    // Submit the form
                    this.submit();
                } else {
                    alert('Invalid file type. Please select a file with the correct extension.');
                }
        });
    </script>

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
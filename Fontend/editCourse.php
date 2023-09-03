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

        $course_name = $_POST["course_name"];
        $course_category = $_POST["course_category"];
        $course_instructor = $_POST["course_instructor"];
        $new_course_name = $_POST["new_course_name"];
        $new_course_category = $_POST["new_course_category"];
        $new_course_instructor = $_POST["new_course_instructor"];
        $course_description = $_POST["course_description"];
        $course_difficulty = $_POST["course_difficulty"];

        // Prepare and execute the SQL UPDATE statement
        $update_sql = "UPDATE course SET course_name = ?, course_category = ?, course_instructor = ?, course_description = ?, course_difficulty = ? WHERE course_name = ? AND course_category = ? AND course_instructor = ?";
        
        $stmt = mysqli_prepare($conn, $update_sql);

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssssssss", $new_course_name, $new_course_category, $new_course_instructor, $course_description, $course_difficulty, $course_name, $course_category, $course_instructor);

        if (mysqli_stmt_execute($stmt)) {
            echo "Course updated successfully!";


                        $old_folder_name = "{$course_name}-{$course_category}-{$course_instructor}";
                        $new_folder_name = "{$new_course_name}-{$new_course_category}-{$new_course_instructor}";
                        $base_directory = "../course_material"; // Replace with your directory path
                        
                        $old_folder_path = "{$base_directory}/{$old_folder_name}";
                        $new_folder_path = "{$base_directory}/{$new_folder_name}";

                        // Check if the old folder exists
                        if (file_exists($old_folder_path)) {
                            // Rename the folder
                            if (rename($old_folder_path, $new_folder_path)) {
                                echo "Folder renamed successfully!";
                            } else {
                                echo "Error renaming folder.";
                            }
                        
                        } 
                        else {
                            echo "Old folder '{$old_folder_name}' does not exist.";
                        }
        } else {
            echo "Error updating course: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
        header("Location: ./manageCourses.php");
        exit();


    }

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["name"]) && isset($_GET["category"]) && isset($_GET["instructor"])) {
    $course_name = $_GET["name"];
    $course_category = $_GET["category"];
    $course_instructor = $_GET["instructor"];

    // Retrieve course data based on the provided information
    $sql = "SELECT * FROM course WHERE course_name = ? AND course_category = ? AND course_instructor = ?";
    
    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sss", $course_name, $course_category, $course_instructor);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result set
    $result = mysqli_stmt_get_result($stmt);
    $row  = null;
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Close the statement
        mysqli_stmt_close($stmt);
    }
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
                <h2>Update Course</h2>
            
                <form action="editCourse_tester.php" method="POST" enctype="multipart/form-data">


                <input type="hidden" name="course_name" value="<?php echo htmlspecialchars($row["course_name"]); ?>">
                <input type="hidden" name="course_category" value="<?php echo htmlspecialchars($row["course_category"]); ?>">
                <input type="hidden" name="course_instructor" value="<?php echo htmlspecialchars($row["course_instructor"]); ?>">

                <label for="new_course_name">New Course Name:</label>
                <input type="text" name="new_course_name" id="new_course_name" value="<?php echo htmlspecialchars($row["course_name"]); ?>">

              
                
                <label for="new_course_category">New Course Category:</label>
                <input type="text" name="new_course_category" id="new_course_category" value="<?php echo htmlspecialchars($row["course_category"]); ?>">
                
                <label for="new_course_instructor">New Course Instructor:</label>
                <input type="text" name="new_course_instructor" id="new_course_instructor" value="<?php echo htmlspecialchars($row["course_instructor"]); ?>">

                <label for="course_description">Description:</label>
                <textarea name="course_description" id="course_description"><?php echo htmlspecialchars($row["course_description"]); ?></textarea>
                <label for="course_difficulty">Difficulty:</label>
                <input type="text" name="course_difficulty" id="course_difficulty" value="<?php echo htmlspecialchars($row["course_difficulty"]); ?>">
                
                <button class="btn" type="submit">Update Course</button>
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
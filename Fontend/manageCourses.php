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


    <!----------------------------------------- Start Manage Course --------------------------------------->
    
    <section class="dashboard">
        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
            <?php
            if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin'){
                
                echo '
                    <aside>
                        <ul>
                            <li><a href="./addCourse.php"><i class="uil uil-pen"></i>
                                    <h5>Add Course</h5>
                                </a></li>
                        </ul>
                        <ul>
                            <li><a href="./addinstructor.php"><i class="uil uil-pen"></i>
                                    <h5>Add Instructor</h5>
                                </a></li>
                        </ul>
                        <ul>
                            <li><a href="./signup.php"><i class="uil uil-pen"></i>
                                    <h5>Add Student</h5>
                                </a></li>
                        </ul>
                        <ul>
                            <li><a class="active" href="./manageCourses.php"><i class="uil uil-fast-mail"></i>
                                    <h5>Manage Course</h5>
                                </a></li>
                        </ul>
                        <ul>
                            <li><a href="./manageInstructor.php"><i class="uil uil-user-plus"></i>
                                    <h5>Manage Instructor</h5>
                                </a></li>
                        </ul>
                        <ul>
                            <li><a href="./manageUsers.php"><i class="uil uil-user-times"></i>
                                    <h5>Manage User</h5>
                                </a></li>
                        </ul>
                        <ul>
                            <li><a href="./manageCategories.php"><i class="uil uil-edit"></i>
                                    <h5>Manage Category</h5>
                                </a></li>
                        </ul>
                        <!-- <ul>
                            <li><a href="manage-categories.html"><i class="uil uil-list-ul"></i>
                                <h5>Manage Categories</h5>
                            </a></li>
                        </ul> -->
                    </aside>
                
                ';
            }
            
            ?>
            <main>
                <h2>Manage Courses</h2>
                <!-- <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Instructor</th>
                            <th>Difficulty</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <body>
                        <tr>
                            <td>Python for Data Science.</td>
                            <td>Data Science</td>
                            <td><a href="./editCourse.html" class="btn sm">Edit</a></td>
                            <td><a href="#" class="btn sm danger">Delete</a></td>
                        </tr>
                        <tr>
                            <td>Object Oriented Programming.</td>
                            <td>Programming</td>
                            <td><a href="./editCourse.html" class="btn sm">Edit</a></td>
                            <td><a href="#" class="btn sm danger">Delete</a></td>
                        </tr>
                        <tr>
                            <td>Problem Solving</td>
                            <td>Programming</td>
                            <td><a href="./editCourse.html" class="btn sm">Edit</a></td>
                            <td><a href="#" class="btn sm danger">Delete</a></td>
                        </tr>
                    </body>
                </table> -->

                <?php
                // Replace these variables with your database connection details
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

                // SQL query to select data from the 'course' table
                $sql = '';
                if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin'){
                    
                    $sql = "SELECT course_name, course_category, course_instructor, course_difficulty FROM course";
                }
                elseif( isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'instructor'){
                    $user_name = $_SESSION['user_name']; 
                    $sql = "SELECT course_name, course_category, course_instructor, course_difficulty FROM course WHERE course_instructor = '$user_name' ";
                }
                $result = mysqli_query($conn, $sql);

                ?>

                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Instructor</th>
                            <th>Difficulty</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row["course_name"] . "</td>";
                                echo "<td>" . $row["course_category"] . "</td>";
                                echo "<td>" . $row["course_instructor"] . "</td>";
                                echo "<td>" . $row["course_difficulty"] . "</td>";
                                echo "<td><a href='./editCourse.php?name=" . urlencode($row["course_name"]) . "&category=" . urlencode($row["course_category"]) . "&instructor=" . urlencode($row["course_instructor"]) . "' class='btn sm'>Edit</a></td>";
                                echo "<td>";

                                // Form for deleting the course
                                echo "<form method='POST' action='deleteCourse.php'>";
                                echo "<input type='hidden' name='course_name' value='" . $row["course_name"] . "'>";
                                echo "<input type='hidden' name='course_category' value='" . $row["course_category"] . "'>";
                                echo "<input type='hidden' name='course_instructor' value='" . $row["course_instructor"] . "'>";
                                echo "<button type='submit' class='btn sm danger' onclick='return confirm(\"Are you sure you want to delete this course?\")'>Delete</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No courses found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>


                <?php
                // Close the database connection
                mysqli_close($conn);
                ?>












            </main>
        </div>
    </section>
    <!----------------------------------------- End Manage Course --------------------------------------->




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
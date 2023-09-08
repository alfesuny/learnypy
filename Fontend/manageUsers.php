<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "learnypy") or die("ERROR: Could not connect. " . mysqli_connect_error());

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
    <?php include 'header.php' ?>

    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>

    <!----------------------------------------- Start Manage Instructor --------------------------------------->
    <section class="dashboard">
        <div class="container dashboard__container">
            <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
            <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
          
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
                    <li><a  href="./manageCourses.php"><i class="uil uil-fast-mail"></i>
                            <h5>Manage Course</h5>
                        </a></li>
                </ul>
                <ul>
                    <li><a href="./manageInstructor.php"><i class="uil uil-user-plus"></i>
                            <h5>Manage Instructor</h5>
                        </a></li>
                </ul>
                <ul>
                    <li><a class="active" href="./manageUsers.php"><i class="uil uil-user-times"></i>
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


            <main>
                <div class="manage__instructor_title">
                    <div>
                        <h2>Manage Users</h2>
                    </div>
                    <div>
                        <a href="./addUser.html"><button class="btn" type="submit">Add User</button></a>
                    </div>
                </div>
                <!-- <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Admin</th>
                        </tr>
                    </thead>

                    <body>
                        <tr>
                            <td>Fahad Ahammed</td>
                            <td>fahad</td>
                            <td><a href="./editUser.html" class="btn sm">Edit</a></td>
                            <td><a href="#" class="btn sm danger">Delete</a></td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Fahad Ahammed</td>
                            <td>fahad</td>
                            <td><a href="./editUser.html" class="btn sm">Edit</a></td>
                            <td><a href="#" class="btn sm danger">Delete</a></td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td>Fahad Ahammed</td>
                            <td>fahad</td>
                            <td><a href="./editUser.html" class="btn sm">Edit</a></td>
                            <td><a href="#" class="btn sm danger">Delete</a></td>
                            <td>No</td>
                        </tr>
                    </body>
                </table> -->

                <?php
                            $sql = "SELECT student_fname, student_lname, student_email FROM student_info"; // Replace with your table name
                            $result = mysqli_query($conn, $sql);
                            
                            // Check if any rows were returned
                            if (mysqli_num_rows($result) > 0) {
                                // <th>Edit</th>
                                echo "<table>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Delete</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>";
                            
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // <td><a href='./editUser.html' class='btn sm'>Edit</a></td>
                                    
                                    echo "<tr>
                                    <td>{$row['student_fname']} {$row['student_lname']}</td>
                                    <td>{$row['student_email']}</td>
                                    <td>
                                        <form action='deleteStudent.php' method='POST' onsubmit='return confirmDelete();'>
                                            <input type='hidden' name='email' value='{$row['student_email']}'>
                                            <button type='submit' class='btn sm danger' name='delete'>Delete</button>
                                        </form>
                                    </td>
                                  </tr>";
                                }
                            
                                echo "</tbody></table>";
                            } else {
                                echo "No students found.";
                            }
                            
                            // Close the database connection
                            mysqli_close($conn);
                ?>

            </main>
        </div>
    </section>

    <script> 
        function confirmDelete() {
            return confirm("Are you sure you want to delete this student?");
        }
    </script>
    <!----------------------------------------- End Manage Instructor --------------------------------------->






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
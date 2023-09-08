<nav>
        <div class="container nav__container">
            <a href="./index.php"><img class="nav__logo" src="../images/logo1.png" alt="logo"></a>
            <ul class="nav__items">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./courses.php">Courses</a></li>
                <li><a href="./instructors.php">Instructors</a></li>
                <!-- <li><a href="#">Contact Us</a></li> -->

                
                
                <?php

                


                if( isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'instructor'){
                    echo ' <li> <a href="myCourses.php"> My Courses </a> </li> ';
                }

                if( isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'student' ){
                    echo ' <li> <a href="course_evaluation.php"> Course Evaluation </a> </li> ';
                    echo ' <li> <a href="enrolledcourses.php"> Enrolled Courses  </a> </li> ';

                }



                // session_start();

                if ( isset($_SESSION['active_status'])  )
                {

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
                       
                        if (is_file($filePath)) {
                            $name= explode('.',$file);
                            if( $name[0] == $image_should ){
                                $image_name = $file ;
                                break;
                            }
                            if($_SESSION['user_type'] == 'student' ){
                                $first_part = explode('.',$image_should);
                                if($name[0] == $first_part[0]){
                                    // echo $name[0] ;
                                    // echo $first_part[0] ;
                                    $image_name = $file ;
                                    break;
                                }
                            }
                        }
                    }
      
                                 
                echo '
                <li class="nav__profile">
                    
                    <div class="avatar">
                        <img src="../pic/'.$_SESSION['user_type']. '/'.$image_name.'" style = "height:125%" >
                    </div> ' 

                   . $_SESSION['user_name'] .
                    
                 
                   ' <ul>
                        <li><a href="./profile.php">Profile</a></li> ' ;
                if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin'){
                    
                    echo ' <li><a href="./manageCourses.php">Dashboard</a></li> ';

                }    
                if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'instructor'){
                    
                    echo ' <li> <a href="addMaterial.php"> Add Material</a> </li> ';
                    echo ' <li> <a href="manageCourses.php"> Edit Your Courses </a> </li> ';
                    echo ' <li> <a href="addCourse.php"> Create Course </a> </li> ';
                    echo ' <li> <a href="addQuiz.php"> Add A Quiz </a> </li> ';

                }                  
                
                echo '
                        <li><a href="./logout.php">Logout</a></li>
                    </ul>
                </li> '      ;
                    
                }

                else{

                    echo '
                    <li><a href="./signin.php">Login</a></li>
                <li><a href="./signup.php">Sign Up</a></li>
                
                ' ;

                }
                
                

                ?>
            </ul>

            <!-- hamburger icon -->
            <!-- <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-times-square"></i></button> -->
        </div>
    </nav>
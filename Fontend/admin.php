<?php
    session_start();
    if ( isset($_SESSION['user_type']) ) {
        
            header("Location: ./index.php");
            exit();

        
    }

  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $link = mysqli_connect("localhost", "root", "", "learnypy");
        if(!$link){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        

        $username = $_POST["username"];
       // for later // $password =hash('sha256',$_POST['password']);
        $password = $_POST['password'];
        
        $type = $_POST['type'];

        if($type == "instructor"){
            $sql = "SELECT * FROM instructor_info WHERE instructor_username='$username' AND instructor_password ='$password' ";
           
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
    
                    $row = mysqli_fetch_array($result);
                    $_SESSION['active_status'] = 1 ;
                    $_SESSION['user_name'] =  $username ;
                    $_SESSION['user_type'] = 'instructor';
                    
                    // $row = mysqli_fetch_assoc($result);
                    // if(is_null( $row['instructor_pic'])){
                    //     $_SESSION['pic'] = 'null';
                    //     echo $_SESSION['pic'];
                    // }

                    
       
                    header("Location: ./profile.php");
                    exit();
                }
                
            }
        
        }
        

 
  
        elseif($type == "admin")
        {

            $sql = "SELECT * FROM admin_info WHERE username='$username' AND password ='$password' ";
            
            if($result = mysqli_query($link, $sql)){
                if(mysqli_num_rows($result) > 0){
    
                    $row = mysqli_fetch_array($result);
                    $_SESSION['active_status'] = 1 ;
                    $_SESSION['user_name'] =  $username ;
                    $_SESSION['user_type'] = 'admin';
    
                    header("Location: ./index.php");
                    exit();
                }
                
            }

        }
    
       
        
    }

    
 
  
    if ( isset($_SESSION['active_status'])  ) {
        header("Location: ./index.php");
        exit();
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

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Admin & Teacher Sign In</h2>
            <!-- <div class="alert__message success">
                <p>This is an success message</p>
            </div> -->
            <?php
            // if($password_matching != 'off' && $password_matching != 'done'  ){
            // echo '<div class="alert__message error">
            //     <p>Sorry The Email or The Password Didn\'t match !</p>
            // </div>';
            // }

            ?>

            <form action="admin.php" method="POST">
                <input type="text" placeholder="Username" name='username'>
                <input type="password" placeholder="Password" name='password'>
                <SELECT name='type'>
                    <option value="admin">Admin</option>
                    <option value="instructor">Instructor</option>
                </SELECT>
                <button class="btn" type="submit">Sign In</button>
                <!-- <small>Don't have an account? <a href="./signup.html">Sign Up</a></small> -->
            </form>
        </div>
    </section>
</body>

</html>



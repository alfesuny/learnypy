<?php
    session_start();
    
    $password_matching = 'on';


    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $password_matching = 'off';
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST["email"];
        $password =hash('sha256',$_POST['password']);


        $link = mysqli_connect("localhost", "root", "", "learnypy");
 
        // Check connection
        if(!$link){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM student_info WHERE student_email='$email' AND student_password ='$password' ";
        if($result = mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) > 0){

                $row = mysqli_fetch_array($result);
                $_SESSION['active_status'] = 1 ;
                $_SESSION['user_name'] = $row['student_fname'];
                $_SESSION['user_type'] = "student";
                $_SESSION['email'] = $email ;
                              

                $password_matching = 'done' ;
                header("Location: ./index.php");
                exit();
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
    <?php include 'header.php';?>
    <!----------------------------------------- End Nav Bar --------------------------------------->
    <br>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Sign In</h2>
            <!-- <div class="alert__message success">
                <p>This is an success message</p>
            </div> -->
            <?php
            if($password_matching != 'off' && $password_matching != 'done'  ){
            echo '<div class="alert__message error">
                <p>Sorry The Email or The Password Didn\'t match !</p>
            </div>';
            }

            ?>

            <form action="signin.php" method="POST">
                <input type="text" placeholder="Email" name='email'>
                <input type="password" placeholder="Password" name='password'>
                
                <!-- Div ta shorai dilei hobe buttons will be verticle -->
                <div class="button-container">
                        <button class="btn" type="submit">Sign In</button>
                        <button class="btn danger"> <a href='./admin.php'>Admin Login</a> </button> 
                </div>
                
                <small>Don't have an account? <a href="./signup.html">Sign Up</a></small>
            </form>
        </div>
    </section>
</body>

</html>



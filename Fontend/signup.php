
<?php
    session_start();
    
    $error_message = 'off';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $email = $_POST["email"];
        $password = hash('sha256',$_POST['password']);
        $lname = $_POST['lname'];
        $fname =$_POST['fname'];

        $link = mysqli_connect("localhost", "root", "", "learnypy");
 
        // Check connection
        if(!$link){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

      
        $sql = "INSERT INTO student_info (student_fname, student_lname, student_email,student_password) VALUES ('$fname', '$lname', '$email','$password')";
        if(mysqli_query($link, $sql)){
          
            $targetDirectory = "../pic/student/"; // Specify the target directory where you want to save the uploaded file
            $filename = $email .'.jpg';
            $targetFile = $targetDirectory . basename($filename); // Specify the target file path

            // Check if the file already exists
            if (file_exists($targetFile)) {
                echo "File already exists. Please choose a different file.";
            } else {
                // Check if the file was uploaded successfully
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    echo "The file " . $email . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        
          
          
            if( !isset($_SESSION['active_status']) ){ // not logged in  -> log in + redirect

                $_SESSION['active_status'] = 1 ;
                $_SESSION['user_name'] = $fname;
                $_SESSION['user_type'] = 'student';
                $_SESSION['email'] = $email;
                
                header("Location: ./index.php");
                exit();
            }
            if( $_SESSION['user_type'] == 'admin'){
                header("Location: ./manageUsers.php");
            }

        } else{
            $error_message = 'on';
            //echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
        
    
       
        
    }

    
 
  
    if ( isset($_SESSION['active_status'])  ) {
        if( $_SESSION['user_type'] != "admin"){ // logged in + not admin = redirect            
            header("Location: ./index.php");
            exit();
        }
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
            <?php
                if(isset($_SESSION['user_type']) &&  $_SESSION['user_type'] == 'admin'){
                    echo "<h2>Add Student</h2>";
                }
                else{
                    
                    echo "<h2>Sign Up</h2>";
                    
                }
                if($error_message=='on'){

                    echo '
                    <div class="alert__message error">
                        <p>Could not Create Student Account</p>
                    </div>
                    ' ;
                }
            ?>
            <form action="signup.php" method="POST" enctype="multipart/form-data" >
                <input type="text" placeholder="First Name" name = 'fname'>
                <input type="text" placeholder="Last Name" name = 'lname'>
                <!-- <input type="text" placeholder="Username"> -->
                <input type="email" placeholder="Email" name = 'email'>
                <input type="password" placeholder="Password" name = 'password'>
                <!-- <input type="password" placeholder="Confirm Password" > -->
                <div class="form__control">
                    <label for="avatar">User Profile Picture</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
                <button class="btn" type="submit">Sign Up</button>
                <small>Already have an account? <a href="./signin.html">Sign In</a></small>
            </form>
        </div>

    </section>
</body>

</html>
<?php

 $link = mysqli_connect("localhost", "root", "", "learnypy");

 // Check connection
 if (!$link) {
     die("ERROR: Could not connect. " . mysqli_connect_error());
 }
 $quizquestion = $_GET['course_quiz_question'];
 echo $quizquestion;
 $query =  "DELETE FROM course_quiz WHERE course_quiz_question = '$quizquestion'";

       
if( $result = mysqli_query($link, $query)){
    echo " : Quizquestion deleted";
    header("Location: ./myCourses.php");
}





?>
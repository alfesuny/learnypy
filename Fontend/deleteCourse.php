<?php
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

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve course information from POST data
    $course_name = $_POST["course_name"];
    $course_category = $_POST["course_category"];
    $course_instructor = $_POST["course_instructor"];

    // Sanitize and validate the data if needed

    // Your SQL query to delete the course based on the provided information
    $sql = "DELETE FROM course WHERE course_name = ? AND course_category = ? AND course_instructor = ?";
    
    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sss", $course_name, $course_category, $course_instructor);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Course deleted successfully
        echo "Course deleted successfully!";
    } else {
        // Error occurred while deleting the course
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    
    // Close the database connection
    mysqli_close($conn);

    header("Location: manageCourses.php");
    exit();

} else {
    // If the request method is not POST, handle it accordingly (e.g., show an error message)
    header("Location: index.php");
    exit();
}
?>

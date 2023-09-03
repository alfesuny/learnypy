<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "learnypy"; // Replace with your database name

    // Create a database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the email of the student to be deleted from the POST data
    $student_email = $_POST["email"];

    // SQL query to delete the student
    $delete_sql = "DELETE FROM student_info WHERE student_email = '$student_email'"; // Replace with your table name
    if (mysqli_query($conn, $delete_sql)) {
        header("Location: ./manageUsers.php");
    } else {
        echo "Error deleting student: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} 
else {
    echo "Invalid request.";
}



?>

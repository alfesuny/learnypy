<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learnypy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableNames = array();
$result = $conn->query("SHOW TABLES");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_row()) {
        $tableNames[] = $row[0];
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedTable = $_POST["table"];
    $result = $conn->query("SELECT * FROM $selectedTable");

    if ($result->num_rows > 0) {
        echo "<h2>Table: $selectedTable</h2>";
        echo "<table border='1'><tr>";

        // Display table column names as headers
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $key => $value) {
                echo "<th>$key</th>";
            }
            break;
        }
        echo "</tr>";

        // Display table data
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No data found in the selected table.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Show Database Tables</title>
</head>
<body>
    <form method="post">
        <label for="table">Select a Table:</label>
        <select name="table" id="table">
            <?php
            foreach ($tableNames as $tableName) {
                echo "<option value='$tableName'>$tableName</option>";
            }
            ?>
        </select>
        <button type="submit">Show Table</button>
    </form>
</body>
</html>

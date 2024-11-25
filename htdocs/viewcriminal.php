<?php
session_start(); // Start the session

$hostname = "localhost";
$username = "root";
$password = "";
$database = "criminal record management system";

// Establish the database connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Retrieve data from the criminal table
$query = "SELECT * FROM criminal";
$result = $connection->query($query);

// Check if there are any records in the table
if ($result->num_rows > 0) {
    // Output the records in a table format
    echo "<html>";
    echo "<head>";
    echo "<style>";
    echo "table {";
    echo "    font-family: Arial, sans-serif;";
    echo "    border-collapse: collapse;";
    echo "    width: 100%;";
    echo "}";

    echo "td, th {";
    echo "    border: 1px solid #ddd;";
    echo "    padding: 8px;";
    echo "}";

    echo "tr:nth-child(even) {";
    echo "    background-color: #f2f2f2;";
    echo "}";

    echo "tr:hover {";
    echo "    background-color: #ddd;";
    echo "}";

    echo "th {";
    echo "    padding-top: 12px;";
    echo "    padding-bottom: 12px;";
    echo "    text-align: left;";
    echo "    background-color: #4CAF50;";
    echo "    color: white;";
    echo "}";
    echo "</style>";
    echo "</head>";
    echo "<body>";

    echo "<h2>Criminal Data</h2>";
    
    // Add the Home button
    echo '<form action="curd.php">';
    echo '<input type="submit" value="Home">';
    echo '</form>';
    
    echo "<table>";
    echo "<tr><th>Criminal ID</th><th>CNIC</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Address</th><th>Contact Number</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Criminal_ID"] . "</td>";
        echo "<td>" . $row["CNIC"] . "</td>";
        echo "<td>" . $row["First_Name"] . "</td>";
        echo "<td>" . $row["Last_Name"] . "</td>";
        echo "<td>" . $row["Date_of_Birth"] . "</td>";
        echo "<td>" . $row["Address"] . "</td>";
        echo "<td>" . $row["Contact_Number"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "</body>";
    echo "</html>";
} else {
    echo "No criminal data found.";
}

// Close the database connection
$connection->close();
?>

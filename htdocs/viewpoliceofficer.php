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

// Retrieve data from the policeofficer table
$query = "SELECT * FROM policeofficer";
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

    echo "<h2>Police Officer Data</h2>";

    // Add the Home button
    echo '<form action="curd.php">';
    echo '<input type="submit" value="Home">';
    echo '</form>';

    echo "<table>";
    echo "<tr><th>Officer ID</th><th>First Name</th><th>Last Name</th><th>Officer Rank</th><th>Badge Number</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Officer_ID"] . "</td>";
        echo "<td>" . $row["First_Name"] . "</td>";
        echo "<td>" . $row["Last_Name"] . "</td>";
        echo "<td>" . $row["Officer_Rank"] . "</td>";
        echo "<td>" . $row["Badge_Number"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "</body>";
    echo "</html>";
} else {
    echo "No police officer data found.";
}

// Close the database connection
$connection->close();
?>

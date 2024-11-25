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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['logout'])) {
        // Perform logout logic or redirect to logout page
        session_unset(); // Unset all session variables
        session_destroy(); // Destroy the session
        header("Location: login.php"); // Redirect to logout page
        exit;
    } else {
        // Retrieve the form data
        $name = $_POST["name"];
        $cnic = $_POST["cnic"];
        $address = $_POST["address"];
        $crime = $_POST["crime"];
        $details = $_POST["details"];

        // Prepare the SQL statement to insert data into the table
        $query = "INSERT INTO CriminalData (name, CNIC, address, crime, details)
                  VALUES ('$name', '$cnic', '$address', '$crime', '$details')";

        if ($connection->query($query) === true) {
            echo "Data saved successfully!";
        } else {
            echo "Error: " . $connection->error;
        }
    }
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Criminal Data</title>
    <style>
        body {
            background-image: url("Background.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        form {
            width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="submit"]:active {
            background-color: #003080;
        }

        a {
            color: #fff;
            text-decoration: none;
        }
        .logo {
            display: block;
            margin: 20px auto;
            width: 200px;
        }
    
<input type="submit" value="Save" class="custom-button">

    </style>
</head>
<body>
    <h2>ADD CRIMINAL DATA</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="cnic">CNIC:</label>
        <input type="text" id="cnic" name="cnic">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address">

        <label for="crime">Crime:</label>
        <input type="text" id="crime" name="crime">

        <label for="details">Details:</label>
        <textarea id="details" name="details"></textarea>

        <input type="submit" value="Save">
    </form>
   
</style>
    <br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Logout">
    </form>

    <br>

    <a href="curd.php">Back</a>
</body>
</html>

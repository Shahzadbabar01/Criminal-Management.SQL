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
    } elseif (isset($_POST['delete'])) {
        // Retrieve the Criminal ID from the user
        $criminalId = $_POST["criminalId"];

        // Delete associated records from other tables
        $deleteRecordsQuery = "DELETE FROM criminalrecord WHERE Record_ID = '$criminalId'";
        if ($connection->query($deleteRecordsQuery) === true) {
            // Associated records deleted successfully, proceed with deleting the record from the criminal table
            $deleteQuery = "DELETE FROM criminal WHERE Criminal_ID = '$criminalId'";

            if ($connection->query($deleteQuery) === true) {
                echo "Record with Criminal ID $criminalId has been deleted.";
            } else {
                echo "Error deleting record: " . $connection->error;
            }
        } else {
            echo "Error deleting associated records: " . $connection->error;
        }
    } else {
        // Retrieve the Criminal ID from the user
        $criminalId = $_POST["criminalId"];

        // Prepare the SQL statement to fetch data from the table based on Criminal ID
        $query = "SELECT * FROM criminal WHERE Criminal_ID = '$criminalId'";
        $result = $connection->query($query);

        if ($result && $result->num_rows > 0) {
            // Criminal ID found, display the data
            $row = $result->fetch_assoc();
            $firstName = $row["First_Name"];
            $lastName = $row["Last_Name"];
            $dateOfBirth = $row["Date_of_Birth"];
            $address = $row["Address"];
            $contactNumber = $row["Contact_Number"];
        } else {
            // Criminal ID not found, show an error message
            echo "Criminal ID not found. Please enter a valid Criminal ID.";
        }
    }
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Criminal Data</title>
    <style>
        body {
            background-image: url("Background.jpg");
            background-size: cover;
            background-repeat: repeat;
            background-position: center;
            color: #fff;
            font-family: Arial, sans-serif;
            position: relative; /* Add this */
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
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: none;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: -15px; /* Adjust the margin-top value as needed */
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        input[type="submit"]:active {
            background-color: #003080;
        }

        .top-left {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<h2>DELETE CRIMINAL DATA</h2>
<div class="top-left">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Back">
    </form>
</div>
<div class="top-right">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Logout">
    </form>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="criminalId">Criminal ID:</label>
    <input type="text" id="criminalId" name="criminalId" required><br><br>
    <div style="text-align: center;"><input type="submit" value="Search"></div>
</form>

<?php if (isset($firstName)): ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="criminalId" value="<?php echo $criminalId; ?>">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" value="<?php echo $firstName; ?>" readonly><br><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" value="<?php echo $lastName; ?>" readonly><br><br>

        <label for="dateOfBirth">Date of Birth:</label>
        <input type="text" id="dateOfBirth" name="dateOfBirth" value="<?php echo $dateOfBirth; ?>" readonly><br><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>" readonly><br><br>

        <label for="contactNumber">Contact Number:</label>
        <input type="text" id="contactNumber" name="contactNumber" value="<?php echo $contactNumber; ?>" readonly><br><br>

        <input type="submit" name="delete" value="Delete">
    </form>
<?php endif; ?>
</body>
</html>

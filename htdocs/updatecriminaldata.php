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
        // Retrieve the Criminal ID from the user
        $criminalId = $_POST["criminal_id"];

        // Prepare the SQL statement to fetch data from the table based on Criminal ID
        $query = "SELECT * FROM criminal WHERE Criminal_ID='$criminalId'";
        $result = $connection->query($query);

        if ($result && $result->num_rows > 0) {
            // Criminal ID found, display the data
            $row = $result->fetch_assoc();
            $firstName = $row["First_Name"];
            $lastName = $row["Last_Name"];
            $dob = $row["Date_of_Birth"];
            $address = $row["Address"];
            $contactNumber = $row["Contact_Number"];

            // Check if the form is submitted for updating the data
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
                // Retrieve the updated values from the form
                $firstName = $_POST["first_name"];
                $lastName = $_POST["last_name"];
                $dob = $_POST["dob"];
                $address = $_POST["address"];
                $contactNumber = $_POST["contact_number"];

                // Prepare the SQL statement to update data in the table
                $updateQuery = "UPDATE criminal SET First_Name='$firstName', Last_Name='$lastName', Date_of_Birth='$dob', Address='$address', Contact_Number='$contactNumber' WHERE Criminal_ID='$criminalId'";

                if ($connection->query($updateQuery) === true) {
                    echo "Data updated successfully!";
                } else {
                    echo "Error updating data: " . $connection->error;
                }
            }
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
    <title>Update Criminal Data</title>
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
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #0080ff;
            color: #fff;
            padding: 10px;
            width: 100%;
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

        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .home-button {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>
<body>
    <h2>Update Criminal Data</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="criminal_id">Criminal ID:</label>
        <input type="text" id="criminal_id" name="criminal_id" required><br><br>
        <input type="submit" value="Search">
    </form>

    <?php if (isset($firstName)): ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="hidden" name="criminal_id" value="<?php echo $criminalId; ?>">

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo $firstName; ?>" required><br><br>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo $lastName; ?>" required><br><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required><br><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required><br><br>

            <label for="contact_number">Contact Number:</label>
            <input type="text" id="contact_number" name="contact_number" value="<?php echo $contactNumber; ?>" required><br><br>

            <input type="submit" name="update" value="Update">
        </form>
    <?php endif; ?>

    <br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Logout">
    </form>

    <br>

    <a href="curd.php">HOME</a>
</body>
</html>

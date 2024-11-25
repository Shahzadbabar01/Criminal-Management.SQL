<!DOCTYPE html>
<html>
<head>
    <title>ADD CRIMINAL DATA</title>
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
            border-radius: 5px;
            border: none;
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
    <h2>ADD CRIMINAL DATA</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="criminal_id">Criminal ID:</label>
        <input type="text" id="criminal_id" name="criminal_id" required>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>

        <label for="cnic">CNIC:</label>
        <input type="text" id="cnic" name="cnic" required>

        <input type="submit" value="Save Data">
    </form>

    <form action="curd.php" method="GET" class="home-button">
        <input type="submit" value="Home">
    </form>

    <form action="Login.php" method="POST" class="logout-button">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Logout">
    </form>

    <?php
        // Database connection configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "criminal record management system";

        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Retrieve form data
            $criminalID = $_POST["criminal_id"];
            $firstName = $_POST["first_name"];
            $lastName = $_POST["last_name"];
            $dob = $_POST["dob"];
            $address = $_POST["address"];
            $contactNumber = $_POST["contact_number"];
            $cnic = $_POST["cnic"];

            // Prepare and execute the SQL statement to insert data
            $sql = "INSERT INTO Criminal (Criminal_ID, First_Name, Last_Name, Date_of_Birth, Address, Contact_Number, CNIC)
                    VALUES ('$criminalID', '$firstName', '$lastName', '$dob', '$address', '$contactNumber', '$cnic')";

            if ($conn->query($sql) === TRUE) {
                echo "Data saved successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the database connection
        $conn->close();
    ?>

</body>
</html>

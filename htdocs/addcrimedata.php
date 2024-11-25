<!DOCTYPE html>
<html>
<head>
    <title>ADD CRIME DATA</title>
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
    <h2>ADD CRIME DATA</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="criminal_id">Criminal ID:</label>
        <input type="text" id="criminal_id" name="criminal_id" required>

        <label for="crime_type">Crime Type:</label>
        <input type="text" id="crime_type" name="crime_type" required>

        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>

        <label for="date_committed">Date Committed:</label>
        <input type="date" id="date_committed" name="date_committed" required>

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
            $crimeType = $_POST["crime_type"];
            $description = $_POST["description"];
            $dateCommitted = $_POST["date_committed"];

            // Prepare and execute the SQL statement to insert data
            $sql = "INSERT INTO Crime (Criminal_ID, Crime_Type, Description, Date_Committed)
                    VALUES ('$criminalID', '$crimeType', '$description', '$dateCommitted')";

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

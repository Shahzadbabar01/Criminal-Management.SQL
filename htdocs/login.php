<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "criminal database management system";

// Establishing the database connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted login credentials
    $login_id = $_POST["login_id"];
    $password = $_POST["password"];

    // Prepare a SQL query to fetch the admin record with matching login credentials
    $query = "SELECT * FROM Login WHERE Username = '$login_id' AND Password = '$password'";
    $result = $connection->query($query);

    // Check if a matching admin record was found
    if ($result->num_rows == 1) {
        // Authentication successful, redirect to the criminal data page
        header("Location: curd.php");
        exit();
    } else {
        // Authentication failed, display an error message
        $error_message = "Invalid login credentials. Please try again.";
    }
}

// Close the database connection
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Official Login</title>
    <style>
        body {
            background-image: url("Background.jpg");
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
        }

        .container {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 5px;
            margin-top: 100px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: rgb(255, 255, 0)
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="Badge.png" alt="Logo" width="100px" height="100px">
        <h1>LOGIN</h1>
        <form action="login.php" method="POST">
            <label for="login_id">Username:</label>
            <input type="text" id="login_id" name="login_id" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
            <?php
            if (isset($error_message)) {
                echo '<div class="error">' . $error_message . '</div>';
            }
            ?>
        </form>
    </div>
</body>
</html>
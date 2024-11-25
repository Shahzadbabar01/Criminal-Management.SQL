<!DOCTYPE html>
<html>
<head>
    <title>ADD COURT CASE DATA</title>
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
    <h2>ADD COURT CASE DATA</h2>

    <form action="add_courtcase.php" method="POST">
        <label for="case_id">Case ID:</label>
        <input type="text" id="case_id" name="case_id" required>

        <label for="case_number">Case Number:</label>
        <input type="text" id="case_number" name="case_number" required>

        <label for="crime_id">Crime ID:</label>
        <input type="text" id="crime_id" name="crime_id" required>

        <label for="officer_id">Officer ID:</label>
        <input type="text" id="officer_id" name="officer_id" required>

        <label for="court_name">Court Name:</label>
        <input type="text" id="court_name" name="court_name" required>

        <label for="date_opened">Date Opened:</label>
        <input type="date" id="date_opened" name="date_opened" required>

        <label for="date_closed">Date Closed:</label>
        <input type="date" id="date_closed" name="date_closed" required>

        <input type="submit" value="Save Data">
    </form>

    <form action="curd.php" method="GET" class="home-button">
        <input type="submit" value="Home">
    </form>

    <form action="Login.php" method="POST" class="logout-button">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Logout">
    </form>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Criminal Record Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("Background.jpg");
            background-size: cover;
            padding: 20px;
        }

        form {
            background-color: rgba(255, 255, 255);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(255, 255, 255);
            max-width: 400px;
            margin: 0 auto;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        .heading {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="submit"] {
            background-color: #cfd8dc;
            color: #000;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-bottom: 5px;
            border-radius: 3px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #ffeb3b;
        }

        .logo {
            width: 100px;
            height: 100px;
            background-image: url("Badge.png");
            background-size: cover;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <?php
    if(isset($_POST['add'])){
        // Redirect to add_data.php
        header("Location: add.php");
        exit;
    }

    if(isset($_POST['delete'])){
        // Redirect to delete_data.php
        header("Location: delete.php");
        exit;
    }

    if(isset($_POST['update'])){
        // Redirect to update_data.php
        header("Location: update.php");
        exit;
    }

    if(isset($_POST['display'])){
        // Redirect to display_data.php
        header("Location: display.php");
        exit;
    }

    if(isset($_POST['logout'])){
        // Redirect to another form or logout logic
        header("Location: login.php");
        exit;
    }
    ?>

    <form action="" method="post">
        <div class="logo"></div>
        <h1 class="heading">Criminal Record Management System</h1>
        <div class="button-container">
            <input type="submit" name="add" value="Add Data">
            <input type="submit" name="delete" value="Delete Data">
            <input type="submit" name="update" value="Update Data">
            <input type="submit" name="display" value="Display Data">
            <input type="submit" name="logout" value="Logout">
        </div>
    </form>
</body>
</html>

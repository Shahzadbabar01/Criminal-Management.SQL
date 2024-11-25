<?php
// Database connection details
$host = 'localhost'; // Replace with your database host
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password
$database = 'criminal record management system'; // Replace with your database name

// Create a database connection
$connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection is successful
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $table = $_POST['table'];

  // Redirect user to the specific form based on the selected table
  switch ($table) {
    case 'criminal':
      header('Location: deletecriminaldata.php');
      break;
    case 'crime':
      header('Location: crime.php');
      break;
    case 'criminalrecord':
      header('Location: criminalrecord.php');
      break;
    case 'recordcase':
      header('Location: recordcase.php');
      break;
    case 'courtcase':
      header('Location: courtcase.php');
      break;
    case 'policeofficer':
      header('Location: policeofficer.php');
      break;
    default:
      // Handle invalid table selection
      echo 'Invalid table selection.';
      break;
  }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .nav {
      display: flex;
      justify-content: space-between;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
    }

    .nav a {
      color: #fff;
      text-decoration: none;
      margin-right: 10px;
    }

    .nav a:hover {
      text-decoration: underline;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    select {
      width: 100%;
      padding: 8px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="nav">
    <div>
      <a href="Login.php">Logout</a>
    </div>
    <div>
      <a href="curd.php">Home</a>
    </div>
  </div>

  <div class="container">
    <h2>SELECT TABLE TO DELETE DATA</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label for="table">Select a Table:</label>
        <select id="table" name="table">
          <option value="criminal">Criminal</option>
          <option value="crime">Crime</option>
          <option value="criminalrecord">Criminal Record</option>
          <option value="recordcase">Record Case</option>
          <option value="courtcase">Court Case</option>
          <option value="policeofficer">Police Officer</option>
        </select>
      </div>

      <input type="submit" value="Submit">
    </form>
  </div>
</body>
</html>

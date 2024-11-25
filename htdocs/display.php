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
    case 'report':
      header('Location: report.php');
      break;
    case 'criminal':
      header('Location: viewcriminaldata.php');
      break;
    case 'crime':
      header('Location: viewcrime.php');
      break;
    case 'criminalrecord':
      header('Location: viewcriminalrecord.php');
      break;
    case 'recordcase':
      header('Location: viewrecordcase.php');
      break;
    case 'courtcases':
      header('Location: viewcourtcases.php');
      break;
    case 'policeofficer':
      header('Location: viewpoliceofficer.php');
      break;
    default:
      // Handle invalid table selection
      echo 'Invalid table selection.';
      break;
  }
  mysqli_close($connection);
  exit(); // Add this line to stop executing the rest of the code
}

// Fetch data from all tables
$tables = ['criminal', 'crime', 'criminalrecord', 'recordcase', 'courtcases', 'policeofficer'];
$reportData = array();

foreach ($tables as $table) {
  $query = "SELECT * FROM $table";
  $result = mysqli_query($connection, $query);

  if ($result) {
    // Fetch all rows from the result set
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $reportData[$table] = $rows;
  } else {
    echo "Error fetching data from $table: " . mysqli_error($connection);
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
    <h2>SELECT TABLE TO DISPLAY DATA</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="form-group">
        <label for="table">Select an Option:</label>
        <select id="table" name="table">
          <option value="report">View Report</option>
          <option value="criminal">Criminal</option>
          <option value="crime">Crime</option>
          <option value="criminalrecord">Criminal Record</option>
          <option value="recordcase">Record Case</option>
          <option value="courtcases">Court Case</option>
          <option value="policeofficer">Police Officer</option>
        </select>
      </div>

      <input type="submit" value="Submit">
    </form>
  </div>

  <?php if (isset($_POST['table']) && $_POST['table'] === 'report'): ?>
    <div class="container">
      <h2>Report</h2>

      <?php foreach ($reportData as $tableName => $rows): ?>
        <h3><?php echo $tableName; ?></h3>

        <table>
          <thead>
            <tr>
              <!-- Display column headers -->
              <?php foreach ($rows[0] as $column => $value): ?>
                <th><?php echo $column; ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <!-- Display rows -->
            <?php foreach ($rows as $row): ?>
              <tr>
                <?php foreach ($row as $value): ?>
                  <td><?php echo $value; ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <br>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</body>
</html>

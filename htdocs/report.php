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

// Fetch data from all tables
$tables = ['criminal', 'crime', 'criminalrecord', 'recordcase', 'courtcases', 'policeofficer'];
$allData = array();

foreach ($tables as $table) {
  $query = "SELECT * FROM $table";
  $result = mysqli_query($connection, $query);

  if ($result) {
    // Fetch all rows from the result set
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $allData[$table] = $rows;
  } else {
    echo "Error fetching data from $table: " . mysqli_error($connection);
  }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
  <title>REPORT</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    .table-container {
      max-width: 800px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table th,
    table td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    table th {
      font-weight: bold;
    }
    
    .top-buttons {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }
    
    .button {
      padding: 8px 16px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="table-container">
    <div class="top-buttons">
      <button class="button" onclick="window.location.href='curd.php'">Home</button>
      <button class="button" onclick="window.location.href='Login.php'">Logout</button>
    </div>
    <h2>REPORT</h2>

    <?php foreach ($allData as $tableName => $rows): ?>
      <h3><?php echo $tableName; ?></h3>

      <?php if (count($rows) > 0): ?>
        <table>
          <thead>
            <tr>
              <?php foreach ($rows[0] as $column => $value): ?>
                <th><?php echo $column; ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $row): ?>
              <tr>
                <?php foreach ($row as $value): ?>
                  <td><?php echo $value; ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p>No data available</p>
      <?php endif; ?>

      <br>
    <?php endforeach; ?>
  </div>
</body>
</html>

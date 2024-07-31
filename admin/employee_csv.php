<?php
include 'includes/conn.php';

if (isset($_POST['submit'])){
  $csv_file = $_FILES['csv_file'];
  $csv_file_type = $csv_file['type'];
  $csv_file_ext = pathinfo($csv_file['name'], PATHINFO_EXTENSION);
  if ($csv_file_type != 'text/csv' || $csv_file_ext != 'csv') {
    echo 'Only CSV files are allowed.';
    exit;
  }

  // open and read CSV file
  $csv_file_handle = fopen($csv_file['tmp_name'], 'r');

  // Skip the first line (header)
  fgetcsv($csv_file_handle);

  // Initialize counter
  $count = 0;

  while (($row = fgetcsv($csv_file_handle)) !== false) {
    // insert data into database
    $regular = "Regular";
    $sql = "INSERT INTO employees (employee_id, firstname, lastname) 
      VALUES (
        '".mysqli_real_escape_string($conn, $row[0])."', 
        '".mysqli_real_escape_string($conn, $row[1])."', 
        '".mysqli_real_escape_string($conn, $row[2])."'
      )";
    mysqli_query($conn, $sql);

    $count++;
  }

  fclose($csv_file_handle);
  mysqli_close($conn);

  if ($count > 0) {
    echo '<div class="alert alert-success" role="alert">New records created successfully</div>';
    echo '<script>setTimeout(function(){window.location.href = "employee.php";}, 2000);</script>';
    exit();
  } else {
    echo '<div class="alert alert-danger" role="alert">Error: No records inserted</div>';
    exit();
  }
}
?>

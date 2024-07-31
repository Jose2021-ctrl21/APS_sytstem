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
  // Check if the record already exists
  $existingSql = "SELECT COUNT(*) AS count FROM attendance WHERE date = '" . mysqli_real_escape_string($conn, $row[0]) . "' AND employee_id = '" . mysqli_real_escape_string($conn, $row[1]) . "'";
  $existingResult = mysqli_query($conn, $existingSql);
  $existingRow = mysqli_fetch_assoc($existingResult);

  if ($existingRow['count'] == 0) {
    // Insert data into database
    $sql = "INSERT INTO attendance (date, employee_id, name, time_in, time_out ) 
      VALUES (
        '".mysqli_real_escape_string($conn, $row[0])."', 
        '".mysqli_real_escape_string($conn, $row[1])."', 
        '".mysqli_real_escape_string($conn, $row[2])."',
        '".mysqli_real_escape_string($conn, $row[3])."',
        '".mysqli_real_escape_string($conn, $row[4])."'
      )";
    mysqli_query($conn, $sql);

    if (mysqli_error($conn)) {
      echo 'Error: ' . mysqli_error($conn);
      exit();
    }

    $count++;
  } else {
    echo 'Skipping duplicate record: ' . $row[0] . ' - ' . $row[1] . '<br>';
  }
}

  fclose($csv_file_handle);
  mysqli_close($conn);

  if ($count > 0) {
    echo '<div class="alert alert-success" role="alert">New records created successfully</div>';
    echo '<script>setTimeout(function(){window.location.href = "attendance.php";}, 2000);</script>';
    exit();
  } else {
    echo '<div class="alert alert-danger" role="alert">Error: No records inserted <a href="attendance.php"><button>Back</button></a></div>';
    exit();
  }
}
?>

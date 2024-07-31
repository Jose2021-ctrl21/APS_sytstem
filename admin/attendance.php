<?php include 'includes/session.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/conn.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Attendance
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="box-header with-border">
              <h4>CSV File upload</h4>
                <form action="attendance_csv.php" method="POST" enctype="multipart/form-data">
                  <label for="foldername" style="padding:1rem 2.5rem;background:lightBlue;border-radius:10px;"><strong style="font-size: 25px;color:black">+</strong></label><br>
                  <input type="file" name="csv_file" style="display:none;" id="foldername" multiple accept="image/*">
                  <input type="submit" name="submit" id="none-none" value="Upload">
                </form>
              </div>
           <div class="box-body">
  <form method="post" action="">
    <table id="example1" class="table table-bordered">
      <thead>
        <tr>
          <th class="hidden"></th>
          <th><input type="checkbox" id="checkAll">All</th>
          <th>Date</th>
          <th>Employee ID</th>
          <th>Name</th>
          <th>Time In</th>
          <th>Time Out</th>
          <th>Tools</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM attendance ORDER BY id DESC";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
          ?>
          <tr>
            <td style="display:none"><?php echo $row['id']; ?></td>
            <td><input type="checkbox" class="checkOne" name="checkedRows[]" value="<?php echo $row['id']; ?>"></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['employee_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo date('h:i A', strtotime($row['time_in'])); ?></td>
            <td><?php echo date('h:i A', strtotime($row['time_out'])); ?></td>
            <td>
              <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i> Edit</button>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <button id="deleteAll" class="btn btn-danger btn-sm" name="deleteAllBtn" disabled>Delete Selected Rows</button>
  </form>
</div>

<script>
  // Confirmation dialog before deletion
  document.getElementById('deleteAll').addEventListener('click', function(e) {
    if (!confirm('Are you sure you want to delete the selected rows?')) {
      e.preventDefault(); // Prevent the form from submitting
    }
  });
</script>

<?php
// Check if the deleteAllBtn button is clicked
if (isset($_POST['deleteAllBtn'])) {
  // Check if any checkboxes are checked
  if (!empty($_POST['checkedRows'])) {
    $placeholders = rtrim(str_repeat('?,', count($_POST['checkedRows'])), ',');
    $deleteStmt = $conn->prepare("DELETE FROM attendance WHERE id IN ($placeholders)");

    $deleteStmt->bind_param(str_repeat('s', count($_POST['checkedRows'])), ...$_POST['checkedRows']);

    if ($deleteStmt->execute()) {
      echo "<script>
        if (alert('Selected rows have been deleted successfully.')) {
          window.location.href = 'attendance.php';
        } else {
          // User canceled the deletion
        }
      </script>";
    } else {
      echo "<script>
        alert('Error deleting rows.');
        window.location.href = 'error.php';
      </script>";
    }
  }
}
?>

          </div>
        </div>
      </div>
    </section>
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/attendance_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

<!-- CHECK -->
<!-- <script>
  $(document).ready(function(){
    $("#deleteAll").prop("disabled",true);
  })
</script> -->
<script>
  $(document).ready(function() {
    $("#checkAll").change(function() {
      $(".checkOne").prop("checked", $(this).prop("checked"));
      if ($(this).prop("checked")) {
        $("#deleteAll").prop("disabled", false);
        $("#deleteAll").css("background-color", "btn-success");
        $("#deleteAll").css("color", "white");

      } else {
        $("#deleteAll").prop("disabled", true);
        // $("#deleteAll").css("background-color", "lightGray");
        // $("#deleteAll").css("color", "black");
      }
    });

    $(".checkOne").change(function() {
      if ($(".checkOne:checked").length > 0) {
        $("#deleteAll").prop("disabled", false);
        $("#deleteAll").css("background-color", "btn-success");
        $("#deleteAll").css("color", "white");
      } else {
        $("#deleteAll").prop("disabled", true);
        // $("#deleteAll").css("background-color", "lightGray");
        // $("#deleteAll").css("color", "black");
      }
    });
  });
</script>
<!-- END CHECK -->

<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#attendance_date').html(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}
</script>
<?php include 'includes/datatable_initializer.php'; ?>
</body>
</html>

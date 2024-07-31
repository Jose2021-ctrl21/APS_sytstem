<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>users</li>
        <li class="active">user</li>
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
            <div class="card text-center">

    <div class="card-body">
      
      <div class="box-header with-border">
              <h4>File upload</h4>
              <form action="document_proccess.php" method="POST" enctype="multipart/form-data">
                <label for="foldername" style="padding:1rem 2.5rem;background:lightBlue;border-radius:10px;"><strong style="font-size: 25px;color:black">+</strong></label><br>
                <input type="file" name="upload-file[]" style="display:none;" id="foldername" multiple accept="image/*">
                <input type="submit" name="upload-submit" id="none-none" value="Upload">
              </form>
      </div>
    </div>
    <div class="card-footer text-muted">
      <!-- 2 days ago -->
    </div>
  </div>
            
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <!-- <th>User ID</th> -->
                  <!-- <th>Photo</th> -->
                  <th>File name</th>
                  <!-- <th>Position</th> -->
                  <th>Files</th>
                  <th>Date</th>
                  <th>Tools</th>
                </thead>
                <tbody>
                  <?php
                  error_reporting(0);
                    $sql = "SELECT * from documents";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['file_name']?></td>
                          <td><?php echo $row['files']; ?></td>
                          <td><?php echo date('M d, Y', strtotime($row['date'])) ?></td>

                          <td>
                            <a class="btn btn-success btn-sm btn-flat" href="documents_download.php?id=<?php echo $row['id']; ?>" download>
                            <i class="fa fa-download"></i> Download
                            </a>

                            <a class="btn btn-danger btn-sm delete" href="documents_delete.php?id=<?php echo $row['id']; ?>" >
                             <i class="fa fa-trash"></i> Delete
                            </a>

                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('').click(function(e){
    e.preventDefault();
    $('').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('').click(function(e){
    e.preventDefault();
    $('').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: '',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.employee_id').html(response.employee_id);
      $('.del_employee_name').html(response.firstname+' '+response.lastname);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#edit_firstname').val(response.firstname);
      $('#edit_lastname').val(response.lastname);
      $('#edit_address').val(response.address);
      $('#datepicker_edit').val(response.birthdate);
      $('#edit_contact').val(response.contact_info);
      $('#gender_val').val(response.gender).html(response.gender);
      $('#position_val').val(response.position_id).html(response.description);
      $('#schedule_val').val(response.schedule_id).html(response.time_in+' - '+response.time_out);
    }
  });
}

</script>
<?php include 'includes/datatable_initializer.php'; ?>
</body>
</html>

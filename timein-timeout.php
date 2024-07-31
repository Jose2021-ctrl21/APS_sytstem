<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page">
 <!--  <div style="background:green;width:100%"><button><a href="admin/index.php">Login<a></button>
  </div> -->
<div class="login-box">
  	<div class="login-logo">
  		<p id="date"></p>
      <p id="time" class="bold"></p>
  	</div>
  
  	<div class="login-box-body">
    	<h4 class="login-box-msg">Enter Employee ID</h4>

    	<form id="attendance">
          <div class="form-group">
            <select class="form-control" name="status">
              <option value="in">Time In</option>
              <option value="out">Time Out</option>
            </select>

          </div>
      		<div class="form-group has-feedback">
            

        		<input type="text" class="form-control input-lg" id="employee" name="employee" required>
        		<span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
          
    	</form>

  	</div>
		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  		<!-- <div class="Selection">
                <a href="admin/index.php"><button class="admin-login">Admin Login</button></a>
                <a href="staff/index.php"><button class="staff-login">Staff Login</button></a>
            </div>
            <style>
              .Selection{
                /*margin-top: 10px;*/
                display: flex;
                justify-content: space-between;
                width: 100%;
                padding:5px;
                /*border: 1px solid black;*/
              }
              button{
                border:1px solid gray;
                color: black;
                font-size: 18px;
                text-transform: 
                background-color:#6DA9E4;
              }
            </style>
</div> -->
            
	
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {
    var momentNow = moment();
    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
        }
      }
    });
  });
    
});
</script>
</body>
</html>
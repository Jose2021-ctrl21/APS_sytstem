
<?php
  session_start();
  if(isset($_SESSION['userLogin']) AND isset($_SESSION['userType']) AND $_SESSION['userType']=='admin'){
    header('location:admin/home.php');
  }
  elseif(isset($_SESSION['userLogin']) AND isset($_SESSION['userType']) AND $_SESSION['userType']=='staff'){
    header('location:Staff/home.php');
  }
  
echo"<script>alert('USERNAME:[angel]PASS:[tolentino123]_____USERNAME:[iris];PASS:[cagbabanua123]')</script>";
?>
<?php include 'header.php';
include 'timezone.php';
?>

<body class="hold-transition login-page">

  <nav class="navbar">
  <div class="container-fluid" style="background-color: #679289, padding:">
    <a class="navbar-brand">ABS</a>
    <form class="d-flex" role="search">
      <button class="btn btn-outline-success" type="submit">SIGN IN</button>
    </form>
  </div>
</nav>

<div class="login-box">
  	<div class="login-logo">
  		<b>Login</b>
  	</div>
  
  	<div class="login-box-body">
    	<p class="login-box-msg">Sign in to start your session</p>

    	<form action="login.php" method="POST">
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="username" placeholder="input Username" required autofocus>
        		<span class="glyphicon glyphicon-user form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="input Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
        		</div>
      		</div>
    	</form>
  	</div>
  	<?php
  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>".$_SESSION['error']."</p> 
			  	</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>
</div>
	
<?php include 'scripts.php' ?>
</body>
</html>
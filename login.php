<?php
	session_start();
	include 'admin/includes/conn.php';
	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM admin WHERE username = '$username' AND password='$password'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Cannot find account with the username';
		}
		else{
			$row = $query->fetch_assoc();
			if($row['user_type']=='admin'){
				$_SESSION['userLogin'] = $row['id'];
				$_SESSION['userType'] = $row['user_type'];
			}
			elseif($row['user_type']=='staff'){
				$_SESSION['userLogin'] = $row['id'];
				$_SESSION['userType'] = $row['user_type'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
				echo "This is error";
			}
		}
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
	}
	header('location: index.php');
?>
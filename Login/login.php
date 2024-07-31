<?php
	session_start();
	include 'Login/conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE username = '$username'";
$query = $conn->query($sql);
try{
if($query->num_rows > 0){
	$row = $query->fetch_assoc();
	if(password_verify($password, $row['password'])){
		if($row['user_type'] == 'admin'){
			$_SESSION['admin'] = $row['id'];
			header('location: /admin/home.php');
			exit();
		}
		else if($row['user_type'] == 'staff'){
			$_SESSION['staff'] = $row['id'];
			header('location: ../Staff/home.php');
			exit();
		}
		else{
			$_SESSION['error'] = 'Unknown user type';
			header('location: login.php');
			exit();
		}
	}
	else{
		$_SESSION['error'] = 'Incorrect password';
		header('location: login.php');
		exit();
	}
}
else{
	$_SESSION['error'] = 'Cannot find account with the username';
	header('location: login.php');
	exit();
}
}
catch(err){
	alert(404);
}

<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$position = $_POST['position'];
		$schedule = $_POST['schedule'];
		
		$sql = "UPDATE admin SET firstname = '$firstname', lastname = '$lastname', address = '$address', birthdate = '$birthdate', contact = '$contact', gender = '$gender', position = '$position', schedule = '$schedule' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select user to edit first';
	}
	header('location: user-sample.php');
?>
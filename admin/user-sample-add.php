<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$user_type = $_POST['user_type'];
		$schedule = $_POST['schedule'];
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//creating employeeid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$employee_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		$sql = "INSERT INTO admin (employee_id, username, password, firstname, lastname, address, birthdate, contact, gender, schedule, photo, created_on,user_type) VALUES ('$employee_id','$username','$password','$firstname', '$lastname', '$address', '$birthdate', '$contact', '$gender', '$schedule', '$filename', NOW(), '$user_type')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: user-sample.php');
?>
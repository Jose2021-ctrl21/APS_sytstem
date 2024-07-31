<?php
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['userLogin']) AND isset($_SESSION['userType']) || trim($_SESSION['userLogin']) == '' || $_SESSION['userType'] != 'admin' ){
		header('location: ../index.php');
	}

	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['userLogin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();
?>
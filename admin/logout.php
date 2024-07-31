<?php
	session_start();
	unset($_SESSION['userLogin']);
	session_destroy();

	header('location: ../index.php');
?>
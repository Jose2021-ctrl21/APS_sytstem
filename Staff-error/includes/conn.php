<?php
	$conn = new mysqli('localhost', 'root', 'root123', 'apsystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>
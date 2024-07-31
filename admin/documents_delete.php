<?php
	include 'includes/session.php';

	if(isset($_GET['id'])){
		$id = $_GET['id'];
		//delete from directory
		// $dir = 'uploads/documents/folder';

			// Open a directory, and read its contents
			// if (is_dir($dir)) {
			//   if ($dh = opendir($dir)) {
			//     while (($file = readdir($dh)) !== false) {
			//       // Check if the file is a file (not a directory) and delete it
			//       if (is_file($dir.'/'.$file)) {
			//         unlink($dir.'/'.$file);
			//       }
			//     }
			//     closedir($dh);
			//   }
			// }

		//delete from database
	$sql = "DELETE FROM documents WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}
	header('location: documents.php');
?>
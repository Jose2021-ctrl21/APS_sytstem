<?php
include 'includes/session.php';

if(isset($_POST['upload-submit'])){
// format size of file into two digits
function get_size($size){
	$kb_size = $size/1024;
	$format_size = number_format($size,2);
	return $format_size;
}


//total the selected file name
$total = count($_FILES['upload-file']['name']);

//loop based on the size of $total so that upload is multiple
for($i=0;$i<$total;$i++){

//get the size of file
$size = get_size($_FILES['upload-file']['size'][$i]);
//get the path from folder
$path = 'uploads/documents';

	// if($size < 10){ //condition of size of file to be uploaded, comment muna
		if(!file_exists($path)){
			mkdir($path,0777,true);//bypassing the authorization into admin if the user is not in admin so he can upload
		}

		//get the filename you want to move or upload
		$temp_file = $_FILES['upload-file']['tmp_name'][$i];

		//check if there is really a filename
		if($temp_file != ""){
			//create a full file path
			$newfilepath = $path."/".$_FILES['upload-file']['name'][$i];
			if(move_uploaded_file($temp_file, $newfilepath)){


				
						$fileNew = $_FILES['upload-file']['name'][$i];
						$ext = pathinfo($fileNew, PATHINFO_EXTENSION);
						$test1 = 'test1';
						$test2 = 'test2';

					   // Build the SQL query to insert the file data
					   $sql = "
					   INSERT INTO documents(file_name,files,file_type,date)
					   VALUES ('$test1','$fileNew','$ext',NOW())";

					   // Execute the SQL query and check for errors
					   if ($conn->query($sql) === TRUE) {
					      echo "<div class='container-fluid'
							style='height:100vh;
							width:100%;display:flex;
							justify-content:center;
							align-items:center;flex-direction:column;background:whiteSmoke'>

							<div
							style='width:auto;
							height:auto;background:lightGreen;color:black
							'>
							<h3>Uploaded successfully</h3>
							</div>

							</div>";
							echo "<script>setTimeout(function(){
					            window.location = 'documents.php';
					        }, 2000);
					    	</script>";
					   } else {
					       echo "Error: " . $sql . "<br>" . $conn->error;
					       exit();
					   }
					}
				
			
			else{
				echo "Upload error encountered:".$_FILES['upload']['error'][$i];
				exit();
			};
			
		}
	// } //end condition for limit size of upload, but for now, comment muna
}//end of loop
}//end of isset

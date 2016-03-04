<?php

$msg =""; // variable used for user feedback

if(isset($_POST["fileSubmit"])){ // check if their is a file that the user has selected
	$target_dir = "uploads/"; // directory where the file will be uploaded to
	$target_file = $target_dir . basename($_FILES["uploadFile"]["name"]);

	// if the file is succesfully uploaded the message will be changed to represent this
	if ( move_uploaded_file ($_FILES['uploadFile'] ['tmp_name'], $target_file))
	{  
	  	$msg = "The file has been successfully uploaded";
	}
	else
	{
		switch ($_FILES['uploadFile'] ['error'])
		{  case 1:
		           $msg =  "The file is bigger than this PHP installation allows";
		           break;
		    case 2:
		           $msg =  "The file is bigger than this form allows";
		           break;
		    case 3:
		           $msg =  "Only part of the file was uploaded";
		           break;
		    case 4:
		           $msg =  "No file was uploaded";
		           break;
		}
	}
}

?>
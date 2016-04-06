<?php
//this is fuction inserts html into a page
//it allows the user to upload a file to the website
function displayUploadForm()
{
	$output = '<form class="contentBox" id="fileUpload" action="" method="post" enctype="multipart/form-data">'. "\n";
	$output .= '<label for="uploadFile">Select file to upload: </label>' . "\n";
	$output	.= '<input id="uploadFile" type="file" name="uploadFile">'."\n";
	$output .= '<input type="submit" value="Upload File" name="fileSubmit">'."\n";
	$output .= '<div id="feedback"></div>'."\n";
	$output .= '</form>';

	return $output;
}
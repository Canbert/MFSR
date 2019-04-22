<?php
//this is fuction inserts html into a page
//it allows the user to upload a file to the website
function displayUploadForm()
{
	$output = '<form class="content-box file-upload" method="post" enctype="multipart/form-data">';
	$output .= '<label for="">Select file to upload:<input id="uploaded" type="file" name="uploaded"></label>';
	$output .= '<input type="submit" class="button" id="upload" value="Upload File" name="upload">';
	$output .= '<div id="feedback"></div>';
	$output .= '</form>';

	return $output;
}
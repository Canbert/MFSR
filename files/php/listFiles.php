<?php

//looks through the upload directory and creates a table of links with the time it was last modified and the size of the file

$dir = "../uploads";
$output = '';  
$outRows = '';  
$files = array();

if (is_dir($dir)) {
	if ($dirHandle = opendir($dir)) {
		$files = array_diff(scandir($dir), array('.', '..', '.htaccess'));
		$totalSize = (int) 0;
		foreach($files as $file) {
			$fileTime = @date("d-M-Y", filectime($dir . '/' . $file)) . ' ' . @date("h:i", filemtime($dir . '/' . $file));
			$totalSize += filesize($dir . '/' . $file);
			$fileSize = @byte_convert(filesize($dir . '/' . $file));
			$cellLink = '<td class="listFilesTableFileLink"><a href="/files/uploads/' . $file . '">' . $file . '</a></td>';
			$cellTime = '<td>' . $fileTime . '</td>';
			$cellSize = '<td>' . $fileSize . '</td>';
			$outRows .= '<tr>' . "\n  " . $cellLink . "\n  " . $cellTime . "\n  " . $cellSize . "\n" . '</tr>' . "\n";
		}
		closedir($dirHandle);
	}
	else
	{
		echo "Directory didn't scan";
	}
}
else
{
	echo "No directory found";
}
$output = '<table class="listFilesTable">' . "\n";
$output .= '<thead><tr><td><b>Name</b></td><td><b>Last Modified</b></td><td><b>Size</b></td></tr></thead>' . "\n";
$output .= '<tfoot><tr><td>' . count($files) . ' files</td><td align="right">Total Files Size: </td><td>' .  @byte_convert($totalSize) . '</td></tr></tfoot>' . "\n";
$output .= '<tbody>' . "\n";
$output .= $outRows;
$output .= '</body>' . "\n";
$output .= '</table>';

echo $output;

//function for taking in a number and returning the number 
function byte_convert($bytes)
{
	$symbol = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
	$exp = (int) 0;
	$converted_value = (int) 0;
	if ($bytes > 0) {
	$exp = floor(log($bytes)/log(1024));
	$converted_value = ($bytes/pow(1024,floor($exp)));
	}
	return sprintf('%.2f ' . $symbol[$exp], $converted_value);
}
?>
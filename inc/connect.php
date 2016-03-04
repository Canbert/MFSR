<?php
//this file is used for connecting to the database 

$db_host="localhost";	//local server name default localhost
$db_username="root";	//mysql username default is root.
$db_password="";	//blank if no password is set for mysql.
$db_name="messenger";//database name
$con=mysql_connect($db_host,$db_username,$db_password);

if($con)
{
	if(mysql_select_db("$db_name"))
	{
	}
	else
	{
		die("cannot select DB");
	}
}
else
{
	die('Unable to connect to server'.mysql_error());
}

?>
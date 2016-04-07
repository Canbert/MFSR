<?php
//this file is used for connecting to the database 

$db =  new PDO('mysql:host=localhost;dbname=messenger',"root","");

define( "DB", "mysql:host=localhost;dbname=messenger" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );


$salt = md5("supercalifragilisticexpialidocious");

$minpasslen = 4;
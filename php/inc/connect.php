<?php
//this file is used for connecting to the database 

$db =  new PDO('mysql:host=localhost;dbname=messenger',"root","");

$salt = md5("supercalifragilisticexpialidocious");

$minpasslen = 4;
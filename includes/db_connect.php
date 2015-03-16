<?php
//Create a database connection
$servername = "localhost";
$username = "root";
$password = "root";
$db_name = "blogproject";
//Test connection
try {
    $connection = new PDO("mysql:host=$servername;dbname=$db_name", 
	$username, 
	$password, 
	array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));//Ser till att servern alltid förväntar sig UTF8 format
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }
?>
<?php
session_start();

$dbuser="u715969733_root";	
$dbpassword = "Root1234"; 			
$dbname = "u715969733_bd"; 		
$dbhost="mysql.hostinger.com.br";

$mysqli = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);

if (mysqli_connect_errno()) {
	printf("MySQLi connection FALHOU: ", mysqli_connect_error());
	exit();
}




?>

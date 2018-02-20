<?php 
$host = 'localhost';
$dbname = 'studentdb';
$user = 'root';
$password = '';

try{
$db = new PDO("mysql: host=$host; dbname=$dbname", $user, $password);
}

catch (PDOException $e){
	print "Error!: ".$e->getMessage(). "<br>";
	die();
}
?>
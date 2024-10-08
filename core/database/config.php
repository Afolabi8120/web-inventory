<?php
	
	$dsn = 'mysql:host=localhost; dbname=inventory_db';
	$username = 'root';
	$password = '(Afolabi8120)';

	try{
		$pdo = new PDO($dsn, $username, $password);
	}catch(PDOException $ex){
		echo 'Connection Failed'.$ex->getMessage();
		exit();
	}


?>
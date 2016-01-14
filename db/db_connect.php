<?php
	$host = 'localhost';
	$user = 'mymovies_user';
	$pass = 'secret';
	$db = 'mymovies';
	
	try {
		$dbh = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
	}
?>
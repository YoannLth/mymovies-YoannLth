<?php
	// Paramètres de connexion
	$host = 'localhost';
	$user = 'mymovies_user';
	$pass = 'secret';
	$db = 'mymovies';
	
	$dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
	$dbName = getenv('OPENSHIFT_GEAR_NAME');
	$dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
	
	
	// Connexion
	try {
		$dbh = new PDO("mysql:host=dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();
	}
?>
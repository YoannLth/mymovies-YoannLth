<?php
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../include/functions.php';
	
	// Destruction des variables de session
	$login = 'null';
	session_start();
	session_unset();
	session_destroy();
	redirectionSucces();
?>
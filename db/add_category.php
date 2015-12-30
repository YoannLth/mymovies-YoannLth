<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../functions.php';
	
	// Recupération des données
	$movie_category = $_POST["nameCategory"];
	
	try {
		var_dump($_FILES);
		$nom_fichier_poster = enregistrerAfficheFilm($movie_title, $_FILES);
		
		$stmt = $dbh->prepare("INSERT INTO movie_genre (genre_name) VALUES (:movie_category)");
		$stmt->bindParam(':movie_category', $movie_category);
		$stmt->execute();
		
		// redirection pour eviter le rechargement de la page avec F5 et ainsi ré-insserer les données dans la BD.
		header('Location: ../succes.php');
		die();
		
		
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();	
	}
?>
<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';

	// Recupération des données
	$movie_id = $_GET["id"];
	
	try {		
		$stmt = $dbh->prepare("SELECT * FROM movie WHERE mov_id=:id");
		$stmt->bindParam(':id', $movie_id);
		$stmt->execute();
		$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
		$chemin_fichier = '../' . $resultat['mov_poster'];
		unlink($chemin_fichier);
		
		$stmt = $dbh->prepare("DELETE FROM movie WHERE mov_id=:id");
		$stmt->bindParam(':id', $movie_id);
		$stmt->execute();
		
		// redirection pour eviter le rechargement de la page avec F5 et ainsi ré-insserer les données dans la BD.
		header('Location: ../succes.php');
		die();
		
		
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();	
	}
?>
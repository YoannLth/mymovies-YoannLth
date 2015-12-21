<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';

	// Recupération des données
	$movie_id = $_GET["id"];
	
	try {		
		$stmt = $dbh->prepare("DELETE FROM movie WHERE mov_id=:id");
		$stmt->bindParam(':id', $movie_id);
		$stmt->execute();
		
		// A FAIRE : SUPPRIMER IMAGE!!!! + REVOIR CODE (COMMENTER + REFRACTOR)
		
		// redirection pour eviter le rechargement de la page avec F5 et ainsi ré-insserer les données dans la BD.
		header('Location: ../succes.php');
		die();
		
		
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();	
	}
?>
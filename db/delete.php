<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';

	session_start();
	if (!isset($_SESSION['login'])) {
		$message = "Vous devez être connecté pour pouvoir acceder à cette page";
		$retour = "index.php";
		$message_retour = "Retour au menu";
		
		header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();
	}
	else{
		if(!isset($_GET["id"])){
			$message = "Erreur";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
			exit();	
		}
		else{
			
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
		}
	}
?>
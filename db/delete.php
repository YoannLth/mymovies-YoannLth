<?php

	// Inclusion du script de connexion a la base de données
	include 'db_connect.php';
	// Inclusion du script contenant les fonctions PHP définie pour l'application
	include '../include/functions.php';
	
	session_start();
	
	// Teste si l'utilisateur est bien connecté
	// Redirection si il ne l'est pas
	if (!isset($_SESSION['login'])) {
		$message = "Vous devez être connecté pour pouvoir acceder à cette page";
		$retour = "index.php";
		$message_retour = "Retour au menu";
		
		redirectionEchecDepuisScript($message,$retour,$message_retour);
	}
	else{
		// Test si l'ID est bien renseigné
		// Redirection si il ne l'est pas
		if(!isset($_GET["id"])){
			$message = "Erreur";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			redirectionEchecDepuisScript($message,$retour,$message_retour);
		}
		else{
			
			// Recupération des données
			$movie_id = $_GET["id"];
			$movie_id = htmlspecialchars($movie_id, ENT_QUOTES, 'UTF-8', false);
			
			try {		
				// Récupération des données
				$resultat = recupererInfosFilms($dbh, $movie_id);
				
				// Suppression de l'affiche du film
				$chemin_fichier = '../' . $resultat['mov_poster'];
				unlink($chemin_fichier);
				
				// Suppression du film dans la base de donnée
				$stmt = $dbh->prepare("DELETE FROM movie WHERE mov_id=:id");
				$stmt->bindParam(':id', $movie_id);
				$stmt->execute();
				
				// redirection pour eviter le rechargement de la page avec F5 et ainsi ré-insserer les données dans la BD.
				redirectionSucces();				
				
			} catch (PDOException $e) {
				print "Erreur !: " . $e->getMessage() . "<br/>";
				die();	
			}
		}
	}
	
?>
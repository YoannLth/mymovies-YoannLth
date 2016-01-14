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
		// Test si tout les paramètres necessaires ont bien été données
		// Redirection si il n'y a pas toutes les infos necessaires
		if( count($_POST) != 1){
			$message = "Erreur formulaire";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			redirectionEchecDepuisScript($message,$retour,$message_retour);
		}
		else{
			try {
				// Recupération des données
				$movie_category = htmlspecialchars($_POST["nameCategory"], ENT_QUOTES, 'UTF-8', false);
				
				// Insertion des données dans la BDD
				$stmt = $dbh->prepare("INSERT INTO movie_genre (genre_name) VALUES (:movie_category)");
				$stmt->bindParam(':movie_category', $movie_category);
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
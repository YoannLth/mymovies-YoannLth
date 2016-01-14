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
		// Test si t'ID est bien renseigné
		if(!isset($_GET["id"])){
			$message = "Erreur formulaire";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			redirectionEchecDepuisScript($message,$retour,$message_retour);
		}
		else{
			try {		
				// Recupération des données
				$category_id = htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8', false);
				
				// Recupération des données
				$resultat = recupererGenresFilm_IdGenre($dbh,$category_id);
				$id_current_genre = intval($resultat["genre_id"]);
				
				// Mise a jour des données
				$stmt = $dbh->prepare("UPDATE movie SET mov_genre = null WHERE mov_genre = :genre");
				$stmt->bindParam(':genre', $id_current_genre);
				$stmt->execute();
		
				// Suppression de la catégorie dans la base de données
				$stmt = $dbh->prepare("DELETE FROM movie_genre WHERE genre_id=:id");
				$stmt->bindParam(':id', $category_id);
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
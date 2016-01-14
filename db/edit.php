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
		// Redirection si tout les paramètres ne sont pas renseignés
		if( count($_POST) != 7){
			$message = "Erreur formulaire";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			redirectionEchecDepuisScript($message,$retour,$message_retour);
		}
		else{
			try {
				// Recupération des données
				$movie_id = htmlspecialchars($_POST["id_movie_hidden"], ENT_QUOTES, 'UTF-8', false);
				$movie_title = htmlspecialchars($_POST["movieTitle"], ENT_QUOTES, 'UTF-8', false);
				$movie_short_description = htmlspecialchars($_POST["movieShortDescription"], ENT_QUOTES, 'UTF-8', false);
				$movie_long_description = htmlspecialchars($_POST["movieLongDescription"], ENT_QUOTES, 'UTF-8', false);
				$movie_director = htmlspecialchars($_POST["movieDirector"], ENT_QUOTES, 'UTF-8', false);
				$movie_year = htmlspecialchars($_POST["movieYear"], ENT_QUOTES, 'UTF-8', false);
				$movie_genre = htmlspecialchars($_POST["movieGenre"], ENT_QUOTES, 'UTF-8', false);
				$movie_poster = $_FILES['moviePoster']['name'];
				
				// Récupération des données depuis la base de données
				$resultat = recupererInfosFilms($dbh, $movie_id);
				
				// Supprésion de l'affiche du film actuelle
				$chemin_fichier = '../' . $resultat['mov_poster'];
				unlink($chemin_fichier);
				
				// Enregistrement de la nouvelle affiche
				$nom_fichier_poster = enregistrerAfficheFilm($movie_title, $_FILES);
				
				// Mise a jour des données
				$stmt = $dbh->prepare("UPDATE movie SET mov_name=:movie_title, mov_description_short=:movie_short_description, mov_description_long=:movie_long_description, mov_author=:movie_director, mov_year=:movie_year, mov_poster=:movie_poster, mov_genre = :movie_genre WHERE mov_id=:id");
				$stmt->bindParam(':movie_title', $movie_title);
				$stmt->bindParam(':movie_short_description', $movie_short_description);
				$stmt->bindParam(':movie_long_description', $movie_long_description);
				$stmt->bindParam(':movie_director', $movie_director);
				$stmt->bindParam(':movie_year', $movie_year);
				$stmt->bindParam(':movie_poster', $nom_fichier_poster);
				$stmt->bindParam(':movie_genre', $movie_genre);
				$stmt->bindParam(':id', $movie_id);
				$stmt->execute();
				
				$lastId = strval($dbh->lastInsertId());
				
				// redirection pour eviter le rechargement de la page avec F5 et ainsi ré-insserer les données dans la BD.
				redirectionSucces();
				
				
			} catch (PDOException $e) {
				print "Erreur !: " . $e->getMessage() . "<br/>";
				die();	
			}
		}
	}
	
?>
<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../functions.php';
	
	session_start();
	if (!isset($_SESSION['login'])) {
		$message = "Vous devez être connecté pour pouvoir acceder à cette page";
		$retour = "index.php";
		$message_retour = "Retour au menu";
		
		header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();
	}
	else{
		if( count($_POST) != 6){
			$message = "Erreur formulaire";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();	
		}
		else{
			try {
				// Recupération des données
				$movie_id = $_POST["id_movie_hidden"];
				$movie_title = $_POST["movieTitle"];
				$movie_short_description = $_POST["movieShortDescription"];
				$movie_long_description = $_POST["movieLongDescription"];
				$movie_director = $_POST["movieDirector"];
				$movie_year = $_POST["movieYear"];
				$movie_poster = $_FILES['moviePoster']['name'];
			
				$stmt = $dbh->prepare("SELECT * FROM movie WHERE mov_id=:id");
				$stmt->bindParam(':id', $movie_id);
				$stmt->execute();
				$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
				
				
				$chemin_fichier = '../' . $resultat['mov_poster'];
				unlink($chemin_fichier);
				
				$nom_fichier_poster = enregistrerAfficheFilm($movie_title, $_FILES);
				
				$stmt = $dbh->prepare("UPDATE movie SET mov_name=:movie_title, mov_description_short=:movie_short_description, mov_description_long=:movie_long_description, mov_author=:movie_director, mov_year=:movie_year, mov_poster=:movie_poster WHERE mov_id=:id");
				$stmt->bindParam(':movie_title', $movie_title);
				$stmt->bindParam(':movie_short_description', $movie_short_description);
				$stmt->bindParam(':movie_long_description', $movie_long_description);
				$stmt->bindParam(':movie_director', $movie_director);
				$stmt->bindParam(':movie_year', $movie_year);
				$stmt->bindParam(':movie_poster', $nom_fichier_poster);
				$stmt->bindParam(':id', $movie_id);
				$stmt->execute();
				
				$lastId = strval($dbh->lastInsertId());
				
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
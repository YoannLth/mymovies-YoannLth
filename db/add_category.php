<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../include/functions.php';
	
	session_start();
	if (!isset($_SESSION['login'])) {
		$message = "Vous devez être connecté pour pouvoir acceder à cette page";
		$retour = "index.php";
		$message_retour = "Retour au menu";
		
		header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();
	}
	else{
		if( count($_POST) != 1){
			$message = "Erreur formulaire";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();	
		}
		else{
			try {
				// Recupération des données
				$movie_category = $_POST["nameCategory"];
				
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
		}
	}
?>
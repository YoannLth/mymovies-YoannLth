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
			$message = "Erreur formulaire";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();	
		}
		else{
			try {		
				// Recupération des données
				$category_id = $_GET["id"];
				
				$stmt = $dbh->prepare("SELECT * FROM movie_genre WHERE genre_id=:id");
				$stmt->bindParam(':id', $category_id);
				$stmt->execute();
				$resultat = $stmt->fetch(PDO::FETCH_ASSOC);
				$id_current_genre = intval($resultat["genre_id"]);
				
				$stmt = $dbh->prepare("UPDATE movie SET mov_genre = null WHERE mov_genre = :genre");
				$stmt->bindParam(':genre', $id_current_genre);
				$stmt->execute();
		
				$stmt = $dbh->prepare("DELETE FROM movie_genre WHERE genre_id=:id");
				$stmt->bindParam(':id', $category_id);
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
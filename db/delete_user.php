<?php

	// Inclusion du script de connexion a la base de données
	include 'db_connect.php';
	// Inclusion du script contenant les fonctions PHP définie pour l'application
	include '../include/functions.php';
		
	session_start();
	
	// Teste si l'utilisateur est bien un administrateur
	$role = recupererRoleUtilisateurCourant($dbh,$_SESSION['login']);
	
	// Redirection si non admin
	if ($role != "ADMIN") {
		$message = "Vous devez être Administrateur pour pouvoir acceder à cette fonction";
		$retour = "index.php";
		$message_retour = "Retour au menu";
		
		redirectionEchecDepuisScript($message,$retour,$message_retour);
	}
	else{
		// Test si l'ID est bien renseigné
		if(!isset($_GET["id"])){
			$message = "Erreur";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			redirectionEchecDepuisScript($message,$retour,$message_retour);
		}
		else{
			try {		
				// Recupération des données
				$user_id = htmlspecialchars($_GET["id"], ENT_QUOTES, 'UTF-8', false);
			
				// Suppression de l'utilisateur dans la base de données
				$stmt = $dbh->prepare("DELETE FROM user_mymovies WHERE user_id=:id");
				$stmt->bindParam(':id', $user_id);
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
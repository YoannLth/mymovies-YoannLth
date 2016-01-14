<?php

	// Inclusion du script de connexion a la base de données
	include 'db_connect.php';
	// Inclusion du script contenant les fonctions PHP définie pour l'application
	include '../include/functions.php';
	
	// Test si tout les paramètres necessaires ont bien été données
	// Redirection si il n'y a pas toutes les infos necessaires
	if( count($_POST) != 2){
		$message = "Erreur formulaire";
		$retour = "index.php";
		$message_retour = "Retour au menu";
	
		redirectionEchecDepuisScript($message,$retour,$message_retour);
	}
	else{
		// Recupération des données
		$user_username_script = $_POST["user_username_form"];
		$user_password_script = md5($_POST["user_password_form"]);	
		
		$user_username_script = htmlspecialchars($user_username_script, ENT_QUOTES, 'UTF-8', false);
		$user_password_script = htmlspecialchars($user_password_script, ENT_QUOTES, 'UTF-8', false);
		
		// Recupération des utilisateurs de la table en fonction de l'username entré par l'utilisateur
		$res = recupererInfosUser_Username($dbh,$user_username_script);

		// Redirection si jamais il y a déjà un utilsateur correspondant
		if($res == true){
			$message = "Le nom d'utilisateur existe déja";
			$retour = "inscription.php";
			$message_retour = "Retour a la page d'inscription";
			
			redirectionEchecDepuisScript($message,$retour,$message_retour);
		}
		else{
			try {
				// Insertion des données dans la BDD
				$stmt = $dbh->prepare("INSERT INTO user_mymovies ( user_username, user_password) VALUES (:username, :password)");
				$stmt->bindParam(':username', $user_username_script);
				$stmt->bindParam(':password', $user_password_script);
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
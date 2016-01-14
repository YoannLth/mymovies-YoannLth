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
		$user_username_script = htmlspecialchars($_POST["user_username_form"], ENT_QUOTES, 'UTF-8', false);
		$user_password_script = md5($_POST["user_password_form"]);	
	
		// Récupération des données
		$res = recupererToutesInfosUser_Username($dbh,$user_username_script);
		
		// Test si les données saisie correspondent au données de la base
		if( ($user_username_script != $res["user_username"]) or ($user_password_script != $res["user_password"]) ){
			$message = "Login ou mot de passe incorrect";
			$retour = "connexion.php";
			$message_retour = "Retour a la page de connexion";
			
			redirectionEchecDepuisScript($message,$retour,$message_retour);
		}
		else{
			try {
				// Démarage de la session et redirection
				session_start();
				$_SESSION['login'] = $user_username_script;
							
				redirectionSucces();
				
			} catch (PDOException $e) {
				print "Erreur !: " . $e->getMessage() . "<br/>";
				die();	
			}
		}
	}
	
?>
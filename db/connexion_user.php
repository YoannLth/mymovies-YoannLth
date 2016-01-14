<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../include/functions.php';
	
	if( count($_POST) != 2){
		$message = "Erreur formulaire";
		$retour = "index.php";
		$message_retour = "Retour au menu";
	
		header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();	
	}
	else{
		// Recupération des données
		$user_username_script = $_POST["user_username_form"];
		$user_password_script = md5($_POST["user_password_form"]);	
	
		$query = $dbh->prepare('SELECT * FROM user_mymovies WHERE user_username = :name');
		$query->bindParam(':name', $user_username_script);
		$query->execute();
		$res = $query->fetch(PDO::FETCH_ASSOC);
		
		if( ($user_username_script != $res["user_username"]) or ($user_password_script != $res["user_password"]) ){
			$message = "Login ou mot de passe incorrect";
			$retour = "connexion.php";
			$message_retour = "Retour a la page de connexion";
			
			header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");	
		}
		else{
			try {
				session_start();
				$_SESSION['login'] = $user_username_script;
							
				header('Location: ../succes.php');
				exit();	
				
			} catch (PDOException $e) {
				print "Erreur !: " . $e->getMessage() . "<br/>";
				die();	
			}
		}
	}
?>
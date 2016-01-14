<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../include/functions.php';
		
	session_start();
	
	$role = testSiAdmin($dbh,$_SESSION['login']);
	if ($role != "ADMIN") {
		$message = "Vous devez être Administrateur pour pouvoir acceder à cette fonction";
		$retour = "index.php";
		$message_retour = "Retour au menu";
		
		header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();
	}
	else{
		if( count($_POST) != 2){
			$message = "Erreur formulaire";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
			die();	
		}
		else{
			try {	
				// Recupération des données
				$user_id = $_POST["id_user_hidden"];
				$user_role = $_POST["userRole"];
				
				$stmt = $dbh->prepare("UPDATE user_mymovies SET user_role=:role WHERE user_id=:id");
				$stmt->bindParam(':role', $user_role);
				$stmt->bindParam(':id', $user_id);
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
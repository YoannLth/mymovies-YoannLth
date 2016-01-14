<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';

	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../include/functions.php';
		
	session_start();
	
	// Teste si l'utilisateur est bien un administrateur
	$role = recupererRoleUtilisateurCourant($dbh,$_SESSION['login']);
	if ($role != "ADMIN") {
		$message = "Vous devez être Administrateur pour pouvoir acceder à cette fonction";
		$retour = "index.php";
		$message_retour = "Retour au menu";
		
		header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();
	}
	else{
		// Test si l'ID est bien renseigné
		if(!isset($_GET["id"])){
			$message = "Erreur";
			$retour = "index.php";
			$message_retour = "Retour au menu";
		
			header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();	
		}
		else{
			try {		
				// Recupération des données
				$user_id = $_GET["id"];
			
				$stmt = $dbh->prepare("DELETE FROM user_mymovies WHERE user_id=:id");
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
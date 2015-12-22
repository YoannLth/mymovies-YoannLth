<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../functions.php';
	
	// Recupération des données
	$user_username_script = $_POST["user_username_form"];
	$user_password_script = md5($_POST["user_password_form"]);	

	$query = $dbh->prepare('SELECT * FROM user_mymovies WHERE user_username = :name');
	$query->bindParam(':name', $user_username_script);
	$query->execute();
	$res = $query->rowCount();
	
	if($res!=0){
		$message = "Le nom d'utilisateur existe déja";
		header("Location: ../failure.php?message=$message");	
	}
	else{
		try {
			$stmt = $dbh->prepare("INSERT INTO user_mymovies ( user_username, user_password) VALUES (:username, :password)");
			$stmt->bindParam(':username', $user_username_script);
			$stmt->bindParam(':password', $user_password_script);
			$stmt->execute();
			
			// redirection pour eviter le rechargement de la page avec F5 et ainsi ré-insserer les données dans la BD.
			header('Location: ../succes.php');
			die();
			
			
		} catch (PDOException $e) {
			print "Erreur !: " . $e->getMessage() . "<br/>";
			die();	
		}
	}
?>
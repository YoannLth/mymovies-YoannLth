<?php
	function enregistrerAfficheFilm($nomFilm, $fichier)
	{
		$rand = rand(0,1000);
		$nomFilm = preg_replace('/[^A-Za-z0-9\-]/', '_', $nomFilm);
		$nomFilm = $nomFilm . $rand . '.png';
		
		$emplacementEnregistrement = "../images/$nomFilm";
		$emplacementdbh = "images/$nomFilm";
		move_uploaded_file($fichier['moviePoster']['tmp_name'],$emplacementEnregistrement);
		
		return $emplacementdbh;
	}
	
	function recupererInfosFilms($dbh, $id_film){
		$stmt = $dbh->prepare("SELECT * FROM movie WHERE mov_id = :id");
		$stmt->bindParam(':id', $id_film);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
	
	function recupererInfosUser($dbh, $id_user){
		$stmt = $dbh->prepare("SELECT user_id,user_username,user_role FROM user_mymovies WHERE user_id = :id");
		$stmt->bindParam(':id', $id_user);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
	
	function testSiAdmin($dbh,$login){
		$stmt = $dbh->prepare("SELECT user_id,user_username,user_role FROM user_mymovies WHERE user_username = :username");
		$stmt->bindParam(':username', $login);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		$role = $res["user_role"];
		return $role;
	}
	
	function testSiUtilisateurExiste($dbh,$login){
		$stmt = $dbh->prepare("SELECT user_id,user_username FROM user_mymovies WHERE user_username = :username");
		$stmt->bindParam(':username', $login);
		$stmt->execute();
		$res = $stmt->fetchAll();
		
		if(count($res) == 0){
			$login = 'null';
			session_start();
			session_unset();
			session_destroy();
			header('Location: index.php');
			exit();
		}
		else{
		}
	}
?>
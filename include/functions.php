<?php
	// Fonction qui récupère les infos d'un film depuis la base de données en fonction de l'ID et retourne les résultat dans un tableau
	function recupererInfosFilms($dbh, $id_film){
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT * FROM movie WHERE mov_id = :id");
		$stmt->bindParam(':id', $id_film);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
	
	// Fonction qui récupère les infos des films depuis la base de données et retourne les résultats dans un tableau
	function recupererInfosFilmsGlobal($dbh){
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT * FROM movie");
		$stmt->execute();
		$res = $stmt->fetchAll();	
		return $res;
	}
	
	// Fonction qui récupère les infos d'un utilisateur depuis la base de données en fonction de l'ID et retourne les résultat dans un tableau
	function recupererInfosUser($dbh, $id_user){
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT user_id,user_username,user_role FROM user_mymovies WHERE user_id = :id");
		$stmt->bindParam(':id', $id_user);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
	
	// Fonction qui récupère les infos d'un utilisateur depuis la base de données en fonction du nom d'utilisateur et retourne le résultat dans un tableau
	function recupererInfosUser_Username($dbh,$login){
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT user_id,user_username,user_role FROM user_mymovies WHERE user_username = :username");
		$stmt->bindParam(':username', $login);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);	
		return $res;
	}
	
	// Fonction qui récupère les infos d'un utilisateur depuis la base de données en fonction du nom d'utilisateur et retourne le résultat dans un tableau
	function recupererToutesInfosUser_Username($dbh,$login){
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT * FROM user_mymovies WHERE user_username = :name");
		$stmt->bindParam(':name', $login);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);	
		return $res;
	}
	
	// Fonction qui récupère les infos d'un utilisateur depuis la base de données en fonction du nom d'utilisateur et retourne les résultat dans un tableau
	function recupererRoleUtilisateurCourant($dbh,$login){
		// Recuperation d'information dans la base de données
		$res = recupererInfosUser_Username($dbh,$login);
		$role = $res["user_role"];
		return $role;
	}
	
	// Fonction qui récupère les infos des genres de films depuis la base de données et retourne les résultats dans un tableau
	function recupererGenresFilm($dbh){
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT * FROM movie_genre");
		$stmt->execute();
		$res = $stmt->fetchAll();	
		return $res;
	}
	
	// Fonction qui récupère les infos des genres de films depuis la base de données et retourne les résultats dans un tableau
	function recupererGenresFilm_IdGenre($dbh,$idGenre){
		$stmt = $dbh->prepare("SELECT * FROM movie_genre WHERE genre_id=:id");
		$stmt->bindParam(':id', $idGenre);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
	}


				
	//
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	//
	
	// Fonction qui affiche un tableau des films
	function afficheTableauFilmsAdmin($dbh){
		// Recuperation d'information dans la base de données
		$result = recupererInfosFilmsGlobal($dbh);
		
		// Boucle d'affichage
		foreach($result as $res){
			$id = $res['mov_id'];
			$name = $res['mov_name'];
			$director = $res['mov_author'];
			$year = $res['mov_year'];
			echo "<tr>";
			echo "<td>$id</td>";
			echo "<td>$name</td>";
			echo "<td>$director</td>";
			echo "<td>$year</td>";
			echo "<td>";
			echo "<a type=\"button\" class=\"btn btn-info btn-xs btn_space\" href=\"edition.php?id=$id\">";
			echo "<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>";
			echo "</a>";
			echo "<a type=\"button\" class=\"btn btn-danger btn-xs\" href=\"#\" onclick=\"delete_movie($id)\">";
			echo "<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
			echo "</a>";
			echo "</td>";
			echo "</tr>";
		}	
	}
	
	// Fonction qui affiche un tableau des utilisateurs (Sauf utilisateur courant)
	function afficheTableauUtilisateursAdmin($dbh){
		// Recuperation du nom d'utilisateur de l'utilisateur courant
		$user_current = $_SESSION['login'];
		
		// Recuperation d'information dans la base de données
		$resSQL = recupererInfosUser_Username($dbh,$user_current);
		$id_current = intval($resSQL["user_id"]);
		
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT user_id,user_username,user_role FROM user_mymovies WHERE user_id != :curr_id");
		$stmt->bindParam(':curr_id', $id_current);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		// Boucle d'affichage
		foreach($result as $res){
			$id = $res['user_id'];
			$username = $res['user_username'];
			$role = $res['user_role'];
			echo "<tr>";
			echo "<td>$id</td>";
			echo "<td>$username</td>";
			echo "<td>$role</td>";
			echo "<td>";
			echo "<a type=\"button\" class=\"btn btn-info btn-xs btn_space\" href=\"edition_user.php?id=$id\">";
			echo "<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>";
			echo "</a>";
			echo "<a type=\"button\" class=\"btn btn-danger btn-xs\" href=\"#\" onclick=\"delete_user($id)\">";
			echo "<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
			echo "</a>";
			echo "</td>";
			echo "</tr>";
		}
	}
	
	// Fonction qui affiche un tableau des genres
	function afficheTableauGenresAdmin($dbh){
		// Recuperation d'information dans la base de données
		$result = recupererGenresFilm($dbh);
		
		// Boucle d'affichage
		foreach($result as $res){
			$id = $res['genre_id'];
			$genre = $res['genre_name'];
			echo "<tr>";
			echo "<td>$id</td>";
			echo "<td>$genre</td>";
			echo "<td>";
			echo "<a type=\"button\" class=\"btn btn-danger btn-xs\" href=\"#\" onclick=\"delete_category($id)\">";
			echo "<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
			echo "</a>";
			echo "</td>";
			echo "</tr>";
		}	
	}
	
	// Fonction qui affiche les différents genre dans film dans une selectlist
	function afficherGenreFilmEdition($dbh,$movie_genre){
		// Recuperation d'information dans la base de données
		$result = recupererGenresFilm($dbh);
		
		// Boucle d'affichage
		foreach($result as $res){
			$genre = $res['genre_name'];
			$genre_id = $res['genre_id'];
			// Si le genre de la boucle correspond au genre du film a editer alors on le selectionne pour l'affichage
			if($movie_genre == $genre_id){
				echo "<option value=\"$genre_id\" selected>$genre</option>";	
			}
			else{
				echo "<option value=\"$genre_id\">$genre</option>";
			}
		}	
	}
	
	// Fonction qui affiche les différents genre dans film dans des checkbox
	function afficherChexboxListGenre($dbh){
		// Recuperation d'information dans la base de données
		$result = recupererGenresFilm($dbh);
		
		// Boucle d'affichage
		foreach($result as $res){
			$id_genre = $res['genre_id'];
			$name_genre = $res['genre_name'];
			echo "<li>";
			echo"<span> </span><input type=\"checkbox\" id=\"f4\" data-genre=\"$name_genre\" value=\"$name_genre\"> $name_genre";
			echo "</li>";
		}	
	}
	
	// Foncti qui affiche la liste des films et les genres associés
	function afficherFilmsEtGenresIndex($dbh){
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT * FROM movie LEFT JOIN movie_genre on movie.mov_genre = movie_genre.genre_id ");
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		// Boucle d'affichage
		foreach($result as $res){
			$id = $res['mov_id'];
			$name = $res['mov_name'];
			$short_desc = $res['mov_description_short'];
			$genre = $res['genre_name'];
			echo "<div class=\"container containerMovie\" data-genre=\"$genre\">";
			echo"<h2><a href=\"movie.php?id=$id\">$name</a></h2>";
			echo"<h4>$genre</h4>";
			echo "<p>$short_desc</p>";
			echo "</div>";
		}	
	}
	
	// Fonction qui affiche les informations d'un film en fonction de son ID
	function afficherDetailsFilm($dbh){
		// Recuperation d'information dans la base de données
		$id = $_GET["id"];
		$stmt = $dbh->prepare("SELECT * FROM movie LEFT JOIN movie_genre on movie.mov_genre = movie_genre.genre_id WHERE mov_id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($res == false){
			$message = "Erreur : Film inconnu";
			$retour = "index.php";
			$message_retour = "Retour au menu";
			
			redirectionEchec($message,$retour,$message_retour);	
		}
		else{
			// Recupération des resultats dans des variables
			$movie_poster = $res["mov_poster"];
			$movie_title = $res["mov_name"];
			$movie_director = $res["mov_author"];
			$movie_year = $res["mov_year"];
			$movie_long_desc = $res["mov_description_long"];
			$movie_genre = $res["genre_name"];
			
			// Affichage des details du film
			echo "<img class=\"img-responsive img-rounded\" alt=\"Responsive image\" src=\"$movie_poster\" style=\"border: 8px solid white; box-shadow: 2px 2px 2px 2px #999;\">";
			echo "</div>";
			echo "<div class=\"col-md-6\">";
			echo "<h2 class=\"movie_h2\">$movie_title</h2>";
			echo "<h3>$movie_director, $movie_year</h3>";
			if(count($movie_genre) != 0){
			echo "<h5>Genre : $movie_genre</h5>";
			}
			echo "<p class=\"text-justify movie_p\">$movie_long_desc</p>";
			echo "<a type=\"button\" class=\"btn btn-primary\" href=\"edition.php?id=$id\"><span class=\"glyphicon glyphicon-edit\"></span> Editer</a>";
		}
	}
	
	// Fonction qui affiche la liste des roles dans une selectlist
	function afficherSelectListUsers($dbh){
		// Recuperation d'information dans la base de données
		$stmt = $dbh->prepare("SELECT DISTINCT user_role FROM user_mymovies");
		$stmt->execute();
		$roles = $stmt->fetchAll();
		
		if(count($roles) != 1){
			foreach($roles as $r){
				$value = $r['user_role'];
				echo '<option value="'.$value.'" '.(($value==$user_role)?'selected="selected"':"").'>'.$value.'</option>';
			}
		}
		else{
			
			echo '<option value="ADMIN" '.(($user_role=='ADMIN')?'selected="selected"':"").'>ADMIN</option>';
			echo '<option value="VISITOR" '.(($user_role=='VISITOR')?'selected="selected"':"").'>VISITOR</option>';
		}	
	}
	
	// Fonction qui remplie une select list avec la liste des genres de film
	function remplirSelectlistAjoutFilm($dbh){
		// Recuperation d'information dans la base de données
		$result = recupererGenresFilm($dbh);
		
		// Boucle d'affichage
		foreach($result as $res){
				$genre = $res['genre_name'];
				$genre_id = $res['genre_id'];
				echo "<option value=\"$genre_id\">$genre</option>";
			}	
	}
	
	//
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	//
	
	// Fonction qui teste si l'utilisateur est connecté et le redirige au menu si vrai
	function testSiDejaConnecte(){
		// Demarrage d'une session
		session_start();
		
		// Teste si la variable de session login existe
		if (isset($_SESSION['login'])) {
			$message = "Vous devez être déconnecté pour pouvoir acceder à cette page";
			$retour = "index.php";
			$message_retour = "Retour au menu";
			
			// Redirection
			redirectionEchec($message,$retour,$message_retour);
		}
		else{
		}
	}
	
	// Fonction qui teste si l'utilisateur est connecté et le redirige au menu si faux
	function testSiConnecte(){
		// Demarrage d'une session
		session_start();
		
		// Teste si la variable de session login existe
		if (!isset($_SESSION['login'])) {
			$message = "Vous devez être connecté pour pouvoir acceder à cette page";
			$retour = "index.php";
			$message_retour = "Retour au menu";
			
			redirectionEchec($message,$retour,$message_retour);
		}
		else{
		}	
	}
	
	// Fonction qui teste si l'utilisateur courant est Administrateur. Redirection si faux
	function testSiAdminVuePage($dbh){
		// Récupération du role de l'utilisateur courant
		$role = recupererRoleUtilisateurCourant($dbh,$_SESSION['login']);
		
		// Redirection si l'utilisateur n'est pas un administrateur
		if ($role != "ADMIN") {
			$message = "Vous devez être Administrateur pour pouvoir acceder à cette page";
			$retour = "index.php";
			$message_retour = "Retour au menu";
			
			header("Location: failure.php?message=$message&url=$retour&message_retour=$message_retour");
			exit();
		}
		else{
		}	
	}
	
	// Fonction qui teste si un id de film est bien selectionné pour l'édition. Redirection si faux
	function testSiIdEditionFilm(){
		if(!isset($_GET["id"])){
			redirectionEchec("Erreur formulaire : Aucun film sélectionné","index.php","Retour au menu");	
		}
		else{		
		}
	}
	
	// Fonction qui teste si une session est en cours et en démarre une sinon
	function testSiSessionEnCours(){
		if(!isset($_SESSION)) 
		{ 
			session_start();
		} 
		else{
		}
	}
	
	//
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	// -----------------------------------------------------------------------------------------------
	//	
	
	// Fonction qui enregistre l'affiche d'un film dans un dossier du site
	function enregistrerAfficheFilm($nomFilm, $fichier)
	{
		// Géneration d'un nom aléatoire
		$rand = rand(0,1000);
		// Suppression des caractères spéciaux du nom du fichier
		$nomFilm = preg_replace('/[^A-Za-z0-9\-]/', '_', $nomFilm);
		// Normalisation du nom du fichier avec : le nom du film + le nombre généré (Evite que deux affiches portent le meme nom de fichier)
		$nomFilm = $nomFilm . $rand . '.png';
		
		// Enregistrement dans le dossier du site
		$emplacementEnregistrement = "../images/$nomFilm";
		$emplacementdbh = "images/$nomFilm";
		move_uploaded_file($fichier['moviePoster']['tmp_name'],$emplacementEnregistrement);
		
		// Retourne l'emplacement du fichier
		return $emplacementdbh;
	}
	
	// Fonction qui redirige vers une page d'erreur et affiche un message d'erreur ainsi qu'un lien de redrection
	function redirectionEchec($msg,$page_retour,$msg_retour){
		$message = $msg;
		$retour = $page_retour;
		$message_retour = $msg_retour;
		
		// Redirection
		header("Location: failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();	
	}	
	
	// Fonction qui redirige vers une page d'erreur et affiche un message d'erreur ainsi qu'un lien de redrection
	function redirectionEchecDepuisScript($msg,$page_retour,$msg_retour){
		$message = $msg;
		$retour = $page_retour;
		$message_retour = $msg_retour;
		
		// Redirection
		header("Location: ../failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();	
	}
	
	// Fonction qui redirige vers une page d'erreur et affiche un message d'erreur ainsi qu'un lien de redrection
	function redirectionSucces(){
		// Redirection
		header("Location: ../succes.php");
		exit();	
	}
	
?>
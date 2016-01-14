<?php
	// Fonction qui récupère les infos d'un film depuis la base de données en fonction de l'ID et retourne les résultat dans un tableau
	function recupererInfosFilms($dbh, $id_film){
		$stmt = $dbh->prepare("SELECT * FROM movie WHERE mov_id = :id");
		$stmt->bindParam(':id', $id_film);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
	
	// Fonction qui récupère les infos d'un utilisateur depuis la base de données en fonction de l'ID et retourne les résultat dans un tableau
	function recupererInfosUser($dbh, $id_user){
		$stmt = $dbh->prepare("SELECT user_id,user_username,user_role FROM user_mymovies WHERE user_id = :id");
		$stmt->bindParam(':id', $id_user);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		return $res;
	}
	
	// Fonction qui récupère les infos d'un utilisateur depuis la base de données en fonction du nom d'utilisateur et retourne les résultat dans un tableau
	function recupererRoleUtilisateurCourant($dbh,$login){
		$stmt = $dbh->prepare("SELECT user_id,user_username,user_role FROM user_mymovies WHERE user_username = :username");
		$stmt->bindParam(':username', $login);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		$role = $res["user_role"];
		return $role;
	}
	
	function remplirSelectlistAjoutFilm($dbh){
		$stmt = $dbh->prepare("SELECT * FROM movie_genre");
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $res){
				$genre = $res['genre_name'];
				$genre_id = $res['genre_id'];
				echo "<option value=\"$genre_id\">$genre</option>";
			}	
	}
	
	
	
	function recupererGenresFilm($dbh){
		$stmt = $dbh->prepare("SELECT * FROM movie_genre");
		$stmt->execute();
		$result = $stmt->fetchAll();	
		
		return $result;
	}
	
	
	



	// Fonction qui teste si l'utilisateur est connecté et le redirige au menu si vrai
	function testSiDejaConnecte(){
		session_start();
		if (isset($_SESSION['login'])) {
			$message = "Vous devez être déconnecté pour pouvoir acceder à cette page";
			$retour = "index.php";
			$message_retour = "Retour au menu";
			
			header("Location: failure.php?message=$message&url=$retour&message_retour=$message_retour");
			exit();
		}
		else{
		}
	}
	
	// Fonction qui teste si l'utilisateur est connecté et le redirige au menu si faux
	function testSiConnecte(){
		session_start();
		if (!isset($_SESSION['login'])) {
			$message = "Vous devez être connecté pour pouvoir acceder à cette page";
			$retour = "index.php";
			$message_retour = "Retour au menu";
			
			header("Location: failure.php?message=$message&url=$retour&message_retour=$message_retour");
			exit();
		}
		else{
		}	
	}
	
	
	// Fonction qui teste si l'utilisateur courant est Administrateur. Redirection si faux
	function testSiAdminVuePage($dbh){
		$role = recupererRoleUtilisateurCourant($dbh,$_SESSION['login']);
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
	
	// Fonction qui teste si un film est bien selectionné pour l'édition
	function testSiSessionEnCours(){
		if(!isset($_SESSION)) 
		{ 
			session_start();
		} 
		else{
	
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function afficheTableauFilmsAdmin($dbh){
		$stmt = $dbh->prepare("SELECT * FROM movie");
		$stmt->execute();
		$result = $stmt->fetchAll();
		
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
	
	function afficheTableauUtilisateursAdmin($dbh){
		$stmt = $dbh->prepare("SELECT user_id FROM user_mymovies WHERE user_username = :username");
		$stmt->bindParam(':username', $_SESSION['login']);
		$stmt->execute();
		$resSQL = $stmt->fetch(PDO::FETCH_ASSOC);
		$id_current = intval($resSQL["user_id"]);
		
		$stmt = $dbh->prepare("SELECT user_id,user_username,user_role FROM user_mymovies WHERE user_id != :curr_id");
		$stmt->bindParam(':curr_id', $id_current);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
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
	
	function afficheTableauGenresAdmin($dbh){
		$stmt = $dbh->prepare("SELECT * FROM movie_genre");
		$stmt->execute();
		$result = $stmt->fetchAll();
		
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
	
	
	function afficherGenreFilmEdition($dbh,$movie_genre){
		$result = recupererGenresFilm($dbh);
		
		foreach($result as $res){
			$genre = $res['genre_name'];
			$genre_id = $res['genre_id'];
			if($movie_genre == $genre_id){
				echo "<option value=\"$genre_id\" selected>$genre</option>";	
			}
			else{
				echo "<option value=\"$genre_id\">$genre</option>";
			}
		}	
	}
	
	function afficherChexboxListGenre($dbh){
		$result = recupererGenresFilm($dbh);
		
		foreach($result as $res){
			$id_genre = $res['genre_id'];
			$name_genre = $res['genre_name'];
			echo "<li>";
			echo"<span> </span><input type=\"checkbox\" id=\"f4\" data-genre=\"$name_genre\" value=\"$name_genre\"> $name_genre";
			echo "</li>";
		}	
	}
	
	function afficherFilmsEtGenresIndex($dbh){
		$stmt = $dbh->prepare("SELECT * FROM movie LEFT JOIN movie_genre on movie.mov_genre = movie_genre.genre_id ");
		$stmt->execute();
		$result = $stmt->fetchAll();
		
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
	
	function afficherDetailsFilm($dbh){
		$id = $_GET["id"];
		$stmt = $dbh->prepare("SELECT * FROM movie LEFT JOIN movie_genre on movie.mov_genre = movie_genre.genre_id WHERE mov_id = :id");
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$res = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$movie_poster = $res["mov_poster"];
		$movie_title = $res["mov_name"];
		$movie_director = $res["mov_author"];
		$movie_year = $res["mov_year"];
		$movie_long_desc = $res["mov_description_long"];
		$movie_genre = $res["genre_name"];
		
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
	
	function afficherSelectListUsers($dbh){
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
	

	
	
	function redirectionEchec($msg,$page_retour,$msg_retour){
		$message = $msg;
		$retour = $page_retour;
		$message_retour = $msg_retour;
		
		header("Location: failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
?>
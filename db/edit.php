<?php
	// Inclusion du script PHP pour générer la Navbar
	include 'db_connect.php';
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include '../functions.php';
	
	// Recupération des données
	$movie_id = $_POST["id_movie_hidden"];
	$movie_title = $_POST["movieTitle"];
	$movie_short_description = $_POST["movieShortDescription"];
	$movie_long_description = $_POST["movieLongDescription"];
	$movie_director = $_POST["movieDirector"];
	$movie_year = $_POST["movieYear"];
	$movie_poster = $_FILES['moviePoster']['name'];
	
	try {
		var_dump($_FILES);
		$nom_fichier_poster = enregistrerAfficheFilm($movie_title, $_FILES);
		
		$stmt = $dbh->prepare("INSERT INTO movie ( mov_name, mov_description_short, mov_description_long, mov_author, mov_year, mov_poster) VALUES (:movie_title, :movie_short_description, :movie_long_description, :movie_director, :movie_year, :movie_poster)");
		$stmt->bindParam(':movie_title', $movie_title);
		$stmt->bindParam(':movie_short_description', $movie_short_description);
		$stmt->bindParam(':movie_long_description', $movie_long_description);
		$stmt->bindParam(':movie_director', $movie_director);
		$stmt->bindParam(':movie_year', $movie_year);
		$stmt->bindParam(':movie_poster', $nom_fichier_poster);
		$stmt->execute();
		
		$lastId = strval($dbh->lastInsertId());
		
		// redirection pour eviter le rechargement de la page avec F5 et ainsi ré-insserer les données dans la BD.
		header('Location: ../succes.php');
		die();
		
		
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage() . "<br/>";
		die();	
	}
?>
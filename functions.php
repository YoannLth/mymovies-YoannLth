<?php
	function enregistrerAfficheFilm($nomFilm, $fichier)
	{
		$rand = rand(0,1000);
		$nomFilm = preg_replace('/[^A-Za-z0-9\-]/', '_', $nomFilm);
		$nomFilm = $nomFilm . $rand . '.png';
		
		$emplacementEnregistrement = "../images/$nomFilm";
		$emplacementDB = "images/$nomFilm";
		move_uploaded_file($fichier['moviePoster']['tmp_name'],$emplacementEnregistrement);
		
		return $emplacementDB;
	}
?>
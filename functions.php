<?php
	function enregistrerAfficheFilm($nomFilm, $idFilm, $fichier)
	{
		$nomFilm = preg_replace('/[^A-Za-z0-9\-]/', '_', $nomFilm);
		$nomFilm = $nomFilm . $idFilm . '.png';
		
		$emplacement = "../images/$nomFilm";
		move_uploaded_file($fichier['moviePoster']['tmp_name'],$emplacement);
		
		return $nomFilm;
	}
?>
// JavaScript Document

// Fonction JS pour lancer une requete parametré sur le site "TheMovieDB" pour obtenir des infos sur le film
function chercherInfos(){
	var url1 = "https://www.themoviedb.org/search?language=fr&query=";
	var url2 = $('#movieTitle').val();
	var url = url1 + url2;
	window.open(url,'_blank');
}
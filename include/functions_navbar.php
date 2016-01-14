<?php
	// Fonction PHP qui teste si l'utilisateur en cours est toujours présent dans la base de données, détruit la session sinon
	// Utile dans le cas d'un banissement par exemple car si jamais un utilisateur est bani, et donc plus dans la base de donnée, il sera déconnecté de force
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
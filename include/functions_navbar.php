<?php
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
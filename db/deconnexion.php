<?php
	$login = 'null';
	session_start();
	session_unset();
	session_destroy();
	header('Location: ../succes.php');
	exit();
?>
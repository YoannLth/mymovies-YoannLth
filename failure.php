<?php		
	// Inclusion du script contenant les fonctions PHP définie pour l'application
	include 'include/functions.php';
	
	testSiSessionEnCours();
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="lib/Bootstrap%203.5/css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/style.css" rel="stylesheet">
        <title>Erreur</title>
    </head>

    <body>
    	
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
			
			$message = htmlspecialchars($_GET["message"], ENT_QUOTES, 'UTF-8', false);
			$url = htmlspecialchars($_GET["url"], ENT_QUOTES, 'UTF-8', false);
			$message_retour = htmlspecialchars($_GET["message_retour"], ENT_QUOTES, 'UTF-8', false);
        ?>

		<div class="container">
        	<div class="alert alert-danger text-center" role="alert">
              <?php echo $message ?>
              <br />
              <br />
              <a href="<?php echo $url ?>" class="alert-link"><?php echo $message_retour ?></a>              
            </div>
            
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
        </div>
    </body>
</html>

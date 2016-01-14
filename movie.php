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
        <title>Details du film</title>
    </head>

    <body>
    
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
			
			// Inclusion du script de connexion a la base de données
			include 'db/db_connect.php';
        ?>
        
        <!-- Affichage global de la page -->
		<div class="container">
        	<div class="jumbotron">
            	<!-- Details du film -->
            	<div class="container">
                    <div class="col-md-6">
						<?php
                            afficherDetailsFilm($dbh);
                        ?>                        
					</div>  
            	</div>              
            </div>
            
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
        </div>
    </body>
</html>

<?php		
	// Inclusion du script contenant les fonctions PHP définie pour l'application
	include 'include/functions.php';		
	testSiConnecte();
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="lib/Bootstrap%203.5/css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/style.css" rel="stylesheet">
        <title>Ajouter une catégorie</title>
    </head>

    <body>
    	
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
        ?>
        
		<!-- Vue globale de la page --> 
		<div class="container">
            
            <h2 class="text-center black">Ajout d'une catégorie</h2>
            <div class="well">
            	<!-- Formulaire d'ajout d'une catégorie --> 
                <form class="form-horizontal" role="form" action="db/add_category.php" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nom catégorie</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nameCategory" value="" placeholder="Entrez le titre de la catégorie" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="col-sm-4 col-sm-offset-4">
                    	<button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Enregistrer</button>
                        </div>
                    </div>
                </form>        
            </div>
            
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
        </div>
      	
        <script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script>
    </body>
</html>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="lib/Bootstrap%203.5/css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/style.css" rel="stylesheet">
        <title>Inscription</title>
    </head>

    <body>
    	
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
			// Inclusion du script PHP pour générer la Navbar
			include 'db/db_connect.php';
        ?>

		<div class="container">
            
            <h2 class="text-center black">Inscription</h2>
            <div class="well">
                <form class="form-horizontal" id="formulaire_inscription" role="form" action="db/add_user.php" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nom utilisateur</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="user_username_form" value="" pattern=".{5,15}" placeholder="Entrez un nom d'utilisateur (entre 5 et 15 caractères)" required autofocus></input>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="col-sm-4 control-label">Mot de passe</label>
                    	<div class="col-sm-6">
                    		<input type="password" class="form-control" name="user_password_form" pattern=".{6,15}" placeholder="Entrez un mdp (entre 6 et 15 caractères)" required></input>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-sm-4 col-sm-offset-4">
                    	<button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Valider</button>
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

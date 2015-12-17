<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="lib/Bootstrap%203.5/css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/style.css" rel="stylesheet">
        <title>Ajouter un film</title>
    </head>

    <body>
    	
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
        ?>

		<div class="container">
            
            <h2 class="text-center">Ajout d'un film</h2>
            <div class="well">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="movie-add.php" method="post">
                    <input type="hidden" name="id" value="">
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Titre</label>
                    <div class="col-sm-6">
                    <input type="text" name="title" value="" class="form-control" placeholder="Entrez le titre du film" required autofocus>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Description courte</label>
                    <div class="col-sm-6">
                    <textarea name="shortDescription" class="form-control" placeholder="Entrez sa description courte" required></textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Description longue</label>
                    <div class="col-sm-6">
                    <textarea name="longDescription" class="form-control" rows="6" placeholder="Entrez sa description longue" required></textarea>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Réalisateur</label>
                    <div class="col-sm-6">
                    <input type="text" name="director" value="" class="form-control" placeholder="Entrez son réalisateur" required>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Année de sortie</label>
                    <div class="col-sm-4">
                    <input type="number" name="year" value="" class="form-control" placeholder="Entrez son année de sortie" required>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-4 control-label">Image</label>
                    <div class="col-sm-4">
                    <input type="file" name="image"/>
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-4">
                    <button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Enregistrer</button>
                    </div>
                    </div>
                </form>        
            </div>
            
            <hr>
        	<p class="text-center">Construit avec <span class="glyphicon glyphicon-heart"></span> par <a href="https://fr.linkedin.com/in/yoann-lathuiliere-05b716a9">Yoann Lathuiliere</a></p>
        </div>
      	
        <script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script>
    </body>
</html>

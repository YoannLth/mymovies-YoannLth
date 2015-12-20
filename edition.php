<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="lib/Bootstrap%203.5/css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/style.css" rel="stylesheet">
        <title>Editer un film</title>
    </head>

    <body>
    	
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
			
			// Inclusion du script de connexion a la base de données
			include 'db/db_connect.php';
			
			// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
			include 'functions.php';
			
			$id = $_GET["id"];
			
			$result = recupererInfosFilms($dbh, $id);
			
			$movie_title = $result['mov_name'];
			$movie_description_short = $result['mov_description_short'];
			$movie_description_long = $result['mov_description_long'];
			$movie_author = $result['mov_author'];
			$movie_year = $result['mov_year'];
        ?>

		<div class="container">
            
            <h2 class="text-center black">Edition d'un film</h2>
            <div class="well">
                <form class="form-horizontal" role="form" action="db/edit.php" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Titre</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="movieTitle" value="<?php echo $movie_title; ?>" placeholder="Entrez le titre du film" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="col-sm-4 control-label">Description courte</label>
                    	<div class="col-sm-6">
                    		<textarea class="form-control" name="movieShortDescription" placeholder="Entrez sa description courte" required><?php echo $movie_description_short; ?></textarea>
                    	</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Description longue</label>
                        <div class="col-sm-6">
                        	<textarea class="form-control" name="movieLongDescription" rows="7" placeholder="Entrez sa description longue" required><?php echo $movie_description_long; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Réalisateur</label>
                        <div class="col-sm-6">
                        	<input type="text" class="form-control" name="movieDirector" value="<?php echo $movie_author; ?>" placeholder="Entrez son réalisateur" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Année de sortie</label>
                        <div class="col-sm-4">
                        	<input type="number" name="movieYear" value="<?php echo $movie_year; ?>" class="form-control" placeholder="Entrez son année de sortie" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Image</label>
                        <div class="col-sm-4">
                        	<input type="file" name="moviePoster" required/>
                        </div>
                    </div>
                    <div class="form-group">
                    	<div class="col-sm-4 col-sm-offset-4">
                    	<button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Enregistrer</button>
                    	<a type="button" href="https://www.themoviedb.org/?language=fr" target="_blank" class="btn btn-default btn-success"><span class="glyphicon glyphicon-search"></span> Infos films</a>
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
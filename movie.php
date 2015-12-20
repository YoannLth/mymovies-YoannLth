<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="lib/Bootstrap%203.5/css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/style.css" rel="stylesheet">
        <title>MyMovies - X-Men : Days of Future Past</title>
    </head>

    <body>
    
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
			
			// Inclusion du script de connexion a la base de données
			include 'db/db_connect.php';
        ?>
        
		<div class="container">
        	<div class="jumbotron">
            	<div class="container">
                    <div class="col-md-6">
						<?php
                            $id = $_GET["id"];
                            $sth = $dbh->prepare("SELECT * FROM movie WHERE mov_id = :id");
                            $sth->bindParam(':id', $id);
                            $sth->execute();
                            $res = $sth->fetch(PDO::FETCH_ASSOC);
                            
                            //var_dump($res);
							$movie_poster = $res["mov_poster"];
							$movie_title = $res["mov_name"];
							$movie_director = $res["mov_author"];
							$movie_year = $res["mov_year"];
							$movie_long_desc = $res["mov_description_long"];
							
							echo "<img class=\"img-responsive img-rounded\" alt=\"Responsive image\" src=\"$movie_poster\" style=\"border: 8px solid white; box-shadow: 2px 2px 2px 2px #999;\">";
							echo "</div>";
							echo "<div class=\"col-md-6\">";
							echo "<h2 class=\"movie_h2\">$movie_title</h2>";
							echo "<h3>$movie_director, $movie_year</h3>";
							echo "<p class=\"text-justify movie_p\">$movie_long_desc</p>";
                        ?>
                    	
                        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Editer</button>
					</div>  
            	</div>              
            </div>
            <hr>
        	<p class="text-center">Construit avec <span class="glyphicon glyphicon-heart"></span> par <a href="https://fr.linkedin.com/in/yoann-lathuiliere-05b716a9">Yoann Lathuiliere</a></p>
        </div>

		<script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script>

    </body>
</html>

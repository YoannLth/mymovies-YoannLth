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
        ?>
        
		<?php
			$sth = $dbh->prepare("SELECT * FROM movie WHERE mov_id = :id");
			$sth->execute();
			$result = $sth->fetchAll();
			
			foreach($result as $res){
				$id = $res['mov_id'];
				$name = $res['mov_name'];
				$short_desc = $res['mov_description_short'];
				echo "<div class=\"container\">";
				echo"<h2><a href=\"movie.php?id=$id\">$name</a></h2>";
				echo "<p>$short_desc</p>";
				echo "</div>";
			}
		?>
		<div class="container">
        	<div class="jumbotron">
            	<div class="container">
                    <div class="col-md-6">
                    	<img class="img-responsive img-rounded" alt="Responsive image" src="images/xmen_cover.jpg" style="border: 8px solid white; box-shadow: 2px 2px 2px 2px #999;">
                    </div>
                    <div class="col-md-6">
						<h2 class="movie_h2">X-Men : Days of Future Past</h2>
						<h3>Bryan Singer, 2014</h3>
						<p class="text-justify movie_p">Dans un futur proche, les mutants et les humains ont été décimés par les Sentinelles, des robots biologiques capables de copier les pouvoirs des mutants. Seuls quelques mutants, dont Kitty Pride, Iceman, Storm et Bishop, résistent encore. Le Professeur X et Magneto décident d'envoyer Logan dans le passé afin d'empêcher le meurtre de Bolivar Trask, un scientifique américain responsable du programme d'armement dont la mort déclenchera le programme des Sentinelles. Wolverine arrive donc en 1973 afin de convaincre Charles Xavier et Erik Lehnsherr de stopper Mystique dans sa mission, une tâche qu'ils devront accomplir avec l'aide de Beast et de Quicksilver.</p>
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

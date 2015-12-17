<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="lib/Bootstrap%203.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    	<title>MyMovies</title>
        <?php
			// Inclusion du script de connexion a la base de données
			include 'db/db_connect.php';
		?>
    </head>

    <body>
    
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
        ?>
        
        <div class="container">
          	<h2><a href="movie.php">X-Men : Days of Future Past</a></h2>
            <p>Dans un futur proche, les mutants et les humains ont été décimés par les Sentinelles, des robots biologiques capables de copier les pouvoirs des mutants. Seuls quelques mutants, dont Kitty Pride, Iceman, Storm et Bishop, résistent encore. Le Professeur X et Magneto décident d'envoyer Logan dans le passé afin d'empêcher le meurtre de Bolivar Trask, un scientifique américain responsable du programme d'armement dont la mort déclenchera le programme des Sentinelles. Wolverine arrive donc en 1973 afin de convaincre Charles Xavier et Erik Lehnsherr de stopper Mystique dans sa mission, une tâche qu'ils devront accomplir avec l'aide de Beast et de Quicksilver.</p>
        </div>
        
        <div class="container">
          	<h2><a href="movie.php">Interstellar</a></h2>
            <p>Dans un futur proche, face à une Terre exsangue, un groupe d'explorateurs utilise un vaisseau interstellaire pour franchir un trou de ver permettant de parcourir des distances jusque-là infranchissables. Leur but : trouver un nouveau foyer pour l'humanité.</p>
        </div>
        
        <div class="container">
          	<h2><a href="movie.php">Immitation Game</a></h2>
            <p>L'histoire hors-norme d'Alan Turing, le mathématicien anglais qui aida à percer le code de l'outil de communication des Allemands durant la Seconde Guerre mondiale : la machine Enigma.</p>
        </div>
        
        <div class="container">
          	<h2><a href="movie.php">Equalizer</a></h2>
            <p>McCall, un homme qui pense avoir rangé son passé mystérieux derrière lui, se consacre à sa nouvelle vie tranquille. Au moment où il rencontre Teri, une jeune fille sous le contrôle de gangsters russes violents, il décide d'agir. McCall sort ainsi de sa retraite et voit son désir de justice réveillé.</p>
            
            <hr>
        	<p class="text-center">Construit avec <span class="glyphicon glyphicon-heart"></span> par <a href="https://fr.linkedin.com/in/yoann-lathuiliere-05b716a9">Yoann Lathuiliere</a></p>
        </div>
        
        <script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script> 
    </body>
</html>

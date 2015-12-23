<?php		
	if(!isset($_SESSION)) 
    { 
        session_start();
    } 
	else{

	}
?>

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
        
        <?php
			$sth = $dbh->prepare("SELECT * FROM movie");
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
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
        </div>
        
        <script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script> 
    </body>
</html>

<?php
	// Inclusion du script de connexion a la base de données
	include 'db/db_connect.php';
	
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
    	<title>MyMovies</title>
    </head>

    <body>
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
        ?>
        <!-- Vue globale de la page --> 
        <div class="container">
            <div class="col-md-12" id="filtres">
            	<!-- Filtres par genres --> 
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Filtres
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">                          
						<?php
							afficherChexboxListGenre($dbh);
						?>
                        </ul>
                        </div>
                    </small>
                </div>
			</div>
        
            <!-- Affichage des films et des infos (Titre, genre, description) --> 
            <?php
                afficherFilmsEtGenresIndex($dbh);
            ?>
             
            <!-- Affichage du footer de la page (séparé dans une nouvelle balise PHP pour bien structurer la page et rendre la modification plus simple) -->  
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
       	</div>
         
    </body>
    
    <!-- Script qui gère l'affichage des films en fonction du filtre -->  
    <script>
        var tabGenre = [];
        
        $(':checkbox').change(function() {
            tabGenre = [];
            $(':checkbox:checked').each(function (){
                if (this.checked) {
                    var value = $(this).val(); 
                    tabGenre.push(value);
                }
            });
            
            $('.containerMovie').hide();
            
            if(tabGenre.length == 0){
                $('.containerMovie').show();		
            }
            else{			
                for(i=0;i<tabGenre.length;i++){
                    var dataGenre = '[data-genre="'+tabGenre[i] +'"]';
                    $('.containerMovie'+dataGenre).show();	
                }
            }
        });
    </script>
</html>

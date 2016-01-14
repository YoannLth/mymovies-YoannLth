<?php
	// Inclusion du script de connexion a la base de données
	include 'db/db_connect.php';
	
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
        <title>Administration</title>
    </head>

    <body>
    	
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
        ?>
		
        <!-- Vue globale de la page --> 
		<div class="container">
        	<h1 class="text-center">Administration</h1>
            <div>
            	<!-- Onglets tableaux --> 
                <div class="nav_container">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                      <li role="presentation" class="active"><a id="Films_Tab" href="#films" aria-controls="films" role="tab" data-toggle="tab">Films</a></li>
                      <li role="presentation"><a id="Utilisateurs_Tab" href="#utilisateurs" aria-controls="utilisateurs" role="tab" data-toggle="tab">Utilisateurs</a></li>
                      <li role="presentation"><a id="Categorie_Tab" href="#categorie" aria-controls="categorie" role="tab" data-toggle="tab">Catégories</a></li>
                    </ul>
                </div>
            
                  <!-- Tableaux -->
                  <div class="tab-content">
                  	<!-- Tableau films --> 
                    <div role="tabpanel" class="tab-pane fade in active" id="films">
                        <table class="table" style="margin-bottom:60px;">
                        	<tr>
                            	<th>Id</th>
                                <th>Film</th>
                                <th>Réalisateur</th> 
                                <th>Année</th>
                                <th>Action</th>
                            </tr>
                        	<?php
								afficheTableauFilmsAdmin($dbh);
							?> 
                            </table>
                    </div>
					
                    <!-- Tableau utilisateurs --> 
                    <div role="tabpanel" class="tab-pane fade" id="utilisateurs">
                        <table class="table" style="margin-bottom:60px;">
                            <tr>
                                <th>Id</th>
                                <th>Login</th> 
                                <th>Rôle</th>
                                <th>Action</th>
                            </tr>
                            <?php
								afficheTableauUtilisateursAdmin($dbh);
							?>
                        </table>                    
                    </div>
                    
                    <!-- Tableau genres --> 
                    <div role="tabpanel" class="tab-pane fade" id="categorie">
                        <table class="table" style="margin-bottom:60px;">
                            <tr>
                                <th>Id</th>
                                <th>Genre</th> 
                                <th>Action</th>
                            </tr>
                            <?php
								afficheTableauGenresAdmin($dbh);
							?>
                        </table>                    
                    </div>
                    
                    
                  </div>
             </div>
            
            <!-- Fenêtre modale pour la suppression d'un film -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  	<div class="alert alert-danger alert-dismissible fade in alert_perso" role="alert">
                    	<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center">Attention</h4>
                        </div>
                      	<div class="modal-body text-center">
                      		<p>Vous êtes sur le point de supprimer ce film.</p>
                      	</div>
                      	<div class="modal-footer center_modal">
                       	 	<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        	<button type="button" class="btn btn-danger" onclick="delete_mov()">Valider</button>
                            <form>
                            	<input type="hidden" id="mov_id_hidden" value="">
                            </form>
                     	</div>
                    </div>
                </div>
              </div>
            </div>
            
            <!-- Fenêtre modale pour la suppression d'une catégorie -->
            <div class="modal fade" id="myModal_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  	<div class="alert alert-danger alert-dismissible fade in alert_perso" role="alert">
                    	<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center">Attention</h4>
                        </div>
                      	<div class="modal-body text-center">
                      		<p>Vous êtes sur le point de supprimer cette catégorie.</p>
                      	</div>
                      	<div class="modal-footer center_modal">
                       	 	<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        	<button type="button" class="btn btn-danger" onclick="delete_categ()">Valider</button>
                            <form>
                            	<input type="hidden" id="categ_id_hidden" value="">
                            </form>
                     	</div>
                    </div>
                </div>
              </div>
            </div>
            
            
            <!-- Fenêtre modale pour la suppression d'un utilisateur -->
            <div class="modal fade" id="myModal_user" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  	<div class="alert alert-danger alert-dismissible fade in alert_perso" role="alert">
                    	<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center">Attention</h4>
                        </div>
                      	<div class="modal-body text-center">
                      		<p>Vous êtes sur le point de supprimer cet utilisateur.</p>
                      	</div>
                      	<div class="modal-footer center_modal">
                       	 	<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                        	<button type="button" class="btn btn-danger" onclick="delete_us()">Valider</button>
                            <form>
                            	<input type="hidden" id="user_id_hidden" value="">
                            </form>
                     	</div>
                    </div>
                </div>
              </div>
            </div>
            
              
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
        </div>
    </body>
    
    <!-- Fonctions JavaScript necessaire a l'affichage des fenêtres modales, des tableaux -->
    <script>
        // Fonction JS qui affiche le tableau des films
        $('#Films_Tab').click(function (e) {
          e.preventDefault();
          $(this).tab('show')
        })
        
        // Fonction JS qui affiche le tableau des utilisateurs
        $('#Utilisateurs_Tab').click(function (e) {
          e.preventDefault()
          $(this).tab('show')
        })
        
        // Fonction JS qui affiche la fentre modale pour la suppression d'une catégorie
        function delete_category(id) {
            $('#myModal_category').modal('show');
            $("#categ_id_hidden").val(id);
        }
        
        // Fonction qui remplie le champ caché de la fenetre modale, necessaire pour le $_GET du script de suppression d'un film
        function delete_movie(id) {
            $('#myModal').modal('show');
            $("#mov_id_hidden").val(id);
        }
        
        // Fonction qui remplie le champ caché de la fenetre modale, necessaire pour le $_GET du script de suppression d'un utilisateur
        function delete_user(id) {
            $('#myModal_user').modal('show');
            $("#user_id_hidden").val(id);
        }
        
        // Fonction JS qui 'appelle' le script de suppression d'un film apres valdiation
        function delete_mov(){
            id = $("#mov_id_hidden").val();
            document.location.href='db/delete.php?id=' + id +'';
        }
        
        // Fonction JS qui 'appelle' le script de suppression d'une catégorie apres valdiation
        function delete_categ(){
            id = $("#categ_id_hidden").val();
            document.location.href='db/delete_category.php?id=' + id +'';
        }
        
        // Fonction JS qui 'appelle' le script de suppression d'un utilisateur apres valdiation
        function delete_us(){
            id = $("#user_id_hidden").val();
            document.location.href='db/delete_user.php?id=' + id +'';
        }
    </script>
</html>

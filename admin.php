<?php		
	session_start();
	if (!isset($_SESSION['login'])) {
		$message = "Vous devez être connecté pour pouvoir acceder à cette page";
		$retour = "index.php";
		$message_retour = "Retour au menu";
		
		header("Location: failure.php?message=$message&url=$retour&message_retour=$message_retour");
		exit();
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
        <title>Administration</title>
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
        	<h1 class="text-center">Administration</h1>
            <div>
                <div class="nav_container">
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                      <li role="presentation" class="active"><a id="Films_Tab" href="#films" aria-controls="films" role="tab" data-toggle="tab">Films</a></li>
                      <li role="presentation"><a id="Utilisateurs_Tab" href="#utilisateurs" aria-controls="utilisateurs" role="tab" data-toggle="tab">Utilisateurs</a></li>
                      <li role="presentation"><a id="Categorie_Tab" href="#categorie" aria-controls="categorie" role="tab" data-toggle="tab">Catégories</a></li>
                    </ul>
                </div>
            
                  <!-- Tab panes -->
                  <div class="tab-content">
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
								$sth = $dbh->prepare("SELECT * FROM movie");
								$sth->execute();
								$result = $sth->fetchAll();
								
								foreach($result as $res){
									$id = $res['mov_id'];
									$name = $res['mov_name'];
									$director = $res['mov_author'];
									$year = $res['mov_year'];
									echo "<tr>";
                                	echo "<td>$id</td>";
                                	echo "<td>$name</td>";
                                	echo "<td>$director</td>";
									echo "<td>$year</td>";
                                	echo "<td>";
                                    echo "<a type=\"button\" class=\"btn btn-info btn-xs btn_space\" href=\"edition.php?id=$id\">";
                                    echo "<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>";
                                    echo "</a>";
                                    echo "<a type=\"button\" class=\"btn btn-danger btn-xs\" href=\"#\" onclick=\"delete_movie($id)\">";
                                    echo "<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
                                    echo "</a>";
                                	echo "</td>";
                            		echo "</tr>";
								}
							?> 
                            </table>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="utilisateurs">
                        <table class="table" style="margin-bottom:60px;">
                            <tr>
                                <th>Id</th>
                                <th>Login</th> 
                                <th>Action</th>
                            </tr>
                            <?php
								$sth = $dbh->prepare("SELECT * FROM user_mymovies");
								$sth->execute();
								$result = $sth->fetchAll();
								
								foreach($result as $res){
									$id = $res['user_id'];
									$username = $res['user_username'];
									echo "<tr>";
                                	echo "<td>$id</td>";
                                	echo "<td>$username</td>";
                                	echo "<td>";
                                    echo "<a type=\"button\" class=\"btn btn-info btn-xs btn_space\" href=\"edition.php?id=$id\">";
                                    echo "<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>";
                                    echo "</a>";
                                    echo "<a type=\"button\" class=\"btn btn-danger btn-xs\" href=\"#\" onclick=\"delete_movie($id)\">";
                                    echo "<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
                                    echo "</a>";
                                	echo "</td>";
                            		echo "</tr>";
								}
							?>
                        </table>                    
                    </div>
                    
                    
                    <div role="tabpanel" class="tab-pane fade" id="categorie">
                        <table class="table" style="margin-bottom:60px;">
                            <tr>
                                <th>Id</th>
                                <th>Genre</th> 
                                <th>Action</th>
                            </tr>
                            <?php
								$sth = $dbh->prepare("SELECT * FROM movie_genre");
								$sth->execute();
								$result = $sth->fetchAll();
								
								foreach($result as $res){
									$id = $res['genre_id'];
									$genre = $res['genre_name'];
									echo "<tr>";
                                	echo "<td>$id</td>";
                                	echo "<td>$genre</td>";
                                	echo "<td>";
                                    echo "<a type=\"button\" class=\"btn btn-danger btn-xs\" href=\"#\" onclick=\"delete_category($id)\">";
                                    echo "<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>";
                                    echo "</a>";
                                	echo "</td>";
                            		echo "</tr>";
								}
							?>
                        </table>                    
                    </div>
                    
                    
                  </div>
             </div>
            
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  	<div class="alert alert-danger alert-dismissible fade in alert_perso" role="alert">
                    	<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center" id="myModalLabel">Attention</h4>
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
            
            <!-- Modal -->
            <div class="modal fade" id="myModal_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  	<div class="alert alert-danger alert-dismissible fade in alert_perso" role="alert">
                    	<div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title text-center" id="myModalLabel">Attention</h4>
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
            
            
            
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
        </div>
      	
        <script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script>
        <script>
			$('#Films_Tab').click(function (e) {
			  e.preventDefault();
			  $(this).tab('show')
			})
			$('#Utilisateurs_Tab').click(function (e) {
			  e.preventDefault()
			  $(this).tab('show')
			})
			
			function delete_movie(id) {
				$('#myModal').modal('show');
				$("#mov_id_hidden").val(id);
			}
			
			function delete_mov(){
				id = $("#mov_id_hidden").val();
				document.location.href='db/delete.php?id=' + id +'';
			}
			
			function delete_category(id) {
				$('#myModal_category').modal('show');
				$("#categ_id_hidden").val(id);
			}
			
			function delete_categ(){
				id = $("#categ_id_hidden").val();
				document.location.href='db/delete_category.php?id=' + id +'';
			}
		</script>
    </body>
</html>

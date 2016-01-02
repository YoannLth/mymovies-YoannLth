<?php		
	// Inclusion du script de connexion a la base de données
	include 'db/db_connect.php';
	
	// Inclusion du script PHP contenant les fonctions PHP nécessaire aux traitements des données
	include 'functions.php';
		
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
	
	$role = testSiAdmin($dbh,$_SESSION['login']);
	if ($role != "ADMIN") {
		$message = "Vous devez être Administrateur pour pouvoir acceder à cette page";
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
        <title>Editer un utilisateur</title>
    </head>

    <body>
    	
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
			
			$id = $_GET["id"];
			
			$result = recupererInfosUser($dbh, $id);
			
			//var_dump($result);
			
			$user_id = $result['user_id'];
			$user_username = $result['user_username'];
			$user_role = $result['user_role'];
			
			$stmt = $dbh->prepare("SELECT DISTINCT user_role FROM user_mymovies");
			$stmt->execute();
			$roles = $stmt->fetchAll();
			//var_dump($roles);
        ?>

		<div class="container">
            
            <h2 class="text-center black">Edition d'un utilisateur</h2>
            <div class="well">
                <form class="form-horizontal" role="form" action="db/edit_user.php" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Login</label>
                        <div class="col-sm-6">
                            <p class="form-control-static"><?php echo $user_username; ?></p>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="col-sm-4 control-label">Rôle</label>
                    	<div class="col-sm-6">
                        	<select class="form-control" name="userRole" required>
                            	<?php
									if(count($roles) != 1){
										foreach($roles as $r){
											$value = $r['user_role'];
											echo '<option value="'.$value.'" '.(($value==$user_role)?'selected="selected"':"").'>'.$value.'</option>';
										}
									}
									else{
										
										echo '<option value="ADMIN" '.(($user_role=='ADMIN')?'selected="selected"':"").'>ADMIN</option>';
										echo '<option value="VISITOR" '.(($user_role=='VISITOR')?'selected="selected"':"").'>VISITOR</option>';
									}
								?>
                            </select>
                    	</div>
                    </div>
                    <div class="form-group">
                    	<div class="col-sm-4 col-sm-offset-4">
                    	<button type="submit" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-save"></span> Enregistrer</button>
                        </div>
                    </div>
                    <input type="hidden" name="id_user_hidden" value="<?php echo $id; ?>"/>
                </form>        
            </div>
            
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
        </div>
      	
        <script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script>
        <script>
        
        </script>
    </body>
</html>

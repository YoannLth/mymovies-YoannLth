<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link href="lib/Bootstrap%203.5/css/bootstrap.min.css" rel="stylesheet">
    	<link href="css/style.css" rel="stylesheet">
        <title>Réussite</title>
    </head>

    <body>
    	
    	<?php
			// Inclusion du script PHP pour générer la Navbar
        	include 'include/navbar.php';
			$message = $_GET["message"];
			$url = $_GET["url"];
			$message_retour = $_GET["message_retour"];
        ?>

		<div class="container">
        	<div class="alert alert-danger text-center" role="alert">
              <?php echo $message ?>
              <br />
              <br />
              <a href="<?php echo $url ?>" class="alert-link"><?php echo $message_retour ?></a>              
            </div>
            
            <?php
				// Inclusion du script PHP pour générer le pied de page
        		include 'include/footer.php';
        	?>
        </div>
      	
        <script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script>
    </body>
</html>

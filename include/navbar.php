<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">
            <span class="glyphicon glyphicon-film"></span> MyMovies
           </a>
        </div>        
				<?php
					// Inclusion du script de connexion a la base de données
					include 'db/db_connect.php';
					
					// Inclusion du script de connexion a la base de données
					include 'include/functions_navbar.php';
					
                    if(!isset($_SESSION['login'])){
						echo "<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">";
						echo "<ul class=\"nav navbar-nav navbar-right\">";
						echo "<li class=\"dropdown\">";
                        echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"><span class=\"glyphicon glyphicon-user\"></span> Ouvrir une session<span class=\"caret\"></span></a>";
						echo "<ul class=\"dropdown-menu\">";
						echo "<li><a href=\"connexion.php\">Connexion</a></li>";
						echo "<li><a href=\"inscription.php\">Inscription</a></li>"; 
                    }
                    else{
						$login = $_SESSION['login'];
						testSiUtilisateurExiste($dbh,$login);
						echo "<div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">";
						echo "<ul class=\"nav navbar-nav navbar-left\">";
						echo "<li><a href=\"ajout.php\">Ajouter un film</a></li>";
						echo "<li><a href=\"ajout_category.php\">Ajouter une catégorie</a></li>";
						echo "</ul>";
						echo "<ul class=\"nav navbar-nav navbar-right\">";
						echo "<li>";
						echo "<a href=\"admin.php\"><span class=\"glyphicon glyphicon-cog\"></span> Administration</a>";
						echo "</li>";
						echo "<li class=\"dropdown\">";
						echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"><span class=\"glyphicon glyphicon-user\"></span> Bienvenue, $login<span class=\"caret\"></span></a>";
						echo "<ul class=\"dropdown-menu\">";
						echo "<li><a href=\"#\">Profil</a></li>";
						echo "<li><a href=\"db/deconnexion.php\">Deconnexion</a></li>";
                    }
                ?>

                </ul>
            </li>
          </ul>
      </div><!-- /.container-fluid -->
  </div><!-- /.container-fluid --> 
</nav>
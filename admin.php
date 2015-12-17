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

		<div class="container">
        	<h1 class="text-center">Administration</h1>
            
            <div class="nav_container">
                <ul class="nav nav-tabs nav-justified">
                  <li role="presentation"><a href="#">Films</a></li>
                  <li role="presentation" class="active"><a href="#">Utilisateurs</a></li>
                </ul>
            </div>
            
            <table class="table" style="margin-bottom:60px;">
            	<tr>
                    <th>Nom</th>
                    <th>Prenom</th> 
                    <th>Login</th>
                    <th>Action</th>
              	</tr>
             	<tr>
                    <td>Karim</td>
                    <td>Benzema</td> 
                    <td>Karim_kb69</td>
                    <td>
                        <button type="button" class="btn btn-info btn-xs">
                        	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs">
                        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </td>
              	</tr>
                <tr>
                    <td>Harry</td>
                    <td>Potter</td> 
                    <td>HP_du_77</td>
                    <td>
                        <button type="button" class="btn btn-info btn-xs">
                        	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs">
                        	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </td>
              	</tr>
            </table>
            
            <hr>
        	<p class="text-center">Construit avec <span class="glyphicon glyphicon-heart"></span> par <a href="https://fr.linkedin.com/in/yoann-lathuiliere-05b716a9">Yoann Lathuiliere</a></p>
        </div>
      	
        <script src="lib/jquery%202.4/jquery-2.1.4.min.js"></script>
    	<script src="lib/Bootstrap%203.5/js/bootstrap.min.js"></script>
    </body>
</html>

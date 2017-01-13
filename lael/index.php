<?php
session_start();
            $_SESSION['Prenom'] = 'john';
           echo $_SESSION['Prenom'];

?>
<html>

  <head>
	
	<meta charset='UTF-8'>
	
	</head>

  <body>
  	
	<form action='deploy.html'>

		</br>										  
		<button>deployer mon site</button>

		</form>
		
		
	<form action='create_projet.html'>

		</br>										  
		<button>Créer mon projet</button>

		</form>

	<form action='supp_projet.html'>

		</br>										  
		<button>Supprimer mon projet</button>

		</form>

	<form action='ajout_membre.html'>

		</br>										  
		<button>Ajouter un membre à mon projet</button>

		</form>

		

  </body>
  
	
</html>
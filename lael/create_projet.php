<?php 
 
$projet = $_POST['projet'];
$mdp = $_POST['mdp'];

	function securite($a) {
		
		$a = rtrim($a);//trim supprime certains caractère et/ou les espaces en trop de fin de chaine
		$a = ltrim($a);//trim supprime certains caractère et/ou les espaces en trop de début de chaine
		$a = str_replace(" ","-", $a);//trim supprime certains caractère et/ou les espaces en trop
		$a = stripslashes($a);//stripcslashes retire les anti-slash
		$a = strip_tags($a);//retire les balises html
				if (!empty($a)){
					return $a;
				}else{
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=create_projet.html">';
				}
	}
	$projet = securite($projet);
	$mdp = securite($mdp);

	echo"
	<label>Votre identifiant SFTP est : $projet  </label><br/>
	<label>Votre mot de passe SFTP est : $mdp  </label>	<br/><br/>

	<label>Votre identifiant à la base de donnée est : $projet </label>	<br/>
	<label>Votre mot de passe à la base de donnée est : $mdp </label> <br/>
		<a href=http://deploy.itinet.fr/phpmyadmin><button>Acceder à la base de donnée</button></a><br/><br/>

	<label>Votre identifiant à owncloud est : $projet  </label> <br/>
	<label>Votre mot de passe à owncloud est : $mdp </label> <br/>
		<a href=http://http://owncloud.deploy.itinet.fr/><button>Accéder à owncloud</button><br/><br/></a>

	<label>Votre nom d'alias pour ce projet est $projet@deploy.itinet.fr </label><br/>
		<a href=http://messagerie.deploy.itinet.fr/><button>Accéder à la messagerie</button></a><br/><br/>
 <br/>";
	
		//echo exec('/Creer/create_projet.sh $projet $mdp $_SESSion['pseudo']');
  
  ?>


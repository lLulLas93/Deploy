<?php 
 
$projet = $_POST['projet'];

	function securite($a) {
		
		$a = rtrim($a);//trim supprime certains caractère et/ou les espaces en trop de fin de chaine
		$a = ltrim($a);//trim supprime certains caractère et/ou les espaces en trop de début de chaine
		$a = str_replace(" ","-", $a);//trim supprime certains caractère et/ou les espaces en trop
		$a = stripslashes($a);//stripcslashes retire les anti-slash
		$a = strip_tags($a);//retire les balises html
				if (!empty($a)){
					return $a;
				}else{
					echo'vos a ne sont pas correcte';
				}
	}
	$projet = securite($projet);

	echo"
	<label>Votre identifiant la base de donnée, SFTP, owncloud ainsi que l'alias du projet $projet est supprimé </label><br/>
	";
	
		//echo exec('/Creer/create_projet.sh $projet $mdp $_SESSION['pseudo']');
  
  ?>


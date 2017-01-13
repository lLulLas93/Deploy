<?php 
 
$projet = $_POST['projet'];
$user= $_POST['user'];

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
	$user= securite($user);

	echo"
	<label>Votre projet $projet comporte $user comme nouveau membre !  </label><br/>
	<label>$user vous enverra un mail de confirmation !  </label><br/>
	";
	
		//echo exec('/Creer/add_to_group.sh $projet $user $_SESSION['pseudo']');
  
  ?>


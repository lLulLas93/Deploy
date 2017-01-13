<?php 

$vhost = $_POST['vhost'];

	function securite($a) {
		
	$a = rtrim($a);//trim supprime certains caractère et/ou les espaces en trop de fin de chaine
	$a = ltrim($a);//trim supprime certains caractère et/ou les espaces en trop de début de chaine
	$a = str_replace(" ","-", $a);//trim supprime certains caractère et/ou les espaces en trop
	$a = stripslashes($a);//stripcslashes retire les anti-slash
	$a = strip_tags($a);//retire les balises html
		$vhost = $a;
		 
		if (!empty($vhost)){
			return $vhost;
			echo'AFFICHE UN TRUC';
		}else{
			echo'<META HTTP-EQUIV="Refresh" CONTENT="0; URL=deploy.html">';
		}
			echo'FIN';
	}
	$vhost = securite($vhost);
	 
	 	
	echo '<label>Votre site est accesible : <a href="http://'.$vhost.'.deploy.itinet.fr">ici</a></label>';
	echo "<br><label>Avec comme URL : <a href=''>http://$vhost.deploy.itinet.fr</a></label><br/><br/>
	
	";
	//echo exec('/Creer/deploy.sh $vhost');
		
	//echo exec('/Creer/deploy2.sh');
	
?>
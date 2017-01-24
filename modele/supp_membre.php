<?php 
 
$id_projet = $_POST['id_projet'];
$n_projet = $_POST['n_projet'];
$user= $_POST['user'];
$chef = $_SESSION['prenom'];


	function securite($a) {
		//Verification si l'utilisateurs existe bien		
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
	$user= securite($user);

	echo"
	<label>Votre projet $n_projet comporte plus $user comme nouveau membre !  </label><br/>
	".$user;
	
	echo exec("./code_fini/Supprimer/retirer_group.sh $user $n_projet");

	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$requete1 = $pdo->prepare("SELECT user_id FROM UTILISATEURS WHERE login = '$user' || prenom = '$user'");
	$requete1->execute();
	$resultat = $requete1->fetchall();
	$user_id = $resultat[0]['user_id'];
	print_r($resultat);
	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM STATUT WHERE user_id ='$user_id' and projet_id ='$id_projet'";
	$pdo->exec($sql);

	echo '<meta http-equiv="refresh" content="2; URL=index.php?page=view_projet">';

?>

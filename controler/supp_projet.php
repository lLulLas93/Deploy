<?php
print_r($_POST);
$n_p = $_POST['n_projet'];
$id_p = $_POST['id_projet'];

if ($_POST['id_projet'] and $_POST['n_projet']){
	
	$chef = $_SESSION['prenom'];
	$id_chef = $_SESSION['id'];

	echo"
	<label>Votre projet $n_projet à été supprimé !  </label><br/>
	<label>Vous avez perdu toute données sur notre site!  </label><br/>
	";
	
	echo exec("./code_fini/Supprimer/delete_projet.sh $n_projet");


	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM STATUT WHERE user_id = '$id_chef' and statut = '1'";
	$pdo->exec($sql);

	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql2 = "DELETE FROM STATUT WHERE projet_id = '$id_projet' and statut = '0'";
	$pdo->exec($sql2);

	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql3 = "DELETE FROM PROJETS WHERE projet_id = '$id_projet'";
	$pdo->exec($sql3);

//echo '<meta http-equiv="refresh" content="2; URL=index.php?page=view_projet">';


}

?>

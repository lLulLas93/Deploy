<?php
	$id_user = $_SESSION['id'];

	echo"
	<label>  A Jamais !  </label><br/>
	<label>Vous avez perdu toute données sur notre site!  </label><br/>
	";
	
	echo exec("./code_fini/Supprimer/desinscription.sh $id_user");

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$num_inst = $pdo->query("SELECT projet_id FROM STATUT S  WHERE S.user_id = '$id_user' and S.statut = '1'");
        $id = $num_inst->fetch();
	$id_p = $id['projet_id'];

	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "DELETE FROM PROJETS WHERE projet_id = '$id_p'";
	$pdo->exec($sql);

	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql2 = "DELETE FROM STATUT WHERE user_id = '$id_user'";
	$pdo->exec($sql2);
	
	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql5 = "DELETE FROM UTILISATEURS WHERE user_id = '$id_user'";
	$pdo->exec($sql5);

echo '<meta http-equiv="refresh" content="2; URL=index.php">';

?>

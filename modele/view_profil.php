<?php

$id = $_SESSION['id'];

	$reponse_ut = $pdo->query("SELECT prenom, login, mail FROM UTILISATEURS WHERE user_id = '$id'");
	$donnees = $reponse_ut->fetch(PDO::FETCH_ASSOC);
	//print_r($donnees);

	$cp_ut = $pdo->query("SELECT S.*, P.projet_id, P.nom_projet, P.description, P.deploy FROM STATUT S INNER JOIN PROJETS P ON S.user_id = '$id' AND S.statut = 1 AND S.projet_id = P.projet_id");
	$donnees_2 = $cp_ut->fetch(PDO::FETCH_ASSOC);
	$p_id = $donnees_2['projet_id'];	
	//print_r($donnees_2);

	$p = $pdo->query("SELECT U.prenom FROM UTILISATEURS U INNER JOIN STATUT S ON U.user_id = S.user_id AND S.projet_id = '$p_id'");
	$donnees_3 = $p->fetchAll(PDO::FETCH_ASSOC);
	//print_r($donnees_3);

	$proj_part = $pdo->query("SELECT P.nom_projet, P.description, P.deploy FROM PROJETS P INNER JOIN STATUT S ON S.user_id = '$id' AND S.statut = 0 AND S.projet_id = P.projet_id");
	$donnees_4 = $proj_part->fetchAll(PDO::FETCH_ASSOC);
	//print_r($donnees_4);

	

	//$reponse_ut->closeCursor();
	//$cp->closeCursor();
	//$p->closeCursor();
	//$part_proj->closeCursor();

?>

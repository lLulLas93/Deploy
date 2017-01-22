<?php

$id = $_SESSION['id'];

	$reponse_ut = $pdo->query("SELECT nom, login, mail FROM UTILISATEURS WHERE user_id = '$id'");
	$donnees = $reponse_ut->fetch(PDO::FETCH_ASSOC);

	$cp = $pdo->query("SELECT S.*, P.projet_id, P.nom_projet, P.description, P.deploy FROM STATUT S INNER JOIN PROJETS P ON S.user_id = '$id' AND S.statut = 1 AND S.projet_id = P.projet_id");
	$donnees_2 = $cp->fetch(PDO::FETCH_ASSOC);
	$p_id = $donnees_2['projet_id'];	

	$p = $pdo->query("SELECT U.nom FROM UTILISATEURS U INNER JOIN STATUT S ON U.user_id = S.user_id AND S.projet_id = '$p_id'");
	$donnees_3 = $p->fetchAll(PDO::FETCH_ASSOC);

	$reponse_ut->closeCursor();
	$cp->closeCursor();
	$p->closeCursor();

print_r ($donnees_3);
?>

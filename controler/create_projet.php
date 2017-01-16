<?php

		$pseudo = $_SESSION['pseudo'];
	
		$id = $_SESSION['id'];
		
			$count = $pdo->query("SELECT count(*) AS nb FROM projets WHERE Instigateur = $id");
			$total = $count->fetch();
	
	if($total['nb'] >= 4) {
include('./view/head.html');
include('./view/nav_projet.html');
include('./view/view_projet.html');
include('./modele/view_projet.php');
	}else {
		
include('./view/head.html');
include('./view/nav_projet.html');
include('./view/create_projet.html');
	}
?>
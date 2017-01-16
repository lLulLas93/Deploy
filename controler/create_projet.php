<?php
		$id = $_SESSION['id'];
		
			$count = $pdo->query("SELECT count(*) AS nb FROM projets WHERE Instigateur = $id");
			$total = $count->fetch();
	
	if($total['nb'] >= 4) {
		
include('./view/head.html');
include('./view/nav_projet.html');
include('./view/view_projet.html');
include('./modele/view_projet.php');
	}else if (isset($_GET['projet'])) {
		
include('./view/head.html');
echo'<h3>Projet Existant</h3>';
include('./view/nav_projet.html');
include('./view/create_projet.html');
exec('../code_fini/Creer/create_projet.sh');
	} else {
		
include('./view/head.html');
include('./view/nav_projet.html');
include('./view/create_projet.html');
exec('../code_fini/Creer/create_projet.sh');
	}
?>
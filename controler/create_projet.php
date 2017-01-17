<?php
		$id = $_SESSION['id'];
		
			$count = $pdo->query("SELECT count(*) AS nb FROM projets WHERE Instigateur = $id");
			$total = $count->fetch();
	
	if($total['nb'] >= 4) {
		
include('./view/head.html');
include('./view/nav.html');
include('./view/view_projet.html');
echo'<h1>vous avez 4 ou plus de 4 projet </h1>';
include('./modele/view_projet.php');
	}else if (isset($_GET['projet'])) {
		
include('./view/head.html');
echo'<h3>Projet Existant</h3>';
include('./view/nav.html');
include('./view/create_projet.html');
exec('../code_fini/Creer/create_projet.sh');
	} else {
		
include('./view/head.html');
include('./view/nav.html');
include('./view/create_projet.html');
exec('../code_fini/Creer/create_projet.sh');
	}
?>
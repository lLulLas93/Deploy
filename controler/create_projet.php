<?php
		$id = $_SESSION['id'];
echo "<br/><br/<br/><br/>>".$i;		
			$count = $pdo->query("SELECT statut AS nb FROM STATUT WHERE user_id = $id");
			$total = $count->fetch();
	print_r($total);
	if($total['nb'] >= 4) {
		
include('./view/head.html');
include('./view/nav.html');
include('./view/view_projet.html');
echo'<h1>vous avez 4 ou plus de 4 projet </h1>';
include('./modele/view_projet.php');
include('./end.html');
	}else if (isset($_GET['projet'])) {
		
include('./view/head.html');
echo'<h3>Projet Existant</h3>';
include('./view/nav.html');
include('./view/create_projet.html');
include('./view/end.html');
	} else {		
include('./view/head.html');
include('./view/nav.html');
include('./view/create_projet.html');
include('./view/end.html');
	}
?>

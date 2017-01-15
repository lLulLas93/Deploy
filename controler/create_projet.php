<?php

		$pseudo = $_SESSION['pseudo'];
	
		$id = $_SESSION['id'];
		function countNbMessage($pdo, $id)
		{
			$count = $pdo->prepare("SELECT count(*) AS nb FROM messages WHERE statut = '0' AND id_destinataire = :id");
			$count->execute(array("id" => $id));
			$totalMess = $count->fetch();
			return $totalMess['nb'];
		}
	
include('./view/head.html');
include('./view/nav_projet.html');
include('./modele/create_projet.php');
include('./view/create_projet.html');

?>
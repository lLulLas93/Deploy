<?php

$id= $_SESSION['id'];
$inter = $pdo->query("SELECT deploy FROM STATUT WHERE user_id = $id");
$nb_dep = $inter->fetch();

if($nb_dep['deploy'] == 0)
{
	include('./view/head.html');
	include('./view/nav.html');
	include('./view/deploy_projet.html');
}else{
	include('./view/head.html');
	include('./view/nav.html');
	include('./view/deploy_projet2.html');
}
?>

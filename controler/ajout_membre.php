<?php
$n_p = $_POST['n_projet'];
$id_p = $_POST['id_projet'];

	if ($_POST['id_projet'] and !$_POST['user']){
include('./view/head.html');
include('./view/nav.html');
include('./view/ajout_membre.html');
	}else if ($_POST['user'] and $_POST['id_projet']){
include('./view/head.html');
include('./view/nav.html');
include('./modele/ajout_membre.php');
	}

?>

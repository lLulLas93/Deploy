<?php
print_r($_POST);
$n_p = $_POST['n_projet'];
$id_p = $_POST['id_projet'];

	if ($_POST['id_projet'] and !$_POST['user']){
include('./view/head.html');
include('./view/nav.html');
include('./view/supp_membre.html');
	}else if ($_POST['user'] and $_POST['id_projet']){
include('./view/head.html');
include('./view/nav.html');
include('./modele/supp_membre.php');
	}

?>

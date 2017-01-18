<?php
	
$nb_ut = $pdo->query('SELECT COUNT(*) AS C FROM UTILISATEURS');

$c = $nb_ut->fetch(PDO::FETCH_ASSOC);

//echo $c[C];

$nb_ut->closeCursor();


$nb_proj = $pdo->query('SELECT COUNT(*) AS C2 FROM PROJETS');

$c2 = $nb_proj->fetch(PDO::FETCH_ASSOC);

$nb_proj->closeCursor();


$nb_dep = $pdo->query('SELECT COUNT(deploy) AS C3 FROM PROJETS');

$c3 = $nb_dep->fetch(PDO::FETCH_ASSOC);

$nb_dep->closeCursor();

?>

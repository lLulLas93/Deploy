<?php

include('./view/head.html');
include( './view/nav.html' );



if (empty($_POST['projet_nom']) || empty($_POST['langage']) || empty($_POST['participants']) || empty($_POST['description']) || empty($_POST['difficultes'])){
    include( './view/create_projet.html' );
}
else{
    include('./modele/verif_projet.php');

}


?>
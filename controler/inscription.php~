<?php

if (empty($_POST['firstname']) || (trim($_POST['firstname'])) == '' || empty($_POST['secondname']) || (trim($_POST['secondname'])) == '' || empty($_POST['email']) || (trim($_POST['email'])) == '' || empty($_POST['password']) || (trim($_POST['password'])) == '' || empty($_POST['repassword']) || (trim($_POST['repassword'])) == '' || empty($_POST['statut']) || (trim($_POST['statut'])) == '' || empty($_POST['noti']) || (trim($_POST['statut'])) == '') {

    include('./view/inscription.html');
   // echo '<div class="alert alert-danger" role="danger">Remplissez tous les champs</div>';

} else if (strlen($_POST['firstname']) < 2 || strlen($_POST['secondname']) < 2 || strlen($_POST['email']) < 2 || strlen($_POST['password']) < 2 || strlen($_POST['repassword']) < 2) {

    include('./view/inscription.html');
    echo '<div class="alert alert-danger" role="danger">Il y a moins de 2 caracteres dans un ou plusieurs champ(s), veuillez en rajouter</div>';

} else if ($_POST['password'] !== $_POST['repassword']) {

    include('./view/inscription.html');
    echo '<div class="alert alert-danger" role="danger">Vous devez mettre le même mot de passe</div>';

} else {
    include('./modele/register.php');
    if (isset($inscription)) {
        if ($inscription) {
            include('./view/confirmation.html');
        } else {
            echo '<div class="alert alert-danger" role="danger">Erreur sur enregistrement</div>';
        }
    } else if (isset($doublon)) {
        if ($doublon) {
            include('./view/inscription.html');
            echo '<div class="alert alert-danger" role="danger">Compte deja existant</div>';
        } else {
            echo 'Erreur sur doublon';
        }
    } else {
        echo '<div class="alert alert-danger" role="danger">Erreur</div>';
    }
}
?>
<?php

if (empty($_POST['login']) || (trim($_POST['login'])) == '' || empty($_POST['nom']) || (trim($_POST['nom'])) == '' || empty($_POST['repassword']) || (trim($_POST['repassword'])) == '') {

    include('./view/inscription.html');
echo '<div class="alert alert-danger" role="danger" style="margin-top:100px"><center><font size=5>Remplissez tous les champs</font></center></div>';
    echo '<meta http-equiv="refresh" content="2; URL=index.php">';

} else if (strlen($_POST['login']) < 2 || strlen($_POST['nom']) < 2 ||  strlen($_POST['password']) < 2 || strlen($_POST['repassword']) < 2) {

    include('./view/inscription.html');
echo '<div class="alert alert-danger" role="danger" style="margin-top:100px"><center><font size=5>Il y a mois de 2 caracteres dans un ou plusieurs champ(s), veuillez en rajouter</font></center></div>';
    echo '<meta http-equiv="refresh" content="2; URL=index.php">';

} else if ($_POST['password'] !== $_POST['repassword']) {

    include('./view/inscription.html');
echo '<div class="alert alert-danger" role="danger" style="margin-top:100px"><center><font size=5>Vous devez mettre le même mot de passe</font></center></div>';
            echo '<meta http-equiv="refresh" content="2; URL=index.php">';

} else {

include('./modele/function.php');

$login = $_POST['login'];
$nom = $_POST['nom'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

//Appel de la fonction register
$_SESSION['login'] = $login;
$_SESSION['nom'] = $nom;
$_SESSION['password'] = $password;
register($login, $nom, $password, $pdo);

    if (isset($inscription)) {
        if ($inscription) {
            include('./view/inscription.html');
            include('./view/confirmation.html');
             echo '<meta http-equiv="refresh" content="10; URL=index.php">';
	//echo exec('./code_fini/Creer/create_utilisateur.sh $nom $password');
        } else {
            echo '<br/><br/> <br/> <br/> <div class="alert alert-danger" role="danger">Erreur sur enregistrement</div>';
        }
    } else if (isset($doublon)) {
        if ($doublon) {
            include('./view/inscription.html');
		echo '<div class="alert alert-danger" role="danger" style="margin-top:100px"><center><font size=5>Compte deja existant</font></center></div>';
            echo '<meta http-equiv="refresh" content="2; URL=index.php">';
        } else {
            echo 'Erreur sur doublon';
        }
    } else {
        echo '<br/><br/> <br/> <br/> <div class="alert alert-danger" role="danger">Erreur</div>';
		echo '<div class="alert alert-danger" role="danger" style="margin-top:100px"><center><font size=5>Compte deja existant</font></center></div>';
    }
}
?>

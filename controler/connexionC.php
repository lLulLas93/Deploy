<?php 
if (empty($_POST['pseudo']) || empty($_POST['password'])) {
    include('./view/head.html');
    include('./view/nav_bar_home.html');
    include('./view/connexion.html');
    include('./view/footer.html');
    echo '<div class="alert alert-danger" role="alert">Veuillez entrer votre pseudo et votre mot de passe </div>';
} else {
    include('./modele/connexion.php');
    if (isset($connexion)) {
        if ($connexion) {
           // echo $statut;
           // echo $_SESSION['statut'];
            include('./view/head.html');
            include('./controler/accueilMembre.php');
           // include('./view/footer.html');
        }
    } else {
        if (!isset($connexionA)) {
            include('./view/head.html');
            include('./view/nav_bar_home.html');
            echo '<div class="alert alert-danger" role="alert" align="center">Erreur : Pseudo et/ou Mot de passe invalide(s)</div>';
			include('./view/connexion.html');
            include('./view/footer.html');
        }
    }
    // Connexion en tant qu'Admin
    if (isset($connexionA)) {
        if ($connexionA) {
            include('./view/head.html');
            include('./controler/accueilMembre.php');
          //  include('./view/footer.html');
        }
    }
}

?>
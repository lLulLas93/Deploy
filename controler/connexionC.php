<?php 
    include('./modele/function.php');
	// $pseudo = $_POST['pseudo'];
	// $mdp = $_POST['password'];
	// $_SESSION['pseudo'] = $pseudo;

	//Appel function LOGIN

	login($pdo);

    if (isset($connexion)) {
        if ($connexion) {
           // echo $statut;
           // echo $_SESSION['statut'];
            include('./view/head.html');
            include('./controler/accueil.php');
           // include('./view/footer.html');
        }
    } else {
        if (!isset($connexionA)) {
			include('./view/index.html');
        }
    }
    // Connexion en tant qu'Admin
    if (isset($connexionA)) {
        if ($connexionA) {
            include('./view/head.html');
            include('./controler/accueil.php');
          //  include('./view/footer.html');
        }
    }


?>
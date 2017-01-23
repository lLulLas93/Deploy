<?php 

// FUNCTION REGISTER 

function register($login, $nom, $password, $pdo) {
	
	$mail = "$nom@deploy.itinet.fr";
    $sql = "INSERT INTO UTILISATEURS(nom, login, mail, mdp) VALUES('$nom','$login','$mail', '$password')";
    $req = $pdo->prepare("SELECT * FROM UTILISATEURS WHERE login = '$login' || nom = '$nom' ");
    $t = $req->execute();
    $count = $req->rowCount();
    
	if ($count) {
        global $doublon;
        $doublon = true;
	} else if (!$count) {
	echo exec("./code_fini/Creer/create_utilisateur.sh $nom $password");
       		if ($pdo->query($sql) == TRUE) {
       		global $inscription;
       		$inscription = true;
        	} else {
            	echo 'Erreur inscription';
        	}
    }
}

// FUNCTION LOGIN

function login($pdo) {

    $reponse_pseudo = $pdo->query('SELECT login  FROM UTILISATEURS');
    $reponse_password = $pdo->query('SELECT mdp FROM UTILISATEURS');

    //Je vérifie tout mes champs logins
    while ($donnees = $reponse_pseudo->fetch() AND $donees2 = $reponse_password->fetch()) {
        if ($_POST['login'] == $donnees['login'] AND $_POST['password'] == $donees2['mdp']) {

//Enregistrement de l'ID dans la SESSION

            $pseudo = $_POST['login'];
            $password = $_POST['password'];

            $req = $pdo->prepare("SELECT * FROM UTILISATEURS WHERE login = :pseudo AND Mdp = :password");
            $req->execute(array('pseudo' => $pseudo, 'password' => $password));

            $contenu = $req->fetch();
            $_SESSION['id'] = $contenu['user_id'];
            $_SESSION['mail'] = $contenu['Mail'];
            $_SESSION['nom'] = $contenu['nom'];
            $_SESSION['login'] = $contenu['login'];
            $_SESSION['Statut'] = $contenu['Statut'];

            global $id;
            $id = $_SESSION['id'];
            
            global $mail;
            $mail = $_SESSION['mail'];
          global $connexion;
	$connexion = true;        
    }
}
    $reponse_pseudo->closeCursor();
    $reponse_password->closeCursor();
}

?>

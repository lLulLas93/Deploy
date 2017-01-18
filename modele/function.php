<?php 

// FUNCTION REGISTER 

function register($firstname, $secondname, $email, $password, $statut, $pdo) {
    
    $sql = "INSERT INTO utilisateurs(Prenom, login, Mail, Mdp, Statut) VALUES('$secondname','$firstname','$email', '$password','$statut')";
    $req = $pdo->prepare("SELECT user_id FROM UTILISATEURS WHERE mail = :email");

    $req->execute(array('email' => $email));
    $count = $req->rowCount();
    if ($count != 0) {
        global $doublon;
        $doublon = true;
    } else {
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
            $_SESSION['Prenom'] = $contenu['Prenom'];
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

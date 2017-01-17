<?php 

// FUNCTION REGISTER 

function register($firstname, $secondname, $email, $password, $statut, $pdo) {
    
    $sql = "INSERT INTO utilisateurs(Prenom, Nom_ut, Mail, Mdp, Statut) VALUES('$secondname','$firstname','$email', '$password','$statut')";
    $req = $pdo->prepare("SELECT ID_ut FROM UTILISATEURS WHERE mail = :email");

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

    $reponse_pseudo = $pdo->query('SELECT Nom_ut FROM UTILISATEURS');
    $reponse_password = $pdo->query('SELECT Mdp FROM UTILISATEURS');

    //Je vérifie tout mes champs logins
    while ($donnees = $reponse_pseudo->fetch() AND $donees2 = $reponse_password->fetch()) {
        if ($_POST['prenom'] == $donnees['Nom_ut'] AND $_POST['password'] == $donees2['Mdp']) {

            //Enregistrement de l'ID dans la SESSION

            $pseudo = $_POST['prenom'];
            $password = $_POST['password'];

            $req = $pdo->prepare("SELECT ID_ut FROM UTILISATEURS WHERE Nom_ut = :pseudo AND Mdp = :password");
            $req->execute(array('pseudo' => $pseudo, 'password' => $password));

            $contenu = $req->fetch();
            $_SESSION['id'] = $contenu['ID_ut'];

            global $id;
            $id = $_SESSION['id'];
            
            //Enregistrement de L'adresse Mail dans la SESSION

            $req_mail = $pdo->prepare("SELECT * FROM UTILISATEURS WHERE ID_ut = :id ");
            $req_mail->execute(array('id' => $id));

            $contenu = $req_mail->fetch();
            $_SESSION['mail'] = $contenu['Mail'];
            $_SESSION['Prenom'] = $contenu['Prenom'];
            $_SESSION['Nom_ut'] = $contenu['Nom_ut'];
            $_SESSION['Statut'] = $contenu['Statut'];
            $_SESSION['ID_ut'] = $contenu['ID_ut'];

            global $mail;
            $mail = $_SESSION['mail'];

            //Enregistrement du statut dans la SESSION

            $req_statut = $pdo->prepare("SELECT Statut FROM UTILISATEURS WHERE ID_ut = :id");
            $req_statut->execute(array('id' => $id));

            $contenu_statut = $req_statut->fetch();
            $_SESSION['statut'] = $contenu_statut['Statut'];

            global $statut;
            $statut = $_SESSION['statut'];

            // Connexion en étudiant ou professionnel
            if ($statut != 'administrateur') {

                global $connexion;
                $connexion = true;

                // Connexion en admin
            } else if ($statut == 'administrateur') {
                global $connexionA;
                $connexionA = true;
            }
        }
    }

    $reponse_pseudo->closeCursor();
    $reponse_password->closeCursor();
}

?>
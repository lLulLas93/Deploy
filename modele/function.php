<?php 

// FUNCTION REGISTER 

function register($firstname, $secondname, $email, $password, $statut, $pdo) {
    
    $sql = "INSERT INTO utilisateurs(Prenom, Nom_ut, Mail, Mdp, Statut) VALUES('$secondname','$firstname','$email', '$password','$statut')";
    $req = $pdo->prepare("SELECT ID_ut FROM utilisateurs WHERE mail = :email");

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

    $reponse_pseudo = $pdo->query('SELECT Nom_ut FROM utilisateurs');
    $reponse_password = $pdo->query('SELECT Mdp FROM utilisateurs');

    //Je vérifie tout mes champs logins
    while ($donnees = $reponse_pseudo->fetch() AND $donees2 = $reponse_password->fetch()) {
        if ($_POST['prenom'] == $donnees['Nom_ut'] AND $_POST['password'] == $donees2['Mdp']) {

            //Enregistrement de l'ID dans la SESSION

            $pseudo = $_POST['prenom'];
            $password = $_POST['password'];

            $req = $pdo->prepare("SELECT ID_ut FROM utilisateurs WHERE Nom_ut = :pseudo AND Mdp = :password");
            $req->execute(array('pseudo' => $pseudo, 'password' => $password));

            $contenu = $req->fetch();
            $_SESSION['id'] = $contenu['ID_ut'];

            global $id;
            $id = $_SESSION['id'];
            
            //Enregistrement de L'adresse Mail dans la SESSION

            $req_mail = $pdo->prepare("SELECT * FROM utilisateurs WHERE ID_ut = :id ");
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

            $req_statut = $pdo->prepare("SELECT Statut FROM utilisateurs WHERE ID_ut = :id");
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
// FUNCTION enregistrement réunion

function registerReunion($pdo, $id, $ordre, $date_r, $heure_d, $heure_f, $lieu, $compte_rendu_r) {
	
	if (verif_heur($heure_d, $heure_f) == 1){
		echo '<div class="alert alert-danger" role="alert" align="center">la reunion fini avant qu\'elle ne commence </div>';
	    include('./view/reunion_add.html');
	}	
	else if (chek_date($date_r) == 1)
		{
			echo '<div class="alert alert-danger" role="alert" align="center">la reunion ne peut ce faire dans le passé </div>';
			include('./view/reunion_add.html');
		}
	else
{
    $sql = $pdo->prepare("INSERT INTO reunions(Instigateur, Ordre, Date_r, Heure_d, Heure_f, Lieu, Compte_rendu_r) VALUES(:id, :ordre, :date_r, :heure_d, :heure_f, :lieu, :compte_rendu_r)");

    $verif = $sql->execute(array('id' => $id, 'ordre' => $ordre, 'date_r' => $date_r, 'heure_d' => $heure_d, 'heure_f' => $heure_f, 'lieu' => $lieu, 'compte_rendu_r' => $compte_rendu_r));
	
    if (!$verif) {
        echo '<div class="centerr">';
        echo 'echoué';
        echo '</div>';
    } else {
        global $registerReunion;
        $registerReunion = true;
     
    }
}
}

// FUNCTION modification des reunions

// Partie TOM

function verif_heur($heure_d, $heure_f)
{
	$i = date($heure_d);
	$j = date($heure_f);
	
	if ($j <= $i)
		return (1);
	else
		return (0);
}

function chek_date_diff($date_d, $date_f)
{
	$i = date($date_f);
	$j = date($date_d);
	$datetime1 = date_create($j);
    $datetime2 = date_create($i);
	
	$interval = $datetime1->diff($datetime2);
	if ($interval->format('%R%a days') < 0)
		return (1);
	else
		return (0);
}

function chek_date($date_r)
{
	$i = date($date_r);
	$j = date('Y-m-d');
	$datetime1 = date_create($j);
    $datetime2 = date_create($i);
	
	$interval = $datetime1->diff($datetime2);
	if ($interval->format('%R%a days') < 0)
		return (1);
	else
		return (0);
}
function modif_reu($reunions_mod, $pdo){

	global $data;
	
	 $id = $_SESSION['id'];
	
	$sql = $pdo->prepare('SELECT * FROM reunions WHERE Ordre LIKE :reunions_mod');

    $verif = $sql->execute(array('reunions_mod' => $reunions_mod));

	$data = $sql->fetch(PDO::FETCH_ASSOC);

	//var_dump($data);

	if ($data){
		if($data['Instigateur'] == $id)
			return ($data);
		else
			return (-1);
	}	
	else {
		return (0);
	}
}



function sql_modif($pdo, $ordre, $date_r, $heure_d, $heure_f, $lieu, $compte, $ID_reunion){
   
   
    $id = $_SESSION['id'];
	$sql = $pdo-> prepare('UPDATE reunions SET Date_r = :date_r, Heure_d = :heure_d, Heure_f = :heure_f, Lieu = :lieu, Compte_rendu_r = :compte_rendu_r WHERE ID_reunion = :ID_reunion AND Instigateur = :id');
	$verif = $sql->execute(array('date_r' => $date_r, 'heure_d' => $heure_d, 'heure_f' => $heure_f, 'lieu' => $lieu, 'compte_rendu_r' => $compte, 'ID_reunion' => $ID_reunion, 'id' => $id));
	if ($verif) {
		echo 'Reunion bien modifier';
    } else {
        echo 'Erreur modification';
    }
	}

	// fin de Partie de TOM
	
?>
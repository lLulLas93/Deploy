<?php 
session_start();

// Connexion a la base de donnée, Check connection

try {
    $pdo = new PDO('mysql:host=localhost;dbname=DeployDev', 'root', 'deployitdbinside');
    $pdo->exec('SET NAMES utf8');
} catch (PDOException $e) {
    print "Erreur !: ".$e->getMessage()."<br/>";
    die();
}
$query = '';
echo '<link rel="icon" type="image/png" href="./design/LOGO-OFFICIEL-2.png"';
$query = (isset($_GET['page'])) ? $_GET['page'] : '';

switch ($query) {
    case '':
        include 'controler/index.php';
        break;
    case 'inscription':
	include 'controler/inscription.php';
	break;
    case 'connexionC':
        include 'controler/connexionC.php';
        break;
    case 'deconnexion':
        include 'controler/deco.php';
        break;	
	case 'accueil':
        include 'controler/accueil.php';
        break;
	case 'projet':
        include 'controler/projet.php';
        break;
	case 'profil':
        include 'controler/profil.php';
        break;
	case 'view_projet':
        include 'controler/view_projet.php';
        break;
	case 'deploy_projet':
        include 'controler/deploy_projet.php';
		break;	
	case 'deploy_confirmation':
	include 'controler/deploy_confirmation.php';
		break;
	case 'deployed_projet':
        include 'controler/deployed_projet.php';
		break;
	case 'create_projet':
        include 'controler/create_projet.php';
        break;
	case 'add_member':
        include 'controler/add_member.php';
        break;
	case 'profil':
        include 'controler/profil.php';
        break;
	case 'member_area':
        include 'controler/member_area.php';
        break; 
	case 'verif_projet':
        include 'controler/verif_projet.php';
        break;
	case 'view_profil':
        include 'controler/view_profil.php';
        break;
  // Fin de partie de TOM
    default:
        echo '<h1>Cette page est inexistante</h1>';
        break;
		
}
?>

<?php 
session_start();

//Connexion a la base de donnée, Check connection

// try {
    // $pdo = new PDO('mysql:host=localhost;dbname=programmation', 'root', 'toor');
    // $pdo->exec('SET NAMES utf8');
// } catch (PDOException $e) {
    // print "Erreur !: ".$e->getMessage()."<br/>";
    // die();
// }
$query = '';

$query = (isset($_GET['page'])) ? $_GET['page'] : '';

switch ($query) {
    case '':
        include 'controler/index.php';
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
	case 'ddeploy_projet':
        include 'controler/ddeploy_projet.php';
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
  
  // Fin de partie de TOM
    default:
        echo '<h1>Cette page est inexistante</h1>';
        break;
		
}
?>
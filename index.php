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
	case 'dco':
        include 'controler/co.php';
        break;
	case 'projet':
        include 'controler/projet.php';
        break;
  
  // Fin de partie de TOM
    default:
        echo '<h1>Cette page est inexistante</h1>';
        break;
		
}
?>
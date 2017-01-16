<?php            

include ('function.php');

// Récupérer des donnees

$a = date("Y-m-d");
$nom_p = $_POST["projet_nom"];
$langage = $_POST["langage"];
$participants = $_POST["participants"];
$description = $_POST["description"];
$logo = $_FILES['image']['name'];
$difficultes = $_POST['difficultes'];
$date_de_creation = "$a";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requete1 = $pdo->prepare("SELECT * FROM projets ");
$requete1->execute();
$resultat = $requete1->fetchall(PDO::FETCH_ASSOC);

$total = count($resultat);

for ($i = 0; $i < $total; $i++) {

    $a = $resultat[$i];
    if ($resultat[$i]['Nom_p'] == "$nom_p") {

        echo "<meta http-equiv='refresh' content='2; url=index.php?page=create_projet&projet' />";

    } else {
      	
	$rep_dest = "./modele/reception/";	
	if(move_uploaded_file($_FILES['image']['tmp_name'],$rep_dest . $_FILES['image']['name'])){

		echo'<br/>';
		
		print"Bon Travail :)"; 
		echo'<br/>';
		

	}else {

		print "PAS BON :( nb d'erreur ";
		// print_r($_FILES['image']['error']);

	}
	//Recuperation de donnée
	

	$statut = $_SESSION['Statut'];
	$a = date("Y-m-d");
	$nom_p = addslashes($_POST["projet_nom"]);
	$langage = addslashes($_POST["langage"]);
	$participants = $_POST["participants"];
	$description = addslashes($_POST["description"]);
	$logo = $_FILES['image']['name'];
	$difficultes = $_POST['difficultes'];
	$date_de_creation = "$a";
	$instigateur = $_SESSION['id'];
	
	
	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$insertion = "
				INSERT INTO projets(Date_de_creation,Nom_p,Instigateur,Langage,Description,Logo,statut,difficultes,vote,Participant)
				VALUES ('$date_de_creation','$nom_p',$instigateur,'$langage','$description','$logo','$statut','$difficultes',0,'$participants')
				";
	
	$pdo->exec($insertion);
			echo 'Valeurs bien inserée';
		        echo "<meta http-equiv='refresh' content='1; url=index.php?page=projet_view' />";
	echo'<br/>';
	echo'<br/></h4></div>';
    }

}


?>
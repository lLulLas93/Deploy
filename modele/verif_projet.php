<?php            

// Récupérer des donnees

$a = date("Y-m-d");
$nom_p = $_POST["projet_nom"];
$langage = $_POST["langage"];
$description = $_POST["description"];
$logo = $_FILES['image']['name'];
$mdp = $_POST['mdp'];
$date_de_creation = "$a";
$instigateur = $_SESSION['id'];

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete1 = $pdo->prepare("SELECT * FROM PROJETS");
$requete1->execute();
$resultat = $requete1->fetchall(PDO::FETCH_ASSOC);

$total = count($resultat);

for ($i = 0; $i < $total; $i++) {

    $a = $resultat[$i];
    if ($resultat[$i]['Nom_p'] == "$nom_p") {
        echo "<meta http-equiv='refresh' content='2; url=index.php?page=create_projet&projet' />";
    } 
}
	$projet = $i;

	$rep_dest = "./modele/reception/";	
	if(move_uploaded_file($_FILES['image']['tmp_name'],$rep_dest . $_FILES['image']['name'])){
		print"Bon Travail :)"; 
		echo'<br/>';
	}else {
        echo "<meta http-equiv='refresh' content='2; url=index.php?page=create_projet&projet' />";
		print "PAS BON :( nb d'erreur ";
		// print_r($_FILES['image']['error']);
	}
	$pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$insertion = "
				INSERT INTO PROJETS(Date_de_creation,Nom_projet,db_active,git_sftp,Langage,Description,Logo)
				VALUES ('$date_de_creation','$nom_p',1,1,'$langage','$description','$logo')";

	$insertion2 = "
				INSERT INTO statut(Deploy,projet_id,statut,user_id)
				VALUES (0,'$projet',1,'$instigateur')";

	echo exec("./code_fini/Creer/create_projet.sh $nom_p $mdp $user");
	
	//$pdo->exec($insertion);
	//$pdo->exec($insertion2);
			echo 'Valeurs bien inserée';
		    echo "<meta http-equiv='refresh' content='1; url=index.php?page=view_projet' />";
	echo'<br/>';
	echo'<br/></h4></div>';
   

?>

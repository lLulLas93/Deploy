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

        $i = $total;
        $i += 1;

        $projet = 0;

    } else {
        $projet = 1;
    }

}

if (isset($projet)) {
    if ($projet == 1) {
        require '/modele/register_projet.php';
		include( './view/confirmation_projet.html' );

    }
}

?>
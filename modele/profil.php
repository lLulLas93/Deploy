<?php            

include ('function.php');

// Récupérer des donnees

$a = date("Y-m-d");
$nom_p = $_POST["projet_nom"];
$langage = $_POST["langage"];
$participants = $_POST["participants"];
$d_f = $_POST["d_f"];
$d_d = $_POST["d_d"];
$description = $_POST["description"];
$logo = $_FILES['image']['name'];
$difficultes = $_POST['difficultes'];
$date_de_creation = "$a";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requete1 = $pdo->prepare("SELECT * FROM projets ");
$requete1->execute();
$resultat = $requete1->fetchall(PDO::FETCH_ASSOC);

$total = count($resultat);

if (chek_date_diff($d_d, $d_f) == 1)
{
	echo '<div class="alert alert-danger" role="alert" align="center"><h3>Projet fini avant de commencer</h3></div>';
    echo "<meta http-equiv='refresh' content='5; url=index.php?page=projet_add' />";
}

else{

for ($i = 0; $i < $total; $i++) {

    $a = $resultat[$i];
    if ($resultat[$i]['Nom_p'] == "$nom_p") {

        echo '<div class="alert alert-danger" role="alert" align="center"><h3>Projet Existant</h3></div>';
        echo "<meta http-equiv='refresh' content='5; url=index.php?page=projet_add' />";

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
    }
}
}
?>
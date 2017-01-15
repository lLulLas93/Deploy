<?php // Récupérer des donnees
$s = 0;	

echo'</br></br></br>';

$id_ut = $_SESSION['id'];

echo '<div class="STYLE-NAME">';

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requete1 = $pdo->prepare("SELECT * FROM projets");

$requete1->execute();

$resultat = $requete1->fetchall(PDO::FETCH_ASSOC);
/*
	echo'<pre>';
	print_r($resultat);
	echo'</pre>';
	*/

$total = count($resultat);
	/*
	echo'<pre>';
	print_r($num);
	echo'</pre>';
	*/


	
for ($i = 0; $i < $total; $i++) {
	
    $a = $resultat[$i];

    foreach($a as $n => $valeur) {
		
		 if ($n == "ID_projet" && (!$valeur || $valeur)) {

            $id_projet = $valeur;
            echo "<h1><br/><br/>Projet N° ".$valeur."</h1>";
			echo "<form action='' method='POST'>
				<button class='btn wow tada btn-embossed btn-primary pull-right' name='vote' valeur='$s'> Voter ce projet</button>
				<input type='hidden' name='id_projet' value='$id_projet'>
				</form>";

       
        } else if ($n == "Logo" && $valeur) {

            echo "<h5>".$n. " : &nbsp&nbsp&nbsp <img src='../programmation/modele/reception/$valeur' width='80' height='40'> </h5>";

        } else if ($n == "difficultes" && $valeur) {

            echo '<br/>';
            echo "Difficultés : $valeur%";

        } else if ($n == "Instigateur" && (!$valeur || $valeur)) {

            $nom_inst = $pdo->query("SELECT U.id_ut, U.Prenom, U.Nom_ut FROM utilisateurs U WHERE ID_ut=$valeur");
            $nom = $nom_inst->fetch();
            echo "<br/>".$n." (chef de projet) : ".$nom['Prenom']." ".$nom['Nom_ut'];
            $instigateur = $nom['id_ut'];

		} else if ($n == "Participant" && $valeur) {
          
			$nb = 0;
          	$num_inst = $pdo->query("SELECT ID_ut,ID_projet FROM PARTICIPANTS_PR WHERE ID_projet=$id_projet");
			$num = $num_inst->fetchall();		
			$nb_num = count($num);
			
		for ($a = 0; $a < $nb_num; $a++) {
			
			$id_participant = $num[$a][0];
			if ($instigateur == $id_ut){
					$re = 4;
					$result = 0;
					$results = 4;
					$a=$nb_num;
				}else if ($id_participant == $id_ut){
					$result = 4;
					$results = 4;
					$re = 0;
					$a=$nb_num;
				}else if (($id_participant != $id_ut && $instigateur != $id_ut)){
					$results = 0;
					$result = 4;
					$re = 4;
					}
			}
				if($num){
					echo "<br/>";
					echo " Nombre de ".$n." : $nb_num/".$valeur;
					echo '<br/>';    echo '<br/>';
					echo "<br/> Participant : "; 
			
						for ($a = 0; $a < $nb_num; $a++) {
							$id_participant = $num[$a][0];
							$id_projet = $num[$a][1];
							$nom_inst = $pdo->query("SELECT Prenom,Nom_ut FROM utilisateurs WHERE ID_ut=$id_participant ");
							$nom = $nom_inst->fetch();
							echo $nom['Prenom']." ".$nom['Nom_ut'].",</br>";
						}
				}else{
					echo "<br/>";
					echo " Nombre de ".$n." : 0/".$valeur;
					echo '<br/>';    echo '<br/>';
				
					echo "<br/><br/><br/> Participant : "; 
					echo " Aucun";
				
				}
						if($re == 0){
								echo '<br/>';
								echo "<form action='index.php' method='GET'>
									<input type='hidden' name='page' value='member_area'>
									</br>										  
									<button class='btn btn-info btn-xs' name='plus'>Echanger avec les membres groupe</button>
									<input type='hidden' name='id_projet' value='$id_projet'>
									</form>
									 ";
						}
						if($result == 0){

								echo '<br/>';
									echo "<form action='' method='POST'>
									</br>
									<button class='btn btn-info btn-xs' name='suprimer'>Suprimer</button>
									<input type='hidden' name='id_projet' value='$id_projet'>
									</form>
									
									<form action='index.php' method='GET'>
									<input type='hidden' name='page' value='projet_edit'>
									<input type='hidden' name='id_projet' value='$id_projet'>
									</br>
									<button class='btn btn-info btn-xs'>Modifier</button>
									</form>
																			
									<form action='index.php' method='GET'>
									<input type='hidden' name='page' value='member_area'>
									</br>										  
									<button class='btn btn-info btn-xs' name='plus'>Echanger avec les membres groupe</button>
									<input type='hidden' name='id_projet' value='$id_projet'>
									</form>
									";
						}
						if($results == 0){
								echo "<form action='' method=POST>
									</br>
									<button class='btn btn-info btn-xs' name='ajouter'> S'ajouter</button>
									<input type='hidden' name='id_projet' value='$id_projet'>
									</form>";	
										
						}echo "<br/><br/><br/><br/><br/>";

} else {

            echo "<br/>".$n." : ".$valeur;
        }
    }
}

// Suprimer projet

if (isset($_POST['suprimer'])) {
	
	$id_projet = $_POST['id_projet'];
    $reponseDelete = $pdo->prepare("DELETE FROM projets WHERE Instigateur ='$id_ut' && ID_projet ='$id_projet' ");
    $reponseDelete->execute();
    if ($reponseDelete) {
        echo'<META http-equiv="refresh" content="0;URL=index.php?page=projet_view">';
        echo 'good';
    } else {
        echo 'Erreur modification';
    }
}

if (isset($_POST['ajouter'])) {
	echo '<br>';
	$id_projet = $_POST['id_projet'];
	$id_ut_pr = $pdo->query("SELECT ID_ut FROM PARTICIPANTS_PR WHERE ID_projet=$id_projet");
	$id_ut_pro = $id_ut_pr->fetch();
	print_r($id_ut_pro);
		if($id_ut != $id_ut_pro['ID_ut'] ){
			
			$ajout = $pdo->prepare("INSERT INTO PARTICIPANTS_PR(ID_ut,ID_projet ) VALUES ('$id_ut','$id_projet')");
			$ajout->execute();
			echo'<META http-equiv="refresh" content="0.05;URL=index.php?page=projet_view">';
		}else{
			echo 'Vous participez déjà à ce projet';
		
		
		}						
	}

if (isset($_POST['vote'])) {
	if ($_POST['vote'] == 0) {
		$s++;
		$id_projet = $_POST['id_projet'];
		
			echo' je suis entrer';
			$modification2 = $pdo->prepare("UPDATE projets SET Vote = Vote+1 WHERE ID_projet = '$id_projet'");
			$modification2->execute();
			echo'<META http-equiv="refresh" content="0;URL=index.php?page=projet_view">';
			$p = false;
	}else{
		echo'Vous avez déjà votez';
	}
}
	
	
if (isset($_POST['plus'])) {
		echo'<META http-equiv="refresh" content="0;URL=index.php?page=member_area">';
	
}

echo '<br/>';
echo '<br/>';
echo '</div>';

?>
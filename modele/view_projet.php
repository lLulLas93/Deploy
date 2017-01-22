<?php // Récupérer des donnees

// $requete1 = $pdo->prepare("SELECT * FROM PROJETS P INNER JOIN STATUT S  WHERE S.user_id = $user_id");
// $requete1->execute();
// $resultat = $requete1->fetchall(PDO::FETCH_ASSOC);
	//echo'<pre>';
	// print_r($id_projet_chef[0]);
	// echo'</pre>';
// echo '</br></br></br></br></br></br></br>';
// print_r($id_projet_chef);

$user_id = $_SESSION['id'];	

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$requete1 = $pdo->prepare("SELECT projet_id FROM STATUT S  WHERE S.user_id = $user_id and S.statut = 1");
$requete1->execute();
$id_projet_chef = $requete1->fetch(PDO::FETCH_ASSOC);

$requete1 = $pdo->prepare("SELECT projet_id FROM STATUT S  WHERE S.user_id = $user_id and S.statut = 0");
$requete1->execute();
$id_projet_participant = $requete1->fetchall(PDO::FETCH_ASSOC);
	$nb_pr_participant = count($id_projet_participant);

	
if(!$id_projet_chef && !$nb_pr_participant){
	
	echo'vous avez pas de projet en tant que id_projet_chef de projet ';
	echo'vous avez pas de projet en tant que participants   ';
	echo'Créer votre premiers projet ici ';
	
	
    echo'<form enctype="multipart/form-data" action="index.php?page=create_projet" method="post">
<div class="row">
                            <div class="form-group col-xs-12">
                                <center><button type="submit" class="btn btn-success btn-lg">Créer votre premiers projet </button></center>
                            </div>
                        </div>
</form>
';
	
	
	
	
}else if (!$nb_pr_participant && $id_projet_chef){

echo'<form action="index.php?page=deploy_projet" method="POST">
                            <div class="form-group col-xs-4">
                                <center><button type="submit" class="btn btn-primary btn-lg btn-block" >Deploiement </button></center></div>
</form>';

		//Affiche projet dont on n'est chef
		
$ipc = $id_projet_chef['projet_id'];	     
$projet = $pdo->prepare("SELECT * FROM PROJETS WHERE projet_id = $ipc");
$projet->execute();
$projet = $projet->fetchall(PDO::FETCH_ASSOC);
	echo'<pre><pre>';
	 $a = $projet[0];
    
echo'<form action="index.php?page=deploy_projet" method="POST">
<input type="submit" name="deploy" value="Déploiement">
</form>';

foreach($a as $n => $valeur) {
		
		 if ($n == "projet_id" && (!$valeur || $valeur)) {

            echo "<h1><br/><br/>Projet N° ".$valeur."</h1>";
			$participant_pr = $pdo->prepare("SELECT * FROM STATUT S  WHERE S.projet_id = $valeur");
			$participant_pr->execute();
			$participant_pr = $participant_pr->fetchall(PDO::FETCH_ASSOC);
        }else if ($n == "nom_projet" && $valeur) {

            echo "<h1>Mon projet : $valeur </h1>";

        }else if ($n == "date_de_creation" && (!$valeur || $valeur)) {

            echo "<h5><br/><br/>Date de Création : ".$valeur."</h5>";

        }  else if ($n == "langage" && $valeur) {

            echo "<h5>Langage : $valeur</h5>";

        } else if ($n == "description" && $valeur) {

            echo "<h5> Description: $valeur</h5>";

        } else if ($n == "logo" && $valeur) {

            echo "<h5>".$n. " : &nbsp&nbsp&nbsp <img src='./modele/reception/$valeur' width='80' height='40'> </h5>";

        }  else if ($n == "git_sftp") {
			
			if (!$valeur){
            echo "<br/>Vous utilisez le système git";//git 0
			}else{
			 echo "<br/>Vous utilisez le système SFTP";//SFTP 1
			}

		} else if ($n == "db_active") {

			if ($valeur){
            echo "<br/>Vous utilisez une base de données";//db 1
			}else{
			echo "<br/>Vous utilisez pas un base de données";//db 0
			}
			echo "<br/><br/>Participant : ";
			$nb_ = count($participant_pr);
			for ($a = 0; $a < $nb_; $a++) {
			$pp=$participant_pr["$a"]['user_id'];
		    $num_inst = $pdo->query("SELECT login,prenom FROM UTILISATEURS WHERE user_id=$pp");
			$id = $num_inst->fetch();
			echo $id['prenom']." ".$id['login'].", ";
		}
		}
	}
		echo'</pre></pre>';	
	
	
	
	
	
	
	
}else if ($nb_pr_participant && !$id_projet_chef){
	

	//Affiche projet dont on n'est participant

	echo'<form enctype="multipart/form-data" action="index.php?page=create_projet" method="post">  
<div class="row">
                            <div class="form-group col-xs-12">
                                <center><button type="submit" class="btn btn-success btn-lg">Créer votre premiers projet </button></center>
                            </div>
                        </div>
</form>
';

for ($i = 0; $i < $nb_pr_participant; $i++) {	
	
$a = $id_projet_participant[$i]['projet_id'];
// print_r($id_projet_participant);

$requete1 = $pdo->prepare("SELECT * FROM PROJETS WHERE projet_id = $a");
$requete1->execute();
$projet = $requete1->fetchall(PDO::FETCH_ASSOC);
 
	// echo'</br></br>PRojet';
	 // print_r($projet);

echo '<pre> ';		

    foreach($projet[0] as $n => $valeur) {
		
		 if ($n == "projet_id" && (!$valeur || $valeur)) {

            echo "<h1><br/><br/>Projet N° ".$valeur."</h1>";
			$participant_pr = $pdo->prepare("SELECT * FROM STATUT S  WHERE S.projet_id = $valeur");
			$participant_pr->execute();
			$participant_pr = $participant_pr->fetchall(PDO::FETCH_ASSOC);
			
        }else if ($n == "nom_projet" && $valeur) {

            echo "<h1>Nom du projet : $valeur </h1>";

        }else if ($n == "date_de_creation" && (!$valeur || $valeur)) {

            echo "<h5><br/><br/>Date de Création : ".$valeur."</h5>";

        }  else if ($n == "langage" && $valeur) {

            echo "<h5>Langage : $valeur</h5>";

        } else if ($n == "description" && $valeur) {

            echo "<h5> Description: $valeur</h5>";

        } else if ($n == "logo" && $valeur) {

            echo "<h5>".$n. " : &nbsp&nbsp&nbsp <img src='./modele/reception/$valeur' width='80' height='40'> </h5>";

        }  else if ($n == "deploy") {
			
			if (!$valeur){
            echo "<br/>Votre chef de projet n'a pas déployer";//deploy 0
			}else{
			 echo "<br/>Votre chef de projet a pas déployer";//deploy 1
			}}  else if ($n == "git_sftp") {
			
			if (!$valeur){
            echo "<br/>Vous utilisez le système git";//git 0
			}else{
			 echo "<br/>Vous utilisez le système SFTP";//SFTP 1
			}

		} else if ($n == "db_active") {

			if ($valeur){
            echo "<br/>Vous utilisez une base de données";//db 1
			}else{
			echo "<br/>Vous utilisez pas un base de données";//db 0
			}
			
			$nb_ = count($participant_pr);
			echo "<br/><br/>Participant : ";
		for ($a = 0; $a < $nb_; $a++) {
			$pp=$participant_pr["$a"]['user_id'];
		    $num_inst = $pdo->query("SELECT login,prenom FROM UTILISATEURS WHERE user_id=$pp");
			$id = $num_inst->fetch();
			echo $id['prenom']." ".$id['login'].", ";
		}
		} 
	}	echo '</pre>';
}		
 
 
}else if ($nb_pr_participant && $id_projet_chef){
	

	
	//Affiche projet dont on n'est les chef et participant 2
		
$ipc = $id_projet_chef['projet_id'];	     
$projet = $pdo->prepare("SELECT * FROM PROJETS WHERE projet_id = $ipc");
$projet->execute();
$projet = $projet->fetchall(PDO::FETCH_ASSOC);
	echo'<pre><pre>';
	 $a = $projet[0];

echo'<form action="index.php?page=deploy_projet" method="POST">
                            <div class="form-group col-xs-4">
                                <center><button type="submit" class="btn btn-primary btn-lg btn-block" >Deploiement </button></center></div>
</form>';
    foreach($a as $n => $valeur) {
		
		 if ($n == "projet_id" && (!$valeur || $valeur)) {

            echo "<h1><br/><br/>Projet N° ".$valeur."</h1>";
			$participant_pr = $pdo->prepare("SELECT * FROM STATUT S  WHERE S.projet_id = $valeur");
			$participant_pr->execute();
			$participant_pr = $participant_pr->fetchall(PDO::FETCH_ASSOC);
        }else if ($n == "nom_projet" && $valeur) {

            echo "<h1>Mon projet : $valeur </h1>";

        }else if ($n == "date_de_creation" && (!$valeur || $valeur)) {

            echo "<h5><br/><br/>Date de Création : ".$valeur."</h5>";

        }  else if ($n == "langage" && $valeur) {

            echo "<h5>Langage : $valeur</h5>";

        } else if ($n == "description" && $valeur) {

            echo "<h5> Description: $valeur</h5>";

        } else if ($n == "logo" && $valeur) {

            echo "<h5>".$n. " : &nbsp&nbsp&nbsp <img src='./modele/reception/$valeur' width='80' height='40'> </h5>";

        }  else if ($n == "git_sftp") {
			
			if (!$valeur){
            echo "<br/>Vous utilisez le système git";//git 0
			}else{
			 echo "<br/>Vous utilisez le système SFTP";//SFTP 1
			}

		} else if ($n == "db_active") {

			if ($valeur){
            echo "<br/>Vous utilisez une base de données";//db 1
			}else{
			echo "<br/>Vous utilisez pas un base de données";//db 0
			}
			echo "<br/><br/>Participant : ";
			$nb_ = count($participant_pr);
			for ($a = 0; $a < $nb_; $a++) {
			$pp=$participant_pr["$a"]['user_id'];
		    $num_inst = $pdo->query("SELECT login,prenom FROM UTILISATEURS WHERE user_id=$pp");
			$id = $num_inst->fetch();
			echo $id['prenom']." ".$id['login'].", ";
		}
		}
	}
		echo'</pre></pre>';	

	//Afficher les projets auxquelles participant	
	
for ($i = 0; $i < $nb_pr_participant; $i++) {	
	
$a = $id_projet_participant[$i]['projet_id'];
// print_r($id_projet_participant);

$requete1 = $pdo->prepare("SELECT * FROM PROJETS WHERE projet_id = $a");
$requete1->execute();
$projet = $requete1->fetchall(PDO::FETCH_ASSOC);
 
	// echo'</br></br>PRojet';
	 // print_r($projet);

echo '<pre> ';		

    foreach($projet[0] as $n => $valeur) {
		
		 if ($n == "projet_id" && (!$valeur || $valeur)) {

            echo "<h1><br/><br/>Projet N° ".$valeur."</h1>";
			$participant_pr = $pdo->prepare("SELECT * FROM STATUT S  WHERE S.projet_id = $valeur");
			$participant_pr->execute();
			$participant_pr = $participant_pr->fetchall(PDO::FETCH_ASSOC);

        }else if ($n == "nom_projet" && $valeur) {

            echo "<h1>Nom du projet : $valeur </h1>";

        }else if ($n == "date_de_creation" && (!$valeur || $valeur)) {

            echo "<h5><br/><br/>Date de Création : ".$valeur."</h5>";

        }  else if ($n == "langage" && $valeur) {

            echo "<h5>Langage : $valeur</h5>";

        } else if ($n == "description" && $valeur) {

            echo "<h5> Description: $valeur</h5>";

        } else if ($n == "logo" && $valeur) {

            echo "<h5>".$n. " : &nbsp&nbsp&nbsp <img src='./modele/reception/$valeur' width='80' height='40'> </h5>";

        }  else if ($n == "deploy") {
			
			if (!$valeur){
            echo "<br/>Votre chef de projet n'a pas déployer";//deploy 0
			}else{
			 echo "<br/>Votre chef de projet a pas déployer";//deploy 1
			}}  else if ($n == "git_sftp") {
			
			if (!$valeur){
            echo "<br/>Vous utilisez le système git";//git 0
			}else{
			 echo "<br/>Vous utilisez le système SFTP";//SFTP 1
			}

		} else if ($n == "db_active") {

			if ($valeur){
            echo "<br/>Vous utilisez une base de données";//db 1
			}else{
			echo "<br/>Vous utilisez pas un base de données";//db 0
			}

			$nb_ = count($participant_pr);
			echo "<br/><br/>Participant : ";
		for ($a = 0; $a < $nb_; $a++) {
			$pp=$participant_pr["$a"]['user_id'];
		    $num_inst = $pdo->query("SELECT login,prenom FROM UTILISATEURS WHERE user_id=$pp");
			$id = $num_inst->fetch();
			echo $id['prenom']." ".$id['login'].", ";
		}
		} 
	}	echo '</pre>';
}		
 
 
}
?>

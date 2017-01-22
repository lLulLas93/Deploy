<?php

include('./view/head.html');
include('./view/nav.html');
include('./view/view_profil.html');
include('./modele/view_profil.php');

if($donnees_2['deploy'] == 0) {
        $etat = 'non deploye';
} else {
        $etat = 'deploye';
};

echo '<div class="row">
         <div >
            <div class="panel panel-default">
               <div class="panel-heading">
                   <h3 class="panel-title"><i class="fa fa-fw fa-table"></i> Projets</h3>
               </div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover table-striped">
                        <thead>
                           <tr>
                              <th>Nom de projet</th>
                              <th>Description</th>
                              <th>Participants</th>
                              <th>Etat</th>
                            </tr>
                            </thead>
                            <tbody>
                               <tr>
                                  <td>'.$donnees_2['nom_projet'].'</td>
                                  <td>'.$donnees_2['description'].'</td>
                                  <td>';

for($i=0;$i<count($donnees_3);$i++) {
	echo $donnees_3[$i]['nom'].' - ';
};

echo '</td>
                                  <td>'.$etat.'</td>
                               </tr>
                               <tr>
                                  <td>(nom_p)</td>
                                  <td>(description)</td>
                                  <td>(noms membres)</td>
                                  <td>(Déployer, Redéployer, Supprimer)</td>
                               </tr>
                               <tr>
                                  <td>(nom_p)</td>
                                  <td>(description)</td>
                                  <td>(noms membres)</td>
                                  <td>(Déployer, Redéployer, Supprimer)</td>
                                </tr>
                                <tr>
                                   <td>(nom_p)</td>
                                   <td>(description)</td>
                                   <td>(noms membres)</td>
                                   <td>(Déployer, Redéployer, Supprimer)</td>
                                </tr>
                            </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>

<font size=5>Informations personnelles</font><p><p>
	<font size=5><span class="label label-info">Nom :</span></font> '.$donnees['nom'].'<input type="hidden" name="prenom" value="'.$donnees['nom'].'">
	<p><p>
	<font size=5><span class="label label-info">Login :</span></font> '.$donnees['login'].'<input type="hidden" name="nom" value="'.$donnees['login'].'">
	<p><p>
	<font size=5><span class="label label-info">Mail :</span></font> '.$donnees['mail'].'<input type="hidden" name="mail" value="'.$donnees['mail'].'"></div></div></div>
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->' ;

include('./view/end.html');
//echo "SAULT";

?>

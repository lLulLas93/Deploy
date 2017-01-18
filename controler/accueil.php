<?php

include('./view/head.html');
include('./view/nav.html');
include('./view/accueil.html');
include('./modele/tab.php');
echo"  <div class='row'>
				
					<div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading' align='center'>
                                <h3 class='panel-title'><i class='fa fa-fw fa-table' ></i> Statistiques</h3>
                            </div>
                            <div class='panel-body'>
                                <div class='table-responsive'>
                                    <table class='table table-bordered table-hover table-striped'>
                              
					<thead align='center'>
                                            <tr>
                                                <th>Utilisateurs inscrits</th>
                                                <th>Projets existants</th>
                                                <th>Sites Déployés</th>
                                            </tr>
                                        </thead>
                                        <tbody align='center'>
                                            <tr>
                                                <td>".$c[C]."</td>
                                                <td>".$c2[C2]."</td>
                                                <td>".$c3[C3]."</td>
                                            </tr>
                                     
                                        </tbody>
                                    </table>            
                                </div>
                            </div>
                        </div>
                    </div>
					
                </div>
                <!-- /.row -->

            </div>

   </div>
   
    </div>";
?>

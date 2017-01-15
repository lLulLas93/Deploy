<?php
      if(isset($_GET['page'])){    
 echo '<h3>Erreur : Pseudo et/ou Mot de passe invalide(s)</h3>
     <META http-equiv="refresh" content="1;URL=index.php?page=">
	';
}

include('./view/index.html');

?>
#!/bin/sh

#$1 = Chef-de-projet 
#$2 = Invité au projet
#$3 = Projet
#$4 = MDP

telnet deploy.itinet.fr smtp << FIN
ehlo deploy.itinet.fr
mail from:$1@deploy.itinet.fr
rcpt to:$2@deploy.itinet.fr
data
Subjet:-type subject Participation à $3-
Maintenant tu participe à notre projet  $3 

Identifiant SFTP est : $3
Mot de passe SFTP est : $4 

Votre identifiant à la base de donnée est : $3 
Votre mot de passe à la base de donnée est : $4 
http://deploy.itinet.fr/phpmyadmin

Votre identifiant à owncloud est : $3
Votre mot de passe à owncloud est : $4
http://owncloud.deploy.itinet.fr

Votre nom d'alias pour ce projet est $3@deploy.itinet.fr 
.
quit
FIN
echo 'Mail envoyer';

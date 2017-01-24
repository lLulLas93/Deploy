#!/bin/sh

#$1 nom du projet
#$2 nom de l'uitilisateur 
#$3 = Chef de projet

add_alias_mail(){
sudo sed -i -e "s/$1@deploy.itinet.fr/$1@deploy.itinet.fr $2@deploy.itinet.fr/" /etc/postfix/alias
sudo postmap /etc/postfix/alias


sudo telnet deploy.itinet.fr smtp << FIN
ehlo deploy.itinet.fr

mail from:$3@deploy.itinet.fr
rcpt to:$2@deploy.itinet.fr

data
Subject: Participation à $1
Maintenant tu participe à notre projet : "$1" 
Tu peut te connecter en SFTP, à la base de données et owncloud

Identifiant : $1
Mot de passe : *******
Pour le mot de passe renvoie-moi un mail de confirmation

Base de données : http://deploy.itinet.fr/phpmyadmin
OwnCloud : http://owncloud.deploy.itinet.fr
Site-Projet : http://$1.deploy.itinet.fr
Notre d'alias mail pour ce projet est $1@deploy.itinet.fr 
.
quit
FIN
echo 'Mail envoyer';


}
add_alias_mail $1 $2 $3

add_user_group()
{
sudo    usermod $2 -aG $1
sudo sh -c "echo '#$2@deploy.itinet.fr' >> /home/$1/.ssh/authorized_keys"
sudo sh -c	"cat /home/$2/.ssh/id_rsa.pub >> /home/$1/.ssh/authorized_keys"
}
add_user_group $1 $2

#!/bin/sh

#$1 = nom d'utilisateur

#Supprime l'utilisateur et son home
sudo deluser $1
sudo rm -dR /home/$1/

#Retire la clé SSH de l'utilisateur du groupe de projet pour git
sudo name=$(grep -n "$1@deploy.itinet.fr" /home/$2/.ssh/authorized_keys)
sudo nb=$(echo $name | cut -d : -f1)

sudo	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys
sudo	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys

#Retire l'adresse mail de la personne de postfixe
sudo sed -i -e "/$1/d" /etc/postfix/vmailbox
sudo postmap /etc/postfix/vmailbox

#Retire l'utilisateur de la database
mysql -h "localhost" -u "root" "-pdeployitdbinside" -D "owncloud" -e "DELETE FROM owncloud.oc_users WHERE uid='$1' ;"

#Supprime l'adresse mail de la personne de la database courier
sudo sed -i -e "/$1/d" /etc/courier/userdb
sudo	/etc/init.d/courier-authdaemon force-reload
sudo	/etc/init.d/courier-imap force-reload

#Retire l'utilisateur de l'alias de projet
sudo sed -i -e "s/$1@deploy.itinet.fr//" /etc/postfix/alias
sudo postmap /etc/postfix/alias

#Supprime le dossier contenant les mails de l'utilisateur
sudo rm -dR /var/mail/$1	

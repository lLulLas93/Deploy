#!/bin/sh

#$1 = nom d'utilisateur

#Supprime l'utilisateur et son home
deluser $1
rm -d -R /home/$1/

#Retire la clé SSH de l'utilisateur du groupe de projet pour git
name=$(grep -n "$1@deploy.itinet.fr" /home/$2/.ssh/authorized_keys)
nb=$(echo $name | cut -d : -f1)

	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys
	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys

#Retire l'adresse mail de la personne de postfixe
sed -i -e "/$1/d" /etc/postfix/vmailbox
postmap /etc/postfix/vmailbox

#Retire l'utilisateur de la database
echo "DELETE FROM owncloud.oc_users WHERE uid='$1' ;" | mysql -u root

#Supprime l'adresse mail de la personne de la database courier
sed -i -e "/$1/d" /etc/courier/userdb
	/etc/init.d/courier-authdaemon force-reload
	/etc/init.d/courier-imap force-reload

#Retire l'utilisateur de l'alias de projet
sed -i -e "s/$1@deploy.itinet.fr//" /etc/postfix/alias
postmap /etc/postfix/alias

#Supprime le dossier contenant les mails de l'utilisateur
rm -d -R /var/mail/$1	

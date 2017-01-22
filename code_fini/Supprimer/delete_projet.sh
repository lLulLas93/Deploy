#!/bin/sh

#$1 = nom de projet

#Supprime l'utilisateur unix du projet
userdel $1
#Supprime le groupe unix du projet
groupdel $1

#Supprime le site sur le server apache, et le dossier du site
rm /etc/apache2/sites-available/$1.conf
rm /etc/apache2/sites-enabled/$1.conf
rm -rf /var/deploy/sites/$1

#Mets à jour le DNS
cd /etc/tinydns/root/
sed -i "/^C$1.deploy.itinet.fr:www.deploy.itinet.fr:86400/d" data
cd /etc/tinydns/root
rm -d -R /var/cloud/$1
rm data.cdb
make
/etc/init.d/apache2 reload
ssh -i /home/maxime/.ssh/id_rsa root@dedibox.itinet.fr

#Supprime le home et le git du projet
rm -d -R /home/$1
rm -d -R /var/deploy/gits/$1

#Supprime l'alias du projet dans le base de donnée postfix
sed -i -e "/$1@deploy.itinet.fr/d" /etc/postfix/alias
postmap /etc/postfix/alias
echo "drop user '$1'@'localhost';" | mysql -u root

#Supprime l'utilisateur de la base de données
echo "DELETE FROM owncloud.oc_users WHERE uid='$1' ;" | mysql -u root

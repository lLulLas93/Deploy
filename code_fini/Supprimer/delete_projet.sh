#!/bin/sh

#$1 = nom de projet

#Supprime l'utilisateur unix du projet
sudo userdel $1
#Supprime le groupe unix du projet
sudo groupdel $1

#Supprime le site sur le server apache, et le dossier du site
sudo rm /etc/apache2/sites-available/$1.conf
sudo rm /etc/apache2/sites-enabled/$1.conf
sudo rm -rf /var/deploy/sites/$1

#Mets à jour le DNS
sudo sed -i "/^C$1.deploy.itinet.fr:www.deploy.itinet.fr:86400/d" /etc/tinydns/root/data
sudo rm -d -R /var/cloud/$1
sudo rm /etc/tinydns/root/data.cdb
sudo make 
sudo /etc/init.d/apache2 reload
sudo ssh -i /home/maxime/.ssh/id_rsa root@dedibox.itinet.fr

#Supprime le home et le git du projet
sudo rm -d -R /home/$1
sudo rm -d -R /var/deploy/gits/$1

#Supprime l'alias du projet dans le base de donnée postfix
sudo sed -i -e "/$1@deploy.itinet.fr/d" /etc/postfix/alias
sudo postmap /etc/postfix/alias
mysql -h "localhost" -u "root" "-pdeployitdbinside" -D "mysql" -e "DROP USER '$1'@'localhost'"
#Supprime l'utilisateur de la base de données
mysql -h "localhost" -u "root" "-pdeployitdbinside" -D "owncloud" -e "DELETE FROM owncloud.oc_users WHERE uid='$1'" 

#!/bin/sh

# $1=nom 
#$2=projet

#Supprime l'utilisateur du groupe de projet unix
sudo deluser $1 $2

#Supprime la clé SSH de l'utilisateur permettant d'accéder au git
sudo name=$(grep -n "$1@deploy.itinet.fr" /home/$2/.ssh/authorized_keys)
sudo nb=$(echo $name | cut -d : -f1)

sudo	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys
sudo	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys

#Supprime l'alias mail de l'utilisateur
sudo sed -i -e "s/$1@deploy.itinet.fr//" /etc/postfix/alias
sudo postmap /etc/postfix/alias

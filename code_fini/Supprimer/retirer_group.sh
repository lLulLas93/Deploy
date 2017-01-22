#!/bin/sh

# $1=nom 
#$2=projet

#Supprime l'utilisateur du groupe de projet unix
deluser $1 $2

#Supprime la clé SSH de l'utilisateur permettant d'accéder au git
name=$(grep -n "$1@deploy.itinet.fr" /home/$2/.ssh/authorized_keys)
nb=$(echo $name | cut -d : -f1)

	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys
	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys

#Supprime l'alias mail de l'utilisateur
sed -i -e "s/$1@deploy.itinet.fr//" /etc/postfix/alias
postmap /etc/postfix/alias

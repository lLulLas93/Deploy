#!/bin/sh

# $1=nom $2=projet
deluser $1 $2

name=$(grep -n "$1@deploy.itinet.fr" /home/$2/.ssh/authorized_keys)
nb=$(echo $name | cut -d : -f1)

	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys
	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys

sed -i -e "/$1/d" /etc/postfix/alias
postmap /etc/postfix/alias

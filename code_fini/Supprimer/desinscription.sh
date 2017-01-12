#!/bin/sh

deluser $1
rm -d -R /home/$1/

name=$(grep -n "$1@deploy.itinet.fr" /home/lael/scripts/ok)
nb=$(echo $name | cut -d : -f1)

	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys
	sed -i -e "$nb d" /home/$2/.ssh/authorized_keys

sed -i -e "/$1/d" /etc/postfix/vmailbox
postmap /etc/postfix/vmailbox

echo "DELETE FROM owncloud.oc_users WHERE uid='$1' ;" | mysql -u root

sed -i -e "/$1/d" /etc/courier/userdb
	/etc/init.d/courier-authdaemon force-reload
	/etc/init.d/courier-imap force-reload

sed -i -e "s/$1@deploy.itinet.fr//" /etc/postfix/alias
postmap /etc/postfix/alias

rm -d -R /var/mail/$1	

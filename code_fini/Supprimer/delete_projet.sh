#!/bin/sh

deluser $1
rm -d -R /home/$1/

echo "DELETE FROM owncloud.oc_users WHERE uid='$1' ;" | mysql -u root
echo "DROP USER '$1'@'localhost';" f| mysql -u root

sed -i -e "/$1@deploy.itinet.fr/d" /etc/postfix/alias
postmap /etc/postfix/alias


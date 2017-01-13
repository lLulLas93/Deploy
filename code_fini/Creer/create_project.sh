#! /bin/sh

create_project()
{

	#Création utilisateur unix projet
	useradd $1 -m
	passwd $1 << FIN
	$2
	$2
FIN

	
	#Création et initialisation dépôt git, changement d'owner, attribution de droits
	cd /var/deploy/gits
	if (test -e $1)
	then
		echo "Le projet existe déjà"
	else 
		mkdir $1
		cd $1
		mkdir .git
		cd /var/deploy/gits/$1
		git --bare init
		echo "c'est bon"
		mkdir /home/$1/.ssh
		touch /home/$1/.ssh/authorized_keys
		echo "#$3@deploy.itinet.fr" > /home/$1/.ssh/authorized_keys
		cat /home/$3/.ssh/id_rsa.pub >> /home/$1/.ssh/authorized_keys
		chown $1:$1 -R /var/deploy/gits/$1
		chmod -R 760 /var/deploy/gits/$1
	fi

	#Création utilisateur owncloud projet
	echo "INSERT INTO owncloud.oc_users (uid,password) values ('$1','$2');" | mysql -u root
	
	#Création group owncloud projet
	echo "INSERT INTO owncloud.oc_groups (gid) values ('$1');" | mysql -u root
	mkdir /var/cloud/$1

	#Ajout du chef de projet
}
#creation de l'alias
create_alias(){

echo "$1">>/etc/postfix/alias
sed -i -e "s/^$1/$1@deploy.itinet.fr $3@deploy.itinet.fr /" /etc/postfix/alias
postmap /etc/postfix/alias

}
create_alias $1 $2 $3
create_project $1 $2 $3
usermod $3 -aG $1

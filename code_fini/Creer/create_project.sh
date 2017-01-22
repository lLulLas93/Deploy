#! /bin/sh

create_project()
{
#$1 = nom du projet
#$2 = mot de passe
#$3 = nom de l'utilisateur

	#Création utilisateur unix projet
	useradd -m -s /usr/bin/mysecureshell $1
	passwd $1 << FIN
	$2
	$2
FIN

	echo -e "
	<Group $1>
	Home /home/$1
	StayAtHome true
	VirtualChroot    true
	LimitConnectionByUser 4
	LimitConnectionByIP 4
	HideNoAccess     true
	DefaultRights 0604 0705
	IgnoreHidden     true
	</User>
	
	" >> /etc/ssh/sftp_config 
	
	
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
		chown $1:$1 -R /home/$1/
		edquota -p $1 quota
	fi

	#Création utilisateur owncloud projet	
	curl -d userid=manga -d password=tutu http://deploy:deployit@owncloud.deploy.itinet.fr/ocs/v1.php/cloud/users

	#Création group owncloud projet
	echo "INSERT INTO owncloud.oc_groups (gid) values ('$1');" | mysql -u root
	mkdir /var/cloud/$1

	#Ajout du chef de projet

	#Ajout du fichier évitant la connexion par mot de passe
	touch /home/$1
	echo -e "
	#Fichier évitant la connexion par mot de passe
	Host labo.itinet.fr
	User $1
	Compression yes
	Protocol 2
	RSAAuthentication yes
	IdentityFile [INSERER ICI LE CHEMIN VERS VOTRE CLE PRIVEE]
	"

	#Ajout au projet sa base de donnée
	echo "CREATE USER '$1'@'localhost' IDENTIFIED BY '$2'" | mysql -u root

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

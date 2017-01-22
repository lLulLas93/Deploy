#! /bin/sh

create_project()
{
#$1 = nom du projet
#$2 = mot de passe
#$3 = nom de l'utilisateur

	#Création utilisateur unix projet
sudo	useradd -m -s /usr/bin/mysecureshell $1
sudo	passwd $1 << FIN
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
	
	" | sudo tee -a /etc/ssh/sftp_config 
	
	
	#Création et initialisation dépôt git, changement d'owner, attribution de droits
	
	if (test -e $1)
	then
sudo sh -c'	echo "Le projet existe déjà"'
	else 
sudo		mkdir /var/deploy/gits/$1
sudo		git --bare init /var/deploy/gits/$1
sudo sh -c'	echo " bon"'
sudo		mkdir /home/$1/.ssh
sudo		touch /home/$1/.ssh/authorized_keys
		echo "#$3@deploy.itinet.fr" | sudo tee /home/$1/.ssh/authorized_keys
		echo /home/$3/.ssh/id_rsa.pub | sudo tee -a  /home/$1/.ssh/authorized_keys
sudo		chown $1:$1 -R /var/deploy/gits/$1
sudo		chmod -R 760 /var/deploy/gits/$1
sudo		chown $1:$1 -R /home/$1/
sudo		edquota -p $1 quota
	fi

	#Création utilisateur owncloud projet	
sudo	curl -d userid=manga -d password=tutu http://deploy:deployit@owncloud.deploy.itinet.fr/ocs/v1.php/cloud/users

	#Création group owncloud projet
	echo "INSERT INTO owncloud.oc_groups (gid) values ('$1');" | mysql -u root -p<<t
	deployitdbinside
t
sudo	mkdir /var/cloud/$1

	#Ajout du chef de projet

	#Ajout du fichier évitant la connexion par mot de passe
sudo	touch /home/$1
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
	echo "CREATE USER '$1'@'localhost' IDENTIFIED BY '$2'" | mysql -u root -p<<t
	deployitdbinside
t

}
#creation de l'alias
create_alias(){

echo "$1" | sudo tee /etc/postfix/alias
sudo sed -i -e "s/^$1/$1@deploy.itinet.fr $3@deploy.itinet.fr /" /etc/postfix/alias
sudo postmap /etc/postfix/alias

}
create_alias $1 $2 $3
create_project $1 $2 $3
usermod $3 -aG $1

#!/bin/sh

create_user()
{
#$1 = nom d'utilisateur
#$2 = mot de passe

	#Création compte unix utilisateur
sudo	useradd -m -s /usr/bin/mysecureshell $1
sudo	passwd $1 << FIN
	$2
	$2
FIN

	#definition de regle sftp mysecushell
		
	echo " 
	<User $1>
	Home /home/$1
	StayAtHome true
	VirtualChroot    true
	LimitConnectionByUser 3
	LimitConnectionByIP 3
	HideNoAccess     true
	DefaultRights 0604 0705
	IgnoreHidden     true
	</User>" | sudo tee -a /etc/ssh/sftp_config 
		
	#Génération, sauvegarde clé SSH
sudo	mkdir /home/$1/.ssh
sudo	ssh-keygen -q -t rsa -f /home/$1/.ssh/id_rsa -C '' -N ''
	
	#Génération cloud
sudo	curl -d userid=$1 -d password=$2 http://deploy:deployit@owncloud.deploy.itinet.fr/ocs/v1.php/cloud/users
}

mail_create() 
{


	#Vérification du mail
sudo bash -c	'echo Vérification de $1@deploy.itinet.fr;'

	#Si le mail existe on affiche compte existant
	if (grep $1 /etc/postfix/vmailbox || grep $1 /etc/postfix/alias)
	then
		sudo echo 'compte existant';
	#Sinon on créer le mail et l'insère dans la database postfixe
	else
		sudo sh -c "echo $1'@deploy.itinet.fr' /$1/ >> /etc/postfix/vmailbox"
		sudo postmap /etc/postfix/vmailbox
		sudo userdb $1 set uid=1008 gid=1008 home=/var/mail/$1 mail=/var/mail/$1
		sudo userdb $1 set systempw=$(openssl passwd -1 $2)<<NO_INTERACTION


NO_INTERACTION
		sudo makeuserdb
		sudo maildirmake /var/mail/$1
		sudo postmap /etc/postfix/vmailbox
		sudo chown -R deploymail:deploymail /var/mail/$1
		sudo /etc/init.d/courier-authdaemon force-reload
		sudo /etc/init.d/courier-imap force-reload


	        sudo sh -c "echo 'Compte Disponible'"
fi

}
create_user $1 $2
mail_create $1 $2

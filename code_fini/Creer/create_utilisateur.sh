#! /bin/sh
create_user()
{
	#Création compte unix utilisateur
	useradd $1 -m
	passwd $1 << FIN
	$2
	$2
FIN
	
	#Génération, sauvegarde clé SSH
	cd /home/$1
	mkdir .ssh
	ssh-keygen -q -t rsa -f /home/$1/.ssh/id_rsa -C '' -N ''
	
	#Génération cloud
	echo "INSERT INTO owncloud.oc_users (uid,password) VALUES ('$1','$2');" | mysql -u root
}

mail_create() {

echo Vérification de $1@deploy.itinet.fr

if grep $1 /etc/postfix/vmailbox || grep $1 /etc/postfix/alias;
then
        echo 'compte existant'
        return 0;
else
        echo $1"@deploy.itinet.fr" /$1/ >> /etc/postfix/vmailbox
        postmap /etc/postfix/vmailbox
        userdb $1 set uid=1008 gid=1008 home=/var/mail/$1 mail=/var/mail/$1
        userdb $1 set systempw=$(openssl passwd -1 $2)<<NO_INTERACTION


NO_INTERACTION
        makeuserdb
        maildirmake /var/mail/$1
        postmap /etc/postfix/vmailbox
        chown -R deploymail:deploymail /var/mail/$1
        /etc/init.d/courier-authdaemon force-reload
        /etc/init.d/courier-imap force-reload


        echo 'Compte Disponible'
        return 1;
fi

}

create_user $1 $2
mail_create $1 $2

#!/bin/bash

	#la variable "param" est initialisé a 0 
	#ensuite elle contient le parametre passer part l'utilisateur 
#$1 nom du pojet
cree_fqdn_vhost()
{
		mdp="maxime"
		mkdir /var/deploy/sites/$1
		touch /var/deploy/sites/$1/index.html
		echo -e "
		<VirtualHost *:80>\n
		ServerName $1.deploy.itinet.fr
		DocumentRoot /var/deploy/sites/$1
		ErrorLog /error.log
		CustomLog /access.log combined \n
		</VirtualHost>" > /etc/apache2/sites-available/$1.conf
	
		
		echo "<!DOCTYPE html>
			<html>
			    <head>
			        <meta charset="utf-8" />
			        <title>Titre</title>
			    </head>
			
			    <body>
			    <h1>$1</h1>
			    </body>
			</html>" > /var/deploy/sites/$1/index.html

		cd /etc/apache2/sites-available/
		a2ensite $1.conf
		#ln -s ../sites-available/$1.conf
		
		echo "C$1.deploy.itinet.fr:www.deploy.itinet.fr:86400" >> /etc/tinydns/root/data		
		cd /etc/tinydns/root/
		rm data.cdb
		make

		/etc/init.d/apache2 reload
ssh -i /home/maxime/.ssh/id_rsa root@dedibox.itinet.fr << FIN
$mdp
FIN
		cd /var/deploy/sites
		git clone /var/deploy/gits/$1 /var/deploy/sites/$1
}			


sup_projet()
{
	userdel $1
	groupdel $1
	rm /etc/apache2/sites-available/$1.conf
	rm /etc/apache2/sites-enabled/$1.conf
	rm -rf /var/deploy/sites/$1
	cd /etc/tinydns/root/    
	sed -i "/^C$1.deploy.itinet.fr:www.deploy.itinet.fr:86400/d" data
	cd /etc/tinydns/root
	rm data.cdb
	make
	/etc/init.d/apache2 reload
	ssh -i /home/maxime/.ssh/id_rsa root@dedibox.itinet.fr
 	rm -d -R /home/$1
	rm -d -R /var/deploy/gits/$1
	sed -i -e "/$1@deploy.itinet.fr/d" /etc/postfix/alias
	postmap /etc/postfix/alias
}
#cree_fqdn_vhost $1
sup_projet $1

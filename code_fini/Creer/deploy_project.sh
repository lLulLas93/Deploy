#!/bin/bash

	#la variable "param" est initialisé a 0 
	#ensuite elle contient le parametre passer part l'utilisateur 
#$1 nom du pojet

#Création de 
existe=`grep -E ^C$1.deploy.itinet.fr:www.deploy.itinet.fr:86400$ /etc/tinydns/root/data`

if [ -z $existe ]
then

    echo -e "jamais declare "
    echo -e "\n $existe \n"

		#Création du dossier du site et création du virtual host du site de projet
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
	

		#Création d'une page html portant le nom du projet		
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

		#Activation du site (mise en ligne)
		cd /etc/apache2/sites-available/
		a2ensite $1.conf
		#ln -s ../sites-available/$1.conf
		
		#Mise à jour du DNS
		echo "C$1.deploy.itinet.fr:www.deploy.itinet.fr:86400" >> /etc/tinydns/root/data		
		cd /etc/tinydns/root/
		rm data.cdb
		make

		/etc/init.d/apache2 reload
ssh -i /home/maxime/.ssh/id_rsa root@dedibox.itinet.fr << FIN
$mdp
FIN

#Clone du dépôt git dans la partie site
else
    echo -e "\n deja declarer  \n"
    echo -e "\n $existe \n"
	git clone /var/deploy/gits/$1 /var/deploy/sites/$1	
fi

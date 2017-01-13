#!/bin/sh

#suppression all mail 

#	sed -i -e "/^.$/d" /etc/postfix/vmailbox
	#sed -i -e "/^.$/d" /etc/postfix/alias
	
	echo > /etc/postfix/alias
	sed -i -e "/^$/d" /etc/postfix/alias
	
	echo > /etc/postfix/vmailbox
	sed -i -e "/^$/d" /etc/postfix/vmailbox
	
	echo > /etc/postfix/userdb
	sed -i -e "/^$/d" /etc/postfix/userdb

	rm -d -R /var/mail/*
	postmap /etc/postfix/vmailbox
	postmap /etc/courier/userdb

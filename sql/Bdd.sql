DROP DATABASE DeployDev;
Create DATABASE DeployDev;
use DeployDev;

CREATE TABLE UTILISATEURS
(ID_ut SMALLINT AUTO_INCREMENT PRIMARY KEY,
Prenom VARCHAR(30),
Nom_ut VARCHAR(30),
Mail VARCHAR(30),
Mdp VARCHAR(100),
Statut VARCHAR(15));

CREATE TABLE PROJETS
(ID_projet SMALLINT AUTO_INCREMENT PRIMARY KEY,
Date_de_creation DATE,
Nom_p VARCHAR(30),
Mdp VARCHAR(100),
Instigateur SMALLINT,
FOREIGN KEY (Instigateur) REFERENCES UTILISATEURS (ID_ut),
Langage VARCHAR(45),
Description TEXT,
Logo TEXT,
Statut VARCHAR(15),
difficultes VARCHAR(3),
Participant SMALLINT,
FOREIGN KEY (Participant) REFERENCES UTILISATEURS (ID_ut));

CREATE TABLE PARTICIPANTS_PR
(ID_participant_pr SMALLINT AUTO_INCREMENT PRIMARY KEY,
ID_ut SMALLINT,
FOREIGN KEY (ID_ut) REFERENCES UTILISATEURS (ID_ut),
ID_projet SMALLINT,
FOREIGN KEY (ID_projet) REFERENCES PROJETS (ID_projet));


CREATE TABLE MESSAGE 
(ID_messages SMALLINT auto_increment PRIMARY KEY,
Heure DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
id_destinataire SMALLINT,
id_projet SMALLINT,
FOREIGN KEY (ID_destinataire) REFERENCES UTILISATEURS (ID_ut),
FOREIGN KEY (id_projet) REFERENCES PROJETS (ID_projet),
ID_ut int,
FOREIGN KEY (ID_ut) REFERENCES UTILISATEURS (ID_ut),
statut SMALLINT,
titre text NOT NULL,
message text NOT NULL)); 

INSERT INTO `UTILISATEURS` (`ID_ut`, `Prenom`, `Nom_ut`, `Mail`, `Mdp`, `Statut`) VALUES
(1, 'bot', 'bot', 'bot@bot', 'aqw', 'bot'),
(2, 'azertyuiop', 'azertyuiop', 'aze@poiu', 'azertyuiop', 'etudiant'),
(3, 'qsdfghjklvbn', 'wxcvbn', 'aze@poiu', 'wxcvbn', 'etudiant'),
(5, 'aqw', 'aqw', 'aqw@wqa', 'aqw', 'etudiant'),
(6, 'efcxse', 'Admin', 'vprigaud@laposte.net', 'aze', 'administrateur'),
(7, 'pmlo', 'AdminAdmin', 'vprigaud@laposte.net', 'aze', 'etudiant'),
(8, 'fevz', 'Adam', 'vprigaud@laposte.net', 'aze', 'etudiant'),
(9, 'zze', 'dmominique', 'vprigaud@laposte.net', 'aze', 'etudiant'),
(10, 'plpzcd', 'Alice', 'vprigaud@laposte.net', 'aze', 'etudiant'),
(11, 'zdc', 'noémi', 'vprigaud@laposte.net', 'aze', 'professionnel'),
(12, 'dcz', 'iris', 'vprigaud@laposte.net', 'aze', 'professionnel'),
(13, 'aezr', 'dimitri', 'vprigaud@laposte.net', 'aze', 'professionnel'),
(14, 'ezqcd', 'nimad', 'vprigaud@laposte.net', 'aze', 'O');


INSERT INTO PROJETS(Date_de_creation,Nom_p,Instigateur,Langage,Description,Logo,statut,difficultes,Participant)
VALUES ('2016-12-12','deploy',1,'PHP&MYSQL','Cest nous','test.jpg','etudiant','100','4');
INSERT INTO PROJETS(Date_de_creation,Nom_p,Instigateur,Langage,Description,Logo,statut,difficultes,Participant)
VALUES ('2016-12-12','nom_p2',2,'langage','description','F-D.jpg','statut','100','8');
INSERT INTO PROJETS(Date_de_creation,Nom_p,Instigateur,Langage,Description,Logo,statut,difficultes,Participant)
VALUES ('2016-12-12','nom_p3',3,'langage','description','F-D.jpg','statut','100','9');
INSERT INTO PROJETS(Date_de_creation,Nom_p,Instigateur,Langage,Description,Logo,statut,difficultes,Participant)
VALUES ('2016-12-12','nom_p4',4,'langage','description','F-D.jpg','statut','100','12');


INSERT INTO MESSAGES(id_destinataire, ID_ut, titre, message) VALUES( 0, '1', '', 'Bienvenue');


INSERT INTO `PARTICIPANTS_PR` (`ID_participant_pr`, `ID_ut`, `ID_projet`) VALUES
(1, 14, 3),
(2, 11, 3),
(3, 3, 1),
(4, 6, 1),
(5, 5, 4),
(6, 11, 1),
(7, 14, 4),
(8, 2, 3),
(9, 6, 2),
(10, 4, 2),
(11, 1, 2),
(12, 3, 2),
(13, 5, 2),
(14, 7, 2),
(15, 8, 2),
(16, 9, 2),
(17, 10, 1),
(18, 12, 1),
(19, 4, 4),
(20, 9, 4),
(21, 13, 3),
(22, 1, 3),
(23, 4, 1);


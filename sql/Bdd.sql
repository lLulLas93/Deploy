DROP DATABASE DeployDev;
Create DATABASE DeployDev;
use DeployDev;

CREATE TABLE UTILISATEURS
(ID_ut SMALLINT AUTO_INCREMENT PRIMARY KEY,
Prenom VARCHAR(30),
Login VARCHAR(30),
Mail VARCHAR(30),
Mdp VARCHAR(100));

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
Participant SMALLINT,
FOREIGN KEY (Participant) REFERENCES UTILISATEURS (ID_ut));

CREATE TABLE STATUT
(ID_participant_pr SMALLINT AUTO_INCREMENT PRIMARY KEY,
ID_ut SMALLINT,
FOREIGN KEY (ID_ut) REFERENCES UTILISATEURS (ID_ut),
ID_projet SMALLINT,
FOREIGN KEY (ID_projet) REFERENCES PROJETS (ID_projet)
Statut VARCHAR(15));


-- CREATE TABLE MESSAGE 
-- (ID_messages SMALLINT auto_increment PRIMARY KEY,
-- Heure DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
-- id_destinataire SMALLINT,
-- id_projet SMALLINT,
-- FOREIGN KEY (ID_destinataire) REFERENCES UTILISATEURS (ID_ut),
-- FOREIGN KEY (id_projet) REFERENCES PROJETS (ID_projet),
-- ID_ut int,
-- FOREIGN KEY (ID_ut) REFERENCES UTILISATEURS (ID_ut),
-- statut SMALLINT,
-- titre text NOT NULL,
-- message text NOT NULL)); 

INSERT INTO `UTILISATEURS` (`ID_ut`, `Prenom`, `Login`, `Mail`, `Mdp`) VALUES
(1, 'bot', 'bot', 'bot@bot', 'aqw'),
(2, 'azertyuiop', 'azertyuiop', 'aze@poiu', 'azertyuiop'),
(3, 'qsdfghjklvbn', 'wxcvbn', 'aze@poiu', 'wxcvbn'),
(5, 'aqw', 'aqw', 'aqw@wqa', 'aqw'),
(6, 'efcxse', 'Admin', 'vprigaud@laposte.net', 'aze'),
(7, 'pmlo', 'AdminAdmin', 'vprigaud@laposte.net', 'aze'),
(8, 'fevz', 'Adam', 'vprigaud@laposte.net', 'aze'),
(9, 'zze', 'dmominique', 'vprigaud@laposte.net', 'aze'),
(10, 'plpzcd', 'Alice', 'vprigaud@laposte.net', 'aze'),
(11, 'zdc', 'noémi', 'vprigaud@laposte.net', 'aze'),
(12, 'dcz', 'iris', 'vprigaud@laposte.net', 'aze'),
(13, 'aezr', 'dimitri', 'vprigaud@laposte.net', 'aze'),
(14, 'ezqcd', 'nimad', 'vprigaud@laposte.net', 'aze');


INSERT INTO PROJETS(Date_de_creation,Nom_p,Mdp,Instigateur,Langage,Description,Logo,statut,difficultes,Participant)
VALUES ('2016-12-12','deploy',1,'PHP&MYSQL','aze','Cest nous','test.jpg','etudiant','100','4');
INSERT INTO PROJETS(Date_de_creation,Nom_p,Instigateur,Langage,Description,Logo,statut,difficultes,Participant)
VALUES ('2016-12-12','nom_p2',2,'langage','aze','description','F-D.jpg','statut','100','8');
INSERT INTO PROJETS(Date_de_creation,Nom_p,Instigateur,Langage,Description,Logo,statut,difficultes,Participant)
VALUES ('2016-12-12','nom_p3',3,'langage','aze','description','F-D.jpg','statut','100','9');
INSERT INTO PROJETS(Date_de_creation,Nom_p,Instigateur,Langage,Description,Logo,statut,difficultes,Participant)
VALUES ('2016-12-12','nom_p4',4,'langage','aze','description','F-D.jpg','statut','100','12');


-- INSERT INTO MESSAGES(id_destinataire, ID_ut, titre, message) VALUES( 0, '1', '', 'Bienvenue');


INSERT INTO `STATUT` (`ID_participant_pr`, `ID_ut`, `ID_projet`,`Statut`) VALUES
(1, 14, 3, 1),
(2, 11, 3, 0),
(3, 3, 1, 1),
(4, 6, 1, 0);


DROP DATABASE DeployDev;
Create DATABASE DeployDev;
use DeployDev;

CREATE TABLE UTILISATEURS
(user_id SMALLINT AUTO_INCREMENT PRIMARY KEY,
prenom VARCHAR(30),
login VARCHAR(30),
mail VARCHAR(30),
mdp VARCHAR(100));

CREATE TABLE PROJETS
(projet_id SMALLINT AUTO_INCREMENT PRIMARY KEY,
nom_projet VARCHAR(30),
date_de_creation DATE,
mdp VARCHAR(100),
langage VARCHAR(45),
description TEXT,
logo VARCHAR(100),
deploy BOOLEAN,
git_sftp BOOLEAN,
db_active BOOLEAN
);

CREATE TABLE STATUT
(
user_id SMALLINT,
FOREIGN KEY (user_id) REFERENCES UTILISATEURS (user_id),
projet_id SMALLINT,
FOREIGN KEY (projet_id) REFERENCES PROJETS (projet_id),
statut BOOLEAN,
deploy BOOLEAN
);

INSERT INTO `UTILISATEURS` (`user_id`, `Prenom`, `Login`, `Mail`, `Mdp`) VALUES
(1, 'bot', 'bot', 'bot@deploy.itinet.fr', 'aqw'),
(2, 'azertyuiop', 'azertyuiop', 'aze@deploy.itinet.fr', 'azertyuiop'),
(3, 'qsdfghjklvbn', 'wxcvbn', 'aze@deploy.itinet.fr', 'wxcvbn'),
(4, 'aqw', 'aqw', 'aqw@deploy.itinet.fr', 'aqw');

INSERT INTO PROJETS(projet_id,date_de_creation,nom_projet,mdp,langage,description,logo,git_sftp,db_active)
VALUES ('1','2016-12-12','deploy',1,'PHP&MYSQL','Cest nous','test.jpg',1,0);
INSERT INTO PROJETS(projet_id,date_de_creation,nom_projet,mdp,langage,description,logo,git_sftp,db_active)
VALUES ('2','2016-12-12','nike',2,'langage','description','F-D.jpg',0,1);
INSERT INTO PROJETS(projet_id,date_de_creation,nom_projet,mdp,langage,description,logo,git_sftp,db_active)
VALUES ('3','2016-12-12','robot',3,'langage','description','F-D.jpg',1,1);
INSERT INTO PROJETS(projet_id,date_de_creation,nom_projet,mdp,langage,description,logo,git_sftp,db_active)
VALUES ('4','2016-12-12','chacha',4,'langage','description','F-D.jpg',0,0);

INSERT INTO `STATUT` (`user_id`, `projet_id`, `statut`, `deploy`) VALUES
(1, 1, 1, 0),
(3, 3, 1, 0),
(2, 2, 1, 0),
(4, 4, 1, 0);


-- INSERT INTO MESSAGES(id_destinataire, user_id, titre, message) VALUES( 0, '1', '', 'Bienvenue');

-- CREATE TABLE MESSAGE 
-- (ID_messages SMALLINT auto_increment PRIMARY KEY,
-- Heure DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
-- id_destinataire SMALLINT,
-- id_projet SMALLINT,
-- FOREIGN KEY (ID_destinataire) REFERENCES UTILISATEURS (user_id),
-- FOREIGN KEY (id_projet) REFERENCES PROJETS (ID_projet),
-- user_id int,
-- FOREIGN KEY (user_id) REFERENCES UTILISATEURS (user_id),
-- statut SMALLINT,
-- titre text NOT NULL,
-- message text NOT NULL)); 


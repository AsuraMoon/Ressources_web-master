CREATE DATABASE users;
CREATE TABLE utilisateurs (
    id_utilisateur INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    pseudo VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL,
    mobile VARCHAR(20),
    mdp VARCHAR(50) NOT NULL,
    date_naissance DATE,
    date_inscript DATE NOT NULL,
    constraint PK_utilisateur primary key (id_utilisateur),
    CONSTRAINT UNIQUE(pseudo),
    CONSTRAINT UNIQUE(email),
    CONSTRAINT UNIQUE(mobile)
) 
ENGINE = INNODB CHARACTER SET utf8;
    

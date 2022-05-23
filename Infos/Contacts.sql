CREATE TABLE Contact (
	id INTEGER PRIMARY KEY AUTOINCREMENT, 
	surName VARCHAR(40) NOT NULL,
	name VARCHAR(40) , 
	firstName VARCHAR(40),
	groups VARCHAR(10) CHECK (Groupe in ('Famille','Amis','Travail','Autre')),
	profilPicture VARCHAR(40) DEFAULT '../Pictures/default_users');
	
CREATE TABLE Coordonnees (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	phoneNumber VARCHAR(10) NOT NULL,
	email VARCHAR(40) CHECK (email IS LIKE '%@%'),
	idContact INTEGER NOT NULL, 
	groups VARCHAR(10) CHECK (Emplacement in ('Principal','Travail','Domicile','Autre')),
	socialMedia VARCHAR(100) ,
	CONSTRAINT fk_idContact FOREIGN KEY (idContact) REFERENCES Contact (idContact) ON DELETE CASCADE ON UPDATE CASCADE);
	
CREATE TABLE Users (
	login PRIMARY KEY VARCHAR(20) NOT NULL,
	passwd VARCHAR(20) NOT NULL ,
	status VARCHAR(20) DEFAULT 'user' CHECK (status in ('user','admin')));

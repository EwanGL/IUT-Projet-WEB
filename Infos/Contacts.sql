CREATE TABLE Contact (
	NoContact INTEGER PRIMARY KEY AUTOINCREMENT, 
	Surnom VARCHAR(40) NOT NULL, Nom VARCHAR(40) , 
	Prenom VARCHAR(40),
	Groupe VARCHAR(10) CHECK (Groupe in ('Famille','Amis','Travail','Autre')),
	Photo_profil VARCHAR(40) DEFAULT 'pour l instant jsp';
	
CREATE TABLE Coordonnees (
	NoCoordonnees INTEGER PRIMARY KEY AUTOINCREMENT,
	NumTelephone VARCHAR(10) NOT NULL, 
	NoContact INTEGER NOT NULL, 
	Emplacement VARCHAR(10) CHECK (Emplacement in ('Principal','Travail','Domicile','Autre')), 
	CONSTRAINT fk_NoContact FOREIGN KEY (NoContact) REFERENCES Contact (NoContact) ON DELETE CASCADE ON UPDATE CASCADE);

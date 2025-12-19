CREATE DATABASE garden;
 USE garden;
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    dateInscription DATE NOT NULL
);
CREATE TABLE themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    nom VARCHAR(50) NOT NULL,
    couleur VARCHAR(12) NOT NULL,     
    tags VARCHAR(55) DEFAULT NULL,  
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id) 
);
CREATE TABLE notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme_id INT NOT NULL,
    titre VARCHAR(20) NOT NULL,
    importance VARCHAR(20)   NOT NULL ,
    contenu VARCHAR(20) NOT NULL,
    date_creation DATE NOT NULL,
    FOREIGN KEY (theme_id) REFERENCES themes(id) 
);
ALTER TABLE  notes 
MODIFY COLUMN contenu TEXT;
ALTER TABLE  utilisateurs 
add COLUMN email VARCHAR(30);
ALTER TABLE  utilisateurs ADD UNIQUE (email);
drop database if exists botiga;
create database botiga character set utf8 collate utf8_general_ci;
use botiga;

CREATE TABLE usuari (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom varchar(40) NOT NULL,
    cognoms varchar(40) NOT NULL,
    email varchar(80) NOT NULL,
    contrasenya varchar(20) NOT NULL,
    sex enum('H','D') NULL,
    data_nac date NOT NULL,
    telefon int(9) NOT NULL,
    pais varchar(20) NOT NULL,
    direccio varchar(120) NOT NULL,
    codi_postal int(5) DEFAULT NULL,
    poblacio varchar(80) NOT NULL,
    provincia varchar(50) NOT NULL
);

CREATE TABLE producte (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    gtin varchar(13) NOT NULL,
    nom varchar(40) NOT NULL,
    categoria varchar(40) DEFAULT NULL,
    descripcio varchar(340) DEFAULT NULL,
    imatge varchar(100) DEFAULT NULL,
    preu decimal(10,2) NOT NULL,
    pes decimal(10,2) NOT NULL
);

CREATE TABLE producte_categoria (
    id_producte int NOT NULL,
    id_categoria int NOT NULL,
    FOREIGN KEY(id_producte) REFERENCES producte(id)
    on delete restrict
    on update cascade,
    FOREIGN KEY(id_categoria) REFERENCES categoria(id)
    on delete restrict
    on update cascade
);

CREATE TABLE comanda (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id int NOT NULL,
    producte_id int NOT NULL,
    data timestamp NOT NULL,
    FOREIGN KEY(user_id) REFERENCES usuari(id)  
    on delete restrict
    on update cascade,
    FOREIGN KEY(producte_id) REFERENCES producte(id)  
    on delete restrict
    on update cascade

)

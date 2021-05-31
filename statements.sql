CREATE DATABASE toernooi;
USE toernooi;


CREATE TABLE toernooi(
    t_id INT NOT NULL AUTO_INCREMENT,
    t_omschrijving varchar(255) NOT NULL,
    t_datum DATE not NULL,
    PRIMARY KEY (t_id)
);

CREATE TABLE school(
    sch_id INT NOT NULL AUTO_INCREMENT,
    sch_naam varchar(40) NOT NULL,
    PRIMARY KEY (sch_id) 
);

CREATE TABLE speler (
    s_id INT NOT NULL AUTO_INCREMENT,
    sch_id INT NOT NULL,
    s_naam varchar(40) NOT NULL UNIQUE,
    s_tussenvoegsel varchar(40),
    s_achternaam varchar(40) NOT NULL,
    PRIMARY KEY (s_id),
    FOREIGN KEY (sch_id) REFERENCES school(sch_id)
);

CREATE TABLE wedstrijden(
    w_id INT NOT NULL AUTO_INCREMENT,
    t_id INT NOT NULL,
    s_speler1id INT NOT NULL,
    s_speler2id INT NOT NULL,
    s_winnaarid INT NOT NULL,
    w_ronde varchar(40) NOT NULL,
    w_score1 varchar(40) NOT NULL,
    w_score2 varchar(40) NOT NULL,
    PRIMARY KEY (w_id),
    FOREIGN KEY (t_id) REFERENCES toernooi(t_id),
    FOREIGN KEY (s_speler1id) REFERENCES speler(s_id),
    FOREIGN KEY (s_speler2id) REFERENCES speler(s_id),
    FOREIGN KEY (s_winnaarid) REFERENCES speler(s_id)
);

CREATE TABLE aanmelding(
    a_id INT NOT NULL AUTO_INCREMENT,
    t_id INT NOT NULL,
    s_id INT NOT NULL,
    PRIMARY KEY(a_id),
    FOREIGN KEY (t_id) REFERENCES toernooi(t_id),
    FOREIGN KEY (s_id) REFERENCES speler(s_id)
);
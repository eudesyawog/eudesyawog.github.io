# -----------------------------------------------------------------------------
#       TABLE : PARAGRAPHE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PARAGRAPHE
 (
   ID_PRG INTEGER(3) NOT NULL AUTO_INCREMENT ,
   PRELUDE_FR TEXT NOT NULL  ,
   PRELUDE_ES TEXT NOT NULL  ,
   ACCUEIL_FR TEXT NOT NULL  ,
   ACCUEIL_ES TEXT NOT NULL  ,
   PROJET_FR TEXT NOT NULL,
   PROJET_ES TEXT NOT NULL
   , PRIMARY KEY (ID_PRG) 
 ) 
ENGINE=InnoDB;
 

# -----------------------------------------------------------------------------
#       TABLE : UTILISATEUR
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS UTILISATEUR
 (
   ID_USER INTEGER(3) NOT NULL AUTO_INCREMENT ,
   PSEUDO VARCHAR(128) NOT NULL  ,
   MDP VARCHAR(255) NOT NULL  ,
   EMAIL_USER VARCHAR(128) NULL  
   , PRIMARY KEY (ID_USER) 
 ) 
 ENGINE=InnoDB;
 

# -----------------------------------------------------------------------------
#       TABLE : PHOTO
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PHOTO
 (
   ID_PHOTO INTEGER(3) NOT NULL AUTO_INCREMENT ,
   ID_PJ INTEGER(3) NOT NULL  ,
   REPERTOIRE VARCHAR(128) NOT NULL DEFAULT 'photos' ,
   NOM_PHOTO VARCHAR(128) NOT NULL  ,
   TITRE VARCHAR(128) NOT NULL,
   LONGITUDE DECIMAL(10,7) NOT NULL  ,
   LATITUDE DECIMAL(10,7) NOT NULL  ,
   DESCRIPTION_FR TEXT NOT NULL  ,
   DESCRIPTION_ES TEXT NOT NULL  ,
   ADRESSE_FR VARCHAR(128) NOT NULL  ,
   ADRESSE_ES VARCHAR(128) NOT NULL  ,
   PRECISIONLOC BOOL NOT NULL  ,
   ORDRE VARCHAR(10) NULL  ,
   DATE_PHOTO DATE NULL  ,
   STREET_VIEW TEXT NULL  ,
   ANGLE_VUE VARCHAR(10) NULL  
   , PRIMARY KEY (ID_PHOTO),
  CONSTRAINT ORDRE_UNIQUE UNIQUE (ID_PJ,ORDRE)
 ) 
 ENGINE=InnoDB;
 

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE PHOTO
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_PHOTO_PHOTOJOURNALISTE
     ON PHOTO (ID_PJ ASC);

# -----------------------------------------------------------------------------
#       TABLE : SUJET
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SUJET
 (
   ID_SUJET INTEGER(3) NOT NULL AUTO_INCREMENT ,
   LIBELLE_FR VARCHAR(128) NOT NULL  ,
   LIBELLE_ES VARCHAR(128) NOT NULL  
   , PRIMARY KEY (ID_SUJET) 
 ) 
 ENGINE=InnoDB;
 

# -----------------------------------------------------------------------------
#       TABLE : PHOTOJOURNALISTE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS PHOTOJOURNALISTE
 (
   ID_PJ INTEGER(3) NOT NULL AUTO_INCREMENT ,
   NOM_PJ VARCHAR(128) NOT NULL  ,
   PRENOM_PJ VARCHAR(128) NOT NULL  ,
   DESCRIPTION_PJ_FR TEXT NOT NULL, 
   DESCRIPTION_PJ_ES TEXT NOT NULL
   , PRIMARY KEY (ID_PJ) 
 ) 
 ENGINE=InnoDB;

# -----------------------------------------------------------------------------
#       TABLE : SUJETPHOTO
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS SUJETPHOTO
 (
   ID_PHOTO INTEGER(3) NOT NULL  ,
   ID_SUJET INTEGER(3) NOT NULL  
   , PRIMARY KEY (ID_PHOTO,ID_SUJET) 
 ) 
 ENGINE=InnoDB;

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE SUJETPHOTO
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_SUJETPHOTO_PHOTO
     ON SUJETPHOTO (ID_PHOTO ASC);

CREATE  INDEX I_FK_SUJETPHOTO_SUJET
     ON SUJETPHOTO (ID_SUJET ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE PHOTO 
  ADD CONSTRAINT FK_PHOTO_PHOTOJOURNALISTE FOREIGN KEY (ID_PJ)
      REFERENCES PHOTOJOURNALISTE (ID_PJ)  ;


ALTER TABLE SUJETPHOTO 
  ADD CONSTRAINT FK_SUJETPHOTO_PHOTO FOREIGN KEY (ID_PHOTO)
      REFERENCES PHOTO (ID_PHOTO) ON DELETE CASCADE ;


ALTER TABLE SUJETPHOTO 
  ADD CONSTRAINT FK_SUJETPHOTO_SUJET FOREIGN KEY (ID_SUJET)
      REFERENCES SUJET (ID_SUJET) ON DELETE CASCADE ;


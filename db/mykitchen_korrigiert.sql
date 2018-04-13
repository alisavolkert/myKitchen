/*
Copyright [2017] [Universität Tübingen]

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/
/*
terminal:
> mysql mykitchen_db < <path>/mykitchen.sql
> mysql -u <username> (password optional) -p mykitchen_db < <path>/mykitchen.sql (mit Password)

-- mykitchen_db optional
*/

/* create database and use it */
CREATE DATABASE IF NOT EXISTS mykitchen_db;

USE mykitchen_db;

/* delete tables and create new
DROP TABLE IF EXISTS cupboard;*/
DROP TABLE IF EXISTS mykitchen;
DROP TABLE IF EXISTS kitchen;
DROP TABLE IF EXISTS userscore;

CREATE TABLE mykitchen(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name varchar(50) NOT NULL,
  picture varchar(100) NOT NULL,
  height FLOAT NOT NULL,
  width FLOAT NOT NULL,
  depth FLOAT,
  filling_quantity FLOAT,
  handle boolean,
  inside_camber FLOAT
);

/*
CREATE TABLE kitchen(
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_css varchar(10) NOT NULL,
  name varchar(50) NOT NULL,
  picture varchar(100) NOT NULL,
  height FLOAT NOT NULL,
  width FLOAT NOT NULL,
  depth FLOAT,
  filling_quantity FLOAT,
);
*/

CREATE TABLE userscore {
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username varchar(50) NOT NULL,
  gender varchar(10) NOT NULL,
  age INTEGER,
  nationality varchar(50),
  hoursday INTEGER,
  hourswheek INTEGER,
  jobtitle varchar(100),
  starttime DATE,
  endtime DATE,
  mouseclicks INTEGER, /* number of mouse clicks */
  clicksonobjects INTEGER /* number of mouse clicks on objects*/
}

/* fill tables mykitchen and kitchen */
INSERT INTO mykitchen
  (name, picture, height, width, depth, filling_quantity, handle, inside_camber)
VALUES
("Becher","becher.jpg",11,7.3,7.3,0.25,0,10.8),
("Becher","becher.jpg",11,7.3,7.3,0.25,0,10.8),
("Becher","becher.jpg",11,7.3,7.3,0.25,0,10.8),
("Becher","becher.jpg",11,7.3,7.3,0.25,0,10.8),
("Becher","becher.jpg",11,7.3,7.3,0.25,0,10.8),
("Bechertasse","bechertasse.jpg",11,8,12,0.3,1,10.5),
("Bechertasse","bechertasse.jpg",11,8,12,0.3,1,10.5),
("Bechertasse","bechertasse.jpg",11,8,12,0.3,1,10.5),
("Bechertasse","bechertasse.jpg",11,8,12,0.3,1,10.5),
("Bechertasse","bechertasse.jpg",11,8,12,0.3,1,10.5),
("Bierkrug","bierkrug.jpg",28.3,8,12.2,0.8,1,27.2),
("Bierkrug","bierkrug.jpg",28.3,8,12.2,0.8,1,27.2),
("Bierkrug","bierkrug.jpg",28.3,8,12.2,0.8,1,27.2),
("Bierkrug","bierkrug.jpg",28.3,8,12.2,0.8,1,27.2),
("Bierkrug","bierkrug.jpg",28.3,8,12.2,0.8,1,27.2),
("Bruehe","bruehe.jpg",2,12,9,0,0,0),
("Dosenöffner","dosenoeffner.jpg",5,8,16,0,0,0),
("Essig","essig.JPG",24.5,7,7,0,0,24),
("Flaschenöffner","flaschenoeffner.jpg",1,4.5,17.3,0,0,0),
("Gabel","gabel.jpg",1.5,2.5,21,0,0,0),
("Gabel","gabel.jpg",1.5,2.5,21,0,0,0),
("Gabel","gabel.jpg",1.5,2.5,21,0,0,0),
("Gabel","gabel.jpg",1.5,2.5,21,0,0,0),
("Gabel","gabel.jpg",1.5,2.5,21,0,0,0),
("Geschirrhandtuch","geschirrhandtuecher.jpg",1.5,12,23.5,0,0,0),
("große Pfanne","grosse_pfanne.jpg",6,52,29,2.5,1,5.6),
("große Schüssel","grosse_schuessel.jpg",9.7,18,18,1.2,0,9),
("große Schüssel","grosse_schuessel.jpg",9.7,18,18,1.2,0,9),
("große Schüssel","grosse_schuessel.jpg",9.7,18,18,1.2,0,9),
("große Schüssel","grosse_schuessel.jpg",9.7,18,18,1.2,0,9),
("große Schüssel","grosse_schuessel.jpg",9.7,18,18,1.2,0,9),
("großer Teller","grosse_teller.jpg",2.7,27,27,0.3,0,1.2),
("großer Teller","grosse_teller.jpg",2.7,27,27,0.3,0,1.2),
("großer Teller","grosse_teller.jpg",2.7,27,27,0.3,0,1.2),
("großer Teller","grosse_teller.jpg",2.7,27,27,0.3,0,1.2),
("großer Teller","grosse_teller.jpg",2.7,27,27,0.3,0,1.2),
("großer Topf","grosser_topf.jpg",14.2,25,35,5.79,2,13.9),
("großes Küchenmesser","grosses_kuechenmesser.jpg",1.7,3.1,34,0,0,0),
("Kaffeekanne","kaffeekanne.jpg",24,16.5,12.5,1.3,1, 18.5),
("Kaffeemaschine","kaffeemaschine.jpg",37,19,19,1.2,0,0),
("Kartoffelschäler","kartoffelschaeler.jpg",1.7,7.4,15.8,0,0,0),
("kleine Pfanne","kleine_pfanne.jpg",4,35,19,0.7,1,3),
("kleine Schuessel","kleine_schuessel.jpg",7,13,13,0.3,0,5),
("kleine Schuessel","kleine_schuessel.jpg",7,13,13,0.3,0,5),
("kleine Schuessel","kleine_schuessel.jpg",7,13,13,0.3,0,5),
("kleine Schuessel","kleine_schuessel.jpg",7,13,13,0.3,0,5),
("kleine Schuessel","kleine_schuessel.jpg",7,13,13,0.3,0,5),
("Kleiner Teller","kleiner_teller.jpg",2.2,21,21,0.1,0,0.5),
("Kleiner Teller","kleiner_teller.jpg",2.2,21,21,0.1,0,0.5),
("Kleiner Teller","kleiner_teller.jpg",2.2,21,21,0.1,0,0.5),
("Kleiner Teller","kleiner_teller.jpg",2.2,21,21,0.1,0,0.5),
("Kleiner Teller","kleiner_teller.jpg",2.2,21,21,0.1,0,0.5),
("kleiner Topf","kleiner_topf.jpg",10,17,36.5,1.5,1,8),
("kleines Küchenmesser","kleines_kuechenmesser.jpg",1.2,2.1,21,0,0,0),
("Kuchenform","kuchenform.jpg",8,30.5,11.5,2,0,7.5),
("Löffel","loeffel.jpg",2.6,4.1,19.8,0.03,0,2.5),
("Löffel","loeffel.jpg",2.6,4.1,19.8,0.03,0,2.5),
("Löffel","loeffel.jpg",2.6,4.1,19.8,0.03,0,2.5),
("Löffel","loeffel.jpg",2.6,4.1,19.8,0.03,0,2.5),
("Löffel","loeffel.jpg",2.6,4.1,19.8,0.03,0,2.5),
("Messbecher","messbecher.jpg",16,18,12,1.2,1,15.6),
("Messer","messer.jpg",1.8,2.2,24.5,0,0,0),
("Messer","messer.jpg",1.8,2.2,24.5,0,0,0),
("Messer","messer.jpg",1.8,2.2,24.5,0,0,0),
("Messer","messer.jpg",1.8,2.2,24.5,0,0,0),
("Messer","messer.jpg",1.8,2.2,24.5,0,0,0),
("Nudelzange","nudelzange.jpg",4.5,5.5,25,0,0,4.3),
("Öl","oel.JPG",30.5,13.5,7,0,0,0),
("Pfannenwender","pfannenwender.jpg",4,7,26,0,0,0),
("Pfannenwender00","pfannenwender00.jpg",1,5,25,0,0,0),
("Saft","saft.jpg",30,8,8,1,0,29.5),
("Salatbesteck","salatbesteck.jpg",6,16,32,0.02,0,2),
("Salatschüsselchen","salatschuesselchen.jpg",4.3,14,14,0.25,0,4),
("Salatschüsselchen","salatschuesselchen.jpg",4.3,14,14,0.25,0,4),
("Salatschüsselchen","salatschuesselchen.jpg",4.3,14,14,0.25,0,4),
("Salatschüsselchen","salatschuesselchen.jpg",4.3,14,14,0.25,0,4),
("Salatschüsselchen","salatschuesselchen.jpg",4.3,14,14,0.25,0,4),
("Schere","schere.jpg",1.3,8,20,0,0,0),
("Schnapsglas","schnapsglas.jpg",5,3,3,0.045,0,4.5),
("Schnapsglas","schnapsglas.jpg",5,3,3,0.045,0,4.5),
("Schnapsglas","schnapsglas.jpg",5,3,3,0.045,0,4.5),
("Schnapsglas","schnapsglas.jpg",5,3,3,0.045,0,4.5),
("Schnapsglas","schnapsglas.jpg",5,3,3,0.045,0,4.5),
("Schneebesen","schneebesen.jpg",3.5,4.2,24.5,0,0,0),
("Schneidebrett","schneidebrett.jpg",0.7,40,22,0,0,0),
("Schokolade","schokolade.jpg",1.3,11.5,9,0,0,0),
("Sektglas","sektglas_200x200.JPG",16.5,5.2,0,15,0,9.5),
("Sektglas","sektglas_200x200.JPG",16.5,5.2,0,15,0,9.5),
("Sektglas","sektglas_200x200.JPG",16.5,5.2,0,15,0,9.5),
("Sektglas","sektglas_200x200.JPG",16.5,5.2,0,15,0,9.5),
("Sektglas","sektglas_200x200.JPG",16.5,5.2,0,15,0,9.5),
("Servierplatte","servierplatte.jpg",3,37,24,0.5,0,1.5),
("Servietten","servietten.jpg",4,15.5,15.5,0,0,0),
("Sieb","sieb.jpg",16,23.5,33.5,0,0,11),
("Suppenkelle","suppenkelle.jpg",3.5,6,25.5,0.054,0,3.4),
("Suppenschuessel","suppenschuessel.jpg",10,25,17.5,2,2,8.5),
("Suppentassen","suppentasse.jpg",5.5,17,11.8,0.43,2,5),
("Suppentassen","suppentasse.jpg",5.5,17,11.8,0.43,2,5),
("Suppentassen","suppentasse.jpg",5.5,17,11.8,0.43,2,5),
("Suppentassen","suppentasse.jpg",5.5,17,11.8,0.43,2,5),
("Suppentassen","suppentasse.jpg",5.5,17,11.8,0.43,2,5),
("Tablet","tablet.jpg",1.5,15,30,0.2,0,1.2),
("Teekanne","teekanne.jpg",25,22,16.5,1.4,1,20.8),
("Teetasse","teetasse.jpg",7.5,11.5,8.7,0.2,1,7),
("Teetasse","teetasse.jpg",7.5,11.5,8.7,0.2,1,7),
("Teetasse","teetasse.jpg",7.5,11.5,8.7,0.2,1,7),
("Teetasse","teetasse.jpg",7.5,11.5,8.7,0.2,1,7),
("Teetasse","teetasse.jpg",7.5,11.5,8.7,0.2,1,7),
("Thermoskanne","thermoskanne.jpg",19,14.5,9,0.4,1,17),
("tiefe Teller","tiefe_teller.jpg",3,22.5,22.5,0.4,0,2),
("tiefe Teller","tiefe_teller.jpg",3,22.5,22.5,0.4,0,2),
("tiefe Teller","tiefe_teller.jpg",3,22.5,22.5,0.4,0,2),
("tiefe Teller","tiefe_teller.jpg",3,22.5,22.5,0.4,0,2),
("tiefe Teller","tiefe_teller.jpg",3,22.5,22.5,0.4,0,2),
("Tischdecke","tischdecke.jpg",2.8,21,37.5,0,0,0),
("Toaster","toaster.jpg",23,31,17,0,0,7),
("Topflappen","topflappen.jpg",2.3,26,26,0,0,0),
("Trinkflasche","trinkflasche.jpg",24.1,11,8.5,1.5,0,23),
("Tupperware","tupper.jpg",7.7,22.5,16.5,2,0,7.5),
("Vase","vase.jpg",24.5,6.4,6.4,0.4,0,20),
("Wasserglas","wasserglas.jpg",9.5,6,6,0.18,0,8),
("Wasserglas","wasserglas.jpg",9.5,6,6,0.18,0,8),
("Wasserglas","wasserglas.jpg",9.5,6,6,0.18,0,8),
("Wasserglas","wasserglas.jpg",9.5,6,6,0.18,0,8),
("Wasserglas","wasserglas.jpg",9.5,6,6,0.18,0,8),
("Wasserkocher","wasserkocher.jpg",19.5,11.3,17,1,1,18),
("Weinglas","weinglas.jpg",19,7.5,7.5,0.3,0,10.2),
("Weinglas","weinglas.jpg",19,7.5,7.5,0.3,0,10.2),
("Weinglas","weinglas.jpg",19,7.5,7.5,0.3,0,10.2),
("Weinglas","weinglas.jpg",19,7.5,7.5,0.3,0,10.2),
("Weinglas","weinglas.jpg",19,7.5,7.5,0.3,0,10.2),
("Weinöffner","weinoeffner.jpg",1,9.5,17.7,0,0,0),
("Wok","wok.jpg",12,50,40,3.6,2,10),
("Zwiebeln","zwiebel.jpg",8,16,17,0,0,0),
("Spülmittel","spuelmittel_mit_schwamm.jpg",21.5,19,6.5,0,0,0),
("Vorräte","vorraete.jpg",30,57,23,0,0,0),
("Muelleimer","muelleimer.jpg",30,25,25,18.75,0,29),
("Gewürze","gewuerze.jpg",12.5,18.5,7.5,0,0,0),
("Mikrowelle","mikrowelle.jpg",27.9,48.8,39.5,36,0,0),
("Müllbeutel","muellbeutel_alufolie_usw.jpg",5,15,30,0,0,0);


INSERT INTO mykitchen
  (name, picture, height, width, depth, filling_quantity, inside_camber)
VALUES
  ("Backofen","",60,56,55,184,0),
  ("grosse Schublade","",31,51,61,96.44,31),
  ("Kochfeld","",4.6,58,51,0,0),
  ("kleine Schublade","",10,40,50,20,9),
  ("Kuehlschrank","",95,58,68,374.68,0),
  ("Mikrowelle","",27.9,48.8,39.5,36,0),
  ("Regalfach","",30,57,19.5,33.3,0),
  ("Spuelmaschine","",60,84.5,60,200,0);

/* import csv file into table mykitchen
LOAD DATA LOCAL
  INFILE 'mykitchen.csv'
  INTO TABLE mykitchen
  FIELDS TERMINATED BY ';'
  ENCLOSED BY '"'
  LINES TERMINATED BY '\n'
  IGNORE 1 ROWS;
*/

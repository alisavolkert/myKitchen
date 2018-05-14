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

/* OLD VERSION */
/*
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
*/

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

/* NEW VERSION */
DROP TABLE IF EXISTS mykitchen2;
CREATE TABLE mykitchen2(
  id int NOT NULL PRIMARY KEY,
  name varchar(50) NOT NULL,
  picture varchar(100) NOT NULL,
  height FLOAT NOT NULL,
  width FLOAT NOT NULL,
  depth FLOAT,
  concavity FLOAT,
  weight FLOAT,
  volume FLOAT,
  handle INTEGER,
  material varchar(50)
);

/* Material:
1: Glas/ glass
2: Lebensmittel/ food
3: Sonstiges / 
4: Plastik / plastic
5: Edelstahl / steel
6: Teflon / 
7: Holz / wood
8: Porzellan / china
9: Emaille / enamel
10: Blech / 
11: Lehm / clay
*/

/*NEW VERSION: fill table mykitchen2*/
INSERT INTO mykitchen2
  (id, name, picture, height, width, depth, concavity, weight, volume, handle, material)
VALUES

(1, "plastic cup 1", "001.jpg", 9.3, 7, 7, 9, 2, 0.23, 0, "plastic"),
(2, "plastic cup 2", "002.jpg", 9.3, 7, 7, 9, 2, 0.23, 0, "plastic"),
(3, "plastic cup 3", "003.jpg", 9.3, 7, 7, 9, 2, 0.23, 0, "plastic"),
(4, "plastic cup 4", "004.jpg", 9.3, 7, 7, 9, 2, 0.23, 0, "plastic"),
(5, "plastic cup 5", "005.jpg", 9.3, 7, 7, 9, 2, 0.23, 0, "plastic"),
(6, "mug 1", "006.jpg", 10, 7.5, 7.5, 9, 199, 0.2, 0, "china"),
(7, "mug 2", "007.jpg", 9.5, 8.5, 8.5, 8.5, 264, 0.3, 1, "china"),
(8, "mug 3", "008.jpg", 9.5, 8, 8, 8, 337, 0.32, 1, "china"),
(9, "mug 4", "009.jpg", 10, 7.5, 7.5, 9, 313, 0.285, 1, "china"),
(10, "mug 5", "010.jpg", 10, 10.5, 10.5, 8, 576, 0.52, 1, "china"),
(11, "beer glass 1", "011.jpg", 16, 8.5, 8.5, 15, 803, 0.65, 0, "glass"),
(12, "beer glass 2", "012.jpg", 23.5, 8, 8, 21, 464, 0.66, 0, "glass"),
(13, "beer glass 3", "013.jpg", 23.5, 8, 8, 21, 464, 0.66, 0, "glass"),
(14, "beer glass 4", "014.jpg", 25, 8, 8, 23, 573, 0.6, 0, "glass"),
(15, "beer mug", "015.jpg", 11, 8, 8, 10, 374, 0.32, 1, "clay"),
(16, "broth", "016.jpg", 8, 6.5, 6.5, 0, 148, 0, 0, "food, glass"),
(17, "can opener", "017.jpg", 3, 2.5, 14.5, 0, 76, 0, 0, "steel"),
(18, "vinegar", "018.jpg", 20, 6, 6, 0, 463, 0, 0, "food, glass"),
(19, "bottle opener", "019.jpg", 1.6, 4, 16.5, 0, 37, 0, 0, "steel, wood"),
(20, "fork 1", "020.jpg", 2.5, 2.5, 20, 0, 34, 0, 0, "stainless steel"),
(21, "fork 2", "021.jpg", 2.5, 2.5, 20, 0, 34, 0, 0, "stainless steel"),
(22, "fork 3", "022.jpg", 2.5, 2.5, 20, 0, 34, 0, 0, "stainless steel"),
(23, "fork 4", "023.jpg", 2.5, 2.5, 20, 0, 34, 0, 0, "stainless steel"),
(24, "fork 5", "024.jpg", 2.5, 3, 21, 0, 58, 0, 0, "stainless steel"),

(25, "mixing bowl", "025.jpg", 11, 22, 22, 10.3, 158, 2.5, 1, "plastic"),
(26, "pan, big", "026.jpg", 6, 27.5, 27.5, 5.2, 1361, 2, 1, "stainless steel"),
(27, "bowl, big 1", "027.jpg", 9.8, 28, 28, 9, 466, 4.8, 0, "plastic"),
(28, "bowl, big 2", "028.jpg", 14, 25.5, 25.5, 10, 475, 3.45, 0, "plastic"),
(29, "bread knife", "029.jpg", 1.6, 4, 38, 0, 126, 0, 0, "stainless steel"),
(30, "moka pot", "030.jpg", 20.5, 10.5, 10.5, 7.3, 394, 0.37, 1, "aluminum"),
(31, "hand mixer", "031.jpg", 12.5, 16, 7.5, 0, 922, 0, 1, "plastic, electronics"),
(32, "plate, big 1", "032.jpg", 1.5, 27.5, 27.5, 0.5, 357, 0.3, 0, "plastic"),
(33, "plate, big 2", "033.jpg", 1.5, 27.5, 27.5, 0.5, 357, 0.3, 0, "plastic"),
(34, "plate, big 3", "034.jpg", 2.3, 26.5, 26.5, 1.5, 708, 0.46, 0, "china"),
(35, "plate, big 4", "035.jpg", 2.3, 26.5, 26.5, 1.5, 708, 0.46, 0, "china"),
(36, "plate, big 5", "036.jpg", 2.3, 25.6, 25.6, 1.2, 664, 0.325, 0, "china"),
(37, "pot, big", "037.jpg", 22.5, 29, 29, 21, 1548, 13.2, 2, "stainless steel"), /*Fehler bei Volumen??*/
(38, "cooking knife, big", "038.jpg", 2.5, 4, 33, 0, 139, 0, 0, "stainless steel, plastic"),
(39, "coffee pot", "039.jpg", 10, 15.5, 15.5, 8, 306, 1.35, 1, "glass, plastic"),
(40, "coffee maschine", "040.jpg", 50, 20, 20, 0, 1860, 0, 0, "aluminum, glass, plastic, electronics"),
(41, "peeler", "041.jpg", 1.3, 4, 18, 0, 47, 0, 0, "stainless steel"),
(42, "pan, small", "042.jpg", 3.5, 19.5, 19.5, 3.2, 419, 0.8, 1, "teflon"),
(43, "bowl, small 1", "043.jpg", 5, 12, 12, 4, 204, 0.3, 0, "china"),
(44, "bowl, small 2", "044.jpg", 4.5, 11, 11, 4, 178, 0.275, 0, "glass"),
(45, "bowl, small 3", "045.jpg", 4.5, 11, 11, 4, 178, 0.275, 0, "glass"),
(46, "bowl, small 4", "046.jpg", 4.2, 16, 16, 3.8, 272, 0.35, 0, "glass, stainless steel"),
(47, "bowl, small 5", "047.jpg", 4.2, 16, 16, 3.8, 272, 0.35, 0, "glass, stainless steel"),
(48, "plate, small 1", "048.jpg", 2.3, 19.8, 19.8, 1.4, 412, 0.225, 0, "china"),
(49, "plate, small 2", "049.jpg", 2.3, 19.8, 19.8, 1.4, 412, 0.225, 0, "china"),

(50, "plate, small 3", "050.jpg", 2, 19, 19, 1.3, 288, 0.233, 0, "china"),
(51, "plate, small 4", "051.jpg", 2.1, 18.7, 18.7, 1.5, 307, 0.245, 0, "china"),
(52, "plate, small 5", "052.jpg", 2.4, 19.6, 19.6, 1.4, 328, 0.225, 0, "china"),
(53, "pot, small, steel", "053.jpg", 8, 20.4, 15, 7.5, 278, 1, 2, "stainless steel"),
(54, "cooking knife, small", "054.jpg", 1.3, 2, 19.5, 0, 41, 0, 0, "stainless steel, plastic"),
(55, "cake pan", "055.jpg", 12, 23, 23, 11, 569, 2.85, 0, "steel"),
(56, "spoon, big 1", "056.jpg", 2, 4.5, 19, 0.6, 41, 0.008, 0, "stainless steel"),
(57, "spoon, big 2", "057.jpg", 2.3, 4.5, 20, 0.8, 47, 0.009, 0, "stainless steel"),
(58, "spoon, big 3", "058.jpg", 2.5, 4.5, 19, 0.5, 60, 0.008, 0, "stainless steel"),
(59, "spoon, big 4", "059.jpg", 2.3, 4.1, 18, 0.5, 39, 0.008, 0, "stainless steel"),
/*(60, "spoon, big 5", "060.jpg", 2, 4.3, 20, 0.5, 41, 0.008, 0, "stainless steel"), Bild gibts nicht*/
(61, "balance", "061.jpg", 9.5, 33.5, 20, 0, 1855, 0, 0, "steel"),
(62, "knife 1", "062.jpg", 0.5, 2, 21, 0, 78, 0, 0, "stainless steel"),
(63, "knife 2", "063.jpg", 0.6, 1.8, 21, 0, 77, 0, 0, "stainless steel"),
(64, "knife 3", "064.jpg", 0.5, 2, 21, 0, 78, 0, 0, "stainless steel"),
(65, "knife 4", "065.jpg", 0.6, 1.9, 21.5, 0, 79, 0, 0, "stainless steel"),
(66, "knife 5", "066.jpg", 0.8, 1.6, 21, 0, 35, 0, 0, "stainless steel"),
(67, "spaghetti scoop", "067.jpg", 4.5, 7.5, 31, 0, 66, 0, 0, "plastic, aluminum"),
(68, "oil", "068.jpg", 28, 7, 7, 0, 836, 0, 0, "food, glass"),
(69, "spatula, steel", "069.jpg", 4, 7, 28, 0, 93, 0, 0, "stainless steel"),
(70, "spatula, plastic", "070.jpg", 3, 6.5, 32.5, 0, 50, 0, 0, "plastic"),
(71, "juice", "071.jpg", 23, 9.5, 6.5, 0, 1552, 0, 0, "food, plastic"),
(72, "french bowl 1", "072.jpg", 6, 12, 12, 5, 162, 0.32, 0, "china"),
(73, "french bowl 2", "073.jpg", 6, 12, 12, 5, 162, 0.32, 0, "china"),
(74, "french bowl 3", "074.jpg", 6, 12, 12, 5, 162, 0.32, 0, "china"),

(75, "french bowl 4", "075.jpg", 6, 12, 12, 5, 162, 0.32, 0, "china"),
(76, "french bowl 5", "076.jpg", 6, 12, 12, 5, 162, 0.32, 0, "china"),
(77, "measuring tube", "077.jpg", 14.9, 10.5, 10.5, 14.6, 271, 1.13, 1, "glass"),
(78, "kitchen scissors", "078.jpg", 1.2, 8, 21, 0, 107, 0, 0, "stainless steel, plastic"),
(79, "shot glass 1", "079.jpg", 7, 4, 4, 5, 47, 0.05, 0, "glass"),
(80, "shot glass 2", "080.jpg", 7, 4, 4, 5, 47, 0.05, 0, "glass"),
(81, "shot glass 3", "081.jpg", 7, 4, 4, 5, 47, 0.05, 0, "glass"),
(82, "shot glass 4", "082.jpg", 7, 4, 4, 5, 47, 0.05, 0, "glass"),
(83, "shot glass 5", "083.jpg", 7, 4, 4, 5, 47, 0.05, 0, "glass"),
(84, "eggbeater", "084.jpg", 6.5, 6.5, 32, 0, 76, 0, 0, "stainless steel, plastic"),
(85, "sieve", "085.jpg", 10.5, 22, 22, 10, 100, 0, 1, "plastic"),
(86, "chocolate", "086.jpg", 1, 7.5, 18, 0, 103, 0, 0, "food, paper"),
(87, "champagne glass 1", "087.jpg", 22.5, 5.5, 5.5, 11, 159, 0.195, 0, "glass"),
(88, "champagne glass 2", "088.jpg", 20.5, 4.5, 4.5, 10, 159, 0.095, 0, "glass"),
(89, "champagne glass 3", "089.jpg", 20.5, 4.5, 4.5, 10, 159, 0.095, 0, "glass"),
(90, "champagne glass 4", "090.jpg", 22, 5.5, 5.5, 10, 133, 0.17, 0, "glass"),
(91, "champagne glass 5", "091.jpg", 22, 5.5, 5.5, 10, 133, 0.17, 0, "glass"),
(92, "platter", "092.jpg", 2.5, 26, 17, 1, 575, 0.35, 0, "clay"),
(93, "salad cutlery, fork", "093.jpg", 2, 7.5, 28, 0, 30, 0, 0, "plastic"),
(94, "rag 1", "094.jpg", 0.3, 19, 18, 0, 14, 0, 0, "foam"),
(95, "dipper", "095.jpg", 6.4, 10.8, 31.3, 3.5, 56, 0.136, 0, "plastic"),
(96, "apron", "096.jpg", 0.1, 60, 80, 0, 197, 0, 0, "cloth"),
(97, "soup bowl 1", "097.jpg", 6.5, 11.5, 11.5, 5.8, 418, 500, 2, "clay"),
(98, "soup bowl 2", "098.jpg", 6.5, 11.5, 11.5, 5.8, 418, 500, 2, "clay"),
(99, "soup bowl 3", "099.jpg", 6.5, 11.5, 11.5, 5.8, 418, 500, 2, "clay"),

(100, "soup bowl 4", "100.jpg", 6.5, 11.5, 11.5, 5.8, 418, 500, 2, "clay"),
(101, "soup bowl 5", "101.jpg", 6.5, 11.5, 11.5, 5.8, 418, 500, 2, "clay"),
(102, "tray", "102.jpg", 4.4, 40, 31, 3.7, 119, 0.75, 2, "plastic"),
(103, "teapot", "103.jpg", 12.5, 13.5, 13.5, 12, 350, 1.35, 1, "glass, plastic"),
(104, "teacup 1", "104.jpg", 6.5, 8.5, 8.5, 6, 156, 210, 1, "china"),
(105, "teacup 2", "105.jpg", 6.5, 8.5, 8.5, 6, 156, 210, 1, "china"),
(106, "teacup 3", "106.jpg", 6.5, 8.5, 8.5, 6, 156, 210, 1, "china"),
(107, "teacup 4", "107.jpg", 6.5, 8.5, 8.5, 6, 156, 210, 1, "china"),
(108, "teacup 5", "108.jpg", 6.5, 8.5, 8.5, 6, 156, 210, 1, "china"),
(109, "thermos", "109.jpg", 23, 7.5, 7.5, 19, 400, 0.6, 0, "stainless steel"),
(110, "plate, deep 1", "110.jpg", 6, 30, 30, 5, 944, 1.53, 0, "china"),
(111, "plate, deep 2", "111.jpg", 4, 21, 21, 3, 482, 0.45, 0, "china"),
(112, "plate, deep 3", "112.jpg", 4, 21, 21, 3, 482, 0.45, 0, "china"),
(113, "plate, deep 4", "113.jpg", 4, 22, 22, 3.5, 531, 0.5, 0, "china"),
(114, "plate, deep 5", "114.jpg", 3.9, 26, 26, 3, 583, 0.7, 0, "china"),
(115, "tablecloth", "115.jpg", 0.1, 100, 180, 0, 293, 0, 0, "cloth"),
(116, "breadbasket", "116.jpg", 8.5, 26, 26, 7.8, 90, 0, 0, "wood"),
(117, "potholder 1", "117.jpg", 0.7, 18.5, 18.5, 0, 55, 0, 0, "cloth"),
(118, "potholder 2", "118.jpg", 0.7, 18.5, 18.5, 0, 55, 0, 0, "cloth"),
(119, "oven dish 1", "119.jpg", 6.2, 20.7, 20.7, 5.4, 951, 1.4, 0, "clay"),
(120, "oven dish 2", "120.jpg", 6.7, 34, 23, 5.3, 1599, 2.6, 0, "clay"),
(121, "tumbler 1", "121.jpg", 10, 7.5, 7.5, 9, 182, 0.25, 0, "glass"),
(122, "tumbler 2", "122.jpg", 12, 6.5, 6.5, 11, 241, 0.23, 0, "glass"),
(123, "tumbler 3", "123.jpg", 14, 6, 6, 12, 293, 0.3, 0, "glass"),
(124, "tumbler 4", "124.jpg", 13.5, 8.5, 8.5, 12, 423, 0.4, 0, "glass"),

/*(125, "tumbler 5", "125.jpg", 8.5, 6.9, 6.9, 7, 140, 0.2, 0, "glass"), Bild gibts nicht*/
(126, "electric kettle", "126.jpg", 21, 14, 9, 16, 557, 1.2, 1, "plastic, electronics"),
(127, "wineglass 1", "127.jpg", 11, 6.5, 6.5, 4.5, 142, 0.15, 0, "glass"),
(128, "wineglass 2", "128.jpg", 11, 6.5, 6.5, 4.5, 142, 0.15, 0, "glass"),
(129, "wineglass 3", "129.jpg", 11, 6.5, 6.5, 4.5, 142, 0.15, 0, "glass"),
(130, "wineglass 4", "130.jpg", 11, 6.5, 6.5, 4.5, 142, 0.15, 0, "glass"),
(131, "wineglass 5", "131.jpg", 17, 6.5, 6.5, 9, 86, 0.22, 0, "glass"),
(132, "corkscrew", "132.jpg", 3.5, 7, 14, 0, 180, 0, 0, "stainless steel"),
(133, "wok", "133.jpg", 8, 29.5, 29.5, 7.5, 844, 3.7, 1, "teflon"),
(134, "onion", "134.jpg", 6, 5, 5, 0, 50, 0, 0, "food"),
(135, "cooking spoon", "135.jpg", 1.5, 5, 32, 0.6, 31, 0.005, 0, "wood"),
(136, "hand mixer, stirrer 1", "136.jpg", 3.7, 3.2, 20, 0, 36, 0, 0, "stainless steel"),
(137, "hand mixer, stirrer 2", "137.jpg", 3.7, 3.2, 20, 0, 36, 0, 0, "stainless steel"),
(138, "hand mixer, dough hook 1", "138.jpg", 2.2, 2.7, 20.5, 0, 33, 0, 0, "stainless steel"),
(139, "hand mixer, dough hook 2", "139.jpg", 2.2, 2.7, 20.5, 0, 33, 0, 0, "stainless steel"),
(140, "tea towel 1", "140.jpg", 0.2, 45, 60, 0, 88, 0, 0, "cloth"),
(141, "tea towel 2", "141.jpg", 0.1, 45, 60, 0, 64, 0, 0, "cloth"),
(142, "dinnerware set, eggcup 1", "142.jpg", 6.3, 5, 5, 4, 62, 0.05, 0, "china"),
(143, "dinnerware set, eggcup 2", "143.jpg", 6.3, 5, 5, 4, 62, 0.05, 0, "china"),
(144, "dinnerware set, eggcup 3", "144.jpg", 6.3, 5, 5, 4, 62, 0.05, 0, "china"),
(145, "dinnerware set, eggcup 4", "145.jpg", 6.3, 5, 5, 4, 62, 0.05, 0, "china"),
(146, "dinnerware set, eggcup 5", "146.jpg", 6.3, 5, 5, 4, 62, 0.05, 0, "china"),
(147, "espresso cup 1", "147.jpg", 5, 7, 7, 4, 89, 0.09, 1, "clay"),
(148, "espresso cup 2", "148.jpg", 5, 7, 7, 4, 89, 0.09, 1, "clay"),
(149, "espresso cup 3", "149.jpg", 5, 7, 7, 4, 89, 0.09, 1, "clay"),

(150, "espresso cup 4", "150.jpg", 5, 7, 7, 4, 89, 0.09, 1, "clay"),
(151, "espresso cup 5", "151.jpg", 5, 7, 7, 4, 89, 0.09, 1, "clay"),
(152, "espresso cup, saucer 1", "152.jpg", 1.5, 11.5, 11.5, 0.5, 127, 0.06, 0, "clay"),
(153, "espresso cup, saucer 2", "153.jpg", 1.5, 11.5, 11.5, 0.5, 127, 0.06, 0, "clay"),
(154, "espresso cup, saucer 3", "154.jpg", 1.5, 11.5, 11.5, 0.5, 127, 0.06, 0, "clay"),
(155, "espresso cup, saucer 4", "155.jpg", 1.5, 11.5, 11.5, 0.5, 127, 0.06, 0, "clay"),
(156, "espresso cup, saucer 5", "156.jpg", 1.5, 11.5, 11.5, 0.5, 127, 0.06, 0, "clay"),
(157, "teacup, saucer 1", "157.jpg", 1.5, 13.5, 13.5, 1, 152, 0.1, 0, "china"),
(158, "teacup, saucer 2", "158.jpg", 1.5, 13.5, 13.5, 1, 152, 0.1, 0, "china"),
(159, "teacup, saucer 3", "159.jpg", 1.5, 13.5, 13.5, 1, 152, 0.1, 0, "china"),
(160, "teacup, saucer 4", "160.jpg", 1.5, 13.5, 13.5, 1, 152, 0.1, 0, "china"),
(161, "teacup, saucer 5", "161.jpg", 1.5, 13.5, 13.5, 1, 152, 0.1, 0, "china"),
(162, "child's spoon 1", "162.jpg", 1.5, 2.5, 14.5, 0.4, 5, 0.003, 0, "plastic"),
(163, "child's spoon 2", "163.jpg", 1.5, 2.5, 14.5, 0.4, 5, 0.003, 0, "plastic"),
(164, "child's cup 1", "164.jpg", 8.5, 7.5, 7.5, 8, 29, 0.25, 0, "plastic"),
(165, "child's cup 2", "165.jpg", 8.5, 7.5, 7.5, 8, 29, 0.25, 0, "plastic"),
(166, "child's plate 1", "166.jpg", 2.5, 18.5, 18.5, 2, 54, 0.4, 0, "plastic"),
(167, "child's plate 2", "167.jpg", 4.5, 23, 23, 3, 373, 0.6, 0, "plastic"),
(168, "cake fork 1", "168.jpg", 1.5, 2.1, 14.2, 0, 17, 0, 0, "stainless steel"),
(169, "cake fork 2", "169.jpg", 1.5, 2.1, 14.2, 0, 17, 0, 0, "stainless steel"),
(170, "cake fork 3", "170.jpg", 1.5, 2.1, 14.2, 0, 17, 0, 0, "stainless steel"),
(171, "cake fork 4", "171.jpg", 1.4, 2.2, 143.7, 0, 15, 0, 0, "stainless steel"),
(172, "cake fork 5", "172.jpg", 2, 2, 14.2, 0, 18, 0, 0, "stainless steel"),
(173, "rag 2", "173.jpg", 0.1, 50, 37, 0, 10, 0, 0, "cloth"),
(174, "chopping board 1", "174.jpg", 1, 23, 15, 0, 242, 0, 0, "wood"),

(175, "chopping board 2", "175.jpg", 1.8, 30, 20, 0, 586, 0, 0, "wood"),
(176, "bowl, medium 1", "176.jpg", 8, 14, 14, 7, 481, 0.65, 0, "china"),
(177, "bowl, medium 2", "177.jpg", 7.5, 13, 13, 6.5, 377, 0.45, 0, "china"),
(178, "napkin 1", "178.jpg", 0.05, 16, 17, 0, 5, 0, 0, "paper"),
(179, "napkin 2", "179.jpg", 0.05, 16, 17, 0, 5, 0, 0, "paper"),
(180, "napkin 3", "180.jpg", 0.05, 16, 17, 0, 4, 0, 0, "paper"),
(181, "napkin 4", "181.jpg", 0.05, 16.5, 16.5, 0, 5, 0, 0, "paper"),
(182, "napkin 5", "182.jpg", 0.05, 16.5, 16.5, 0, 5, 0, 0, "paper"),
(183, "teaspoon 1", "183.jpg", 1.5, 2.8, 12, 0.5, 18, 0.002, 0, "stainless steel"),
(184, "teaspoon 2", "184.jpg", 1.5, 2.8, 12, 0.5, 18, 0.002, 0, "stainless steel"),
(185, "teaspoon 3", "185.jpg", 1.5, 2.8, 12, 0.5, 18, 0.002, 0, "stainless steel"),
(186, "teaspoon 4", "186.jpg", 1.4, 2.7, 12.2, 0.4, 14, 0.003, 0, "stainless steel"),
(187, "teaspoon 5", "187.jpg", 1.4, 2.7, 12.2, 0.4, 14, 0.003, 0, "stainless steel"),
(188, "pot, small, enamel", "188.jpg", 12, 17.5, 17.5, 11, 1532, 2.2, 2, "enamel"),
(189, "coffee filter", "189.jpg", 5.5, 16.5, 10.5, 0, 140, 0, 0, "paper"),
(190, "drinking bottle", "190.jpg", 16, 6.5, 6.5, 12.5, 100, 0.36, 0, "aluminum"),
(191, "plastic container 1", "191.jpg", 13.5, 10.5, 10.5, 13, 135, 0.95, 0, "plastic"),
(192, "plastic container 2", "192.jpg", 7, 17.5, 12, 6, 141, 0.95, 0, "plastic"),
(193, "plastic container 3", "193.jpg", 6, 11, 7.5, 4.7, 49, 0.22, 0, "plastic"),
(194, "coaster, glass 1", "194.jpg", 0.4, 9.6, 9.6, 0, 37, 0, 0, "cork, plastic"),
(195, "coaster, glass 2", "195.jpg", 0.4, 9.6, 9.6, 0, 37, 0, 0, "cork, plastic"),
(196, "coaster, pot 1", "196.jpg", 2, 19.5, 18.5, 0, 211, 0, 0, "stainless steel"),
(197, "coaster, pot 2", "197.jpg", 1, 18, 18, 0, 64, 0, 0, "cork"),
(198, "vase 1, jug", "198.jpg", 14, 11, 11, 13, 509, 0.7, 1, "clay"),
(199, "vase 2, jug", "199.jpg", 13.5, 8, 8, 13, 287, 0.2, 1, "clay"),

(200, "vase 3, jug", "200.jpg", 17, 7, 7, 16.3, 256, 0.23, 1, "glass"),
(201, "vase 4", "201.jpg", 14, 10, 10, 13, 210, 0.68, 0, "glass"),
(202, "vase 5", "202.jpg", 20, 12.5, 12.5, 18, 716, 2.15, 0, "glass"),
(203, "salad cutlery, spoon", "203.jpg", 2, 7.5, 28, 1, 32, 0.015, 0, "plastic"),
(204, "dinnerware set, teapot", "204.jpg", 19, 15, 15, 12, 861, 1.25, 1, "china"),
(205, "dinnerware set, milk jug", "205.jpg", 10.5, 7, 7, 8.5, 160, 0.2, 1, "china"),
(206, "dinnerware set, cup 1", "206.jpg", 6.5, 9.5, 9.5, 5, 116, 0.2, 1, "china"),
(207, "dinnerware set, cup 2", "207.jpg", 6.5, 9.5, 9.5, 5, 116, 0.2, 1, "china"),
(208, "dinnerware set, cup 3", "208.jpg", 6.5, 9.5, 9.5, 5, 116, 0.2, 1, "china"),
(209, "dinnerware set, cup 4", "209.jpg", 6.5, 9.5, 9.5, 5, 116, 0.2, 1, "china"),
(210, "dinnerware set, cup 5", "210.jpg", 6.5, 9.5, 9.5, 5, 116, 0.2, 1, "china"),
(211, "dinnerware set, coffee pot", "211.jpg", 19.5, 10.5, 10.5, 13.5, 556, 0.75, 1, "china"),
/*(212, "dinnerware set, plate 1", "212.jpg", 2.4, 19.5, 19.5, 1.6, 249, 0.3, 0, "china"),
(213, "dinnerware set, plate 2", "213.jpg", 2.4, 19.5, 19.5, 1.6, 249, 0.3, 0, "china"),
(214, "dinnerware set, plate 3", "214.jpg", 2.4, 19.5, 19.5, 1.6, 249, 0.3, 0, "china"),
(215, "dinnerware set, plate 4", "215.jpg", 2.4, 19.5, 19.5, 1.6, 249, 0.3, 0, "china"),
(216, "dinnerware set, plate 5", "216.jpg", 2.4, 19.5, 19.5, 1.6, 249, 0.3, 0, "china"), Bilder gibts nicht */
(217, "dinnerware set, saucer 1", "217.jpg", 2, 14, 14, 1.5, 129, 0.12, 0, "china"),
(218, "dinnerware set, saucer 2", "218.jpg", 2, 14, 14, 1.5, 129, 0.12, 0, "china"),
(219, "dinnerware set, saucer 3", "219.jpg", 2, 14, 14, 1.5, 129, 0.12, 0, "china"),
(220, "dinnerware set, saucer 4", "220.jpg", 2, 14, 14, 1.5, 129, 0.12, 0, "china"),
(221, "dinnerware set, saucer 5", "221.jpg", 2, 14, 14, 1.5, 129, 0.12, 0, "china"),
(222, "eggcup 1", "222.jpg", 5.5, 5.5, 5.5, 3.5, 83, 0.039, 0, "china"),
(223, "eggcup 2", "223.jpg", 5.5, 5.5, 5.5, 3.5, 83, 0.039, 0, "china"),
(224, "cake plate 2", "224.jpg", 2, 30, 30, 1, 984, 0.75, 0, "clay"),
(225, "cake plate 2", "225.jpg", 3, 25, 25, 2.5, 533, 0.7, 0, "china");


/* OLD VERSION: fill tables mykitchen and kitchen */
/*
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
*/

/*
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
*/  


/* import csv file into table mykitchen
LOAD DATA LOCAL
  INFILE 'mykitchen.csv'
  INTO TABLE mykitchen
  FIELDS TERMINATED BY ';'
  ENCLOSED BY '"'
  LINES TERMINATED BY '\n'
  IGNORE 1 ROWS;
*/

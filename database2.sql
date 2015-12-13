CREATE DATABASE projectweb;
USE projectweb;
CREATE TABLE users (
    id_user INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
	dept VARCHAR(50),
	inv_code VARCHAR(50),
    confirm BOOLEAN NOT NULL default false
);

CREATE TABLE admins (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,/* Attention, j'ai dû changer id_admin en id pour que cake arrête de faire n'imp*/
    password VARCHAR(50),
	ip VARCHAR(50),
	login VARCHAR(20)				/* ajouté par mes soins*/
);

CREATE TABLE teams (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,/* id_team => id*/
    name VARCHAR(50),
	subject VARCHAR(255)
);

CREATE TABLE rounds (
    id INT UNSIGNED PRIMARY KEY,/* j'ai transformé id_round en id et j'ai retiré le AUTO_INCREMENT qui est assez contraignant finalement*/
	status VARCHAR(15) default "not started",	/*is_open BOOLEAN NOT NULL default false,*/
	is_final BOOLEAN NOT NULL default false
);

CREATE TABLE results (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,/* Same thing : id_result => id*/
    id_round INT UNSIGNED,
	result  VARCHAR(50),
	prize INT(20) NOT NULL DEFAULT 0 ,
	FOREIGN KEY (id_round) REFERENCES rounds(id)/* Same thing : id_result => id*/
);

CREATE TABLE team_results (
    id_result INT UNSIGNED,
    id_team INT UNSIGNED,
	FOREIGN KEY (id_result) REFERENCES results(id),/* Same thing : id_result => id*/
	FOREIGN KEY (id_team) REFERENCES teams(id)/* Same thing : id_team => id*/
);



//ALTER TABLE `admins` ADD `login_admin` VARCHAR(20) NOT NULL ;


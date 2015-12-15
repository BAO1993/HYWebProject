DROP DATABASE IF EXISTS projectweb;

CREATE DATABASE projectweb;
USE projectweb;
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
	dept VARCHAR(50),
    confirm BOOLEAN NOT NULL default false,
    inv_code VARCHAR(50),
    voted BOOLEAN NOT NULL default false
    
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
	subject VARCHAR(255),
	out_game BOOLEAN NOT NULL default false
);

CREATE TABLE rounds (
    id INT UNSIGNED,/* j'ai transformé id_round en id et j'ai retiré le AUTO_INCREMENT qui est assez contraignant finalement*/
	status VARCHAR(15) default "not started",	/*is_open BOOLEAN NOT NULL default false,*/
	is_final BOOLEAN NOT NULL default false,
	inv_code VARCHAR(50)
);

CREATE TABLE results (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,/* Same thing : id_result => id*/
	result  VARCHAR(50),
	prize INT(20) NOT NULL DEFAULT 0 
);

CREATE TABLE team_results (
    id_result INT UNSIGNED,
    id_team INT UNSIGNED,
    id_round INT UNSIGNED/*,
	FOREIGN KEY (id_result) REFERENCES results(id),*//* Same thing : id_result => id*/
	/*FOREIGN KEY (id_team) REFERENCES teams(id)*//* Same thing : id_team => id*/
);

/*ALTER TABLE team_results ADD CONSTRAINT fk_result FOREIGN KEY (id_result) REFERENCES results(id);
ALTER TABLE team_results ADD CONSTRAINT fk_team FOREIGN KEY (id_team) REFERENCES teams(id);*/

INSERT INTO users (name, dept, inv_code)
 VALUES
 ('bao', 'cs','a123456'),
 ('leau', 'cs','a123456'),
 ('tommy', 'cs','a123456');

INSERT INTO teams (name, subject, out_game)
 VALUES
 ('team1', 'we are the best', '0'),
 ('team2', 'YOHOHO','0'),
 ('team3', 'blablabla','1');

INSERT INTO rounds (id, status, inv_code)
 VALUES
 ('1','finished','B123456'),
 ('2','finished','123456'),
 ('3','in_progress','a123456');
 
INSERT INTO results (result,prize)
 VALUES
 ('pass', '25000'),
 ('pass', '98000'),
 ('fail', '0'),
 ('pass', '30000'),
 ('pass', '59900'),
 ('pass', '0'),
 ('pass', '0');
 
 INSERT INTO team_results (id_result,id_team,id_round)
 VALUES
 ('1', '1', '1'),
 ('2', '2', '1'),
 ('3', '3', '1'),
 ('4', '1', '2'),
 ('5', '2', '2'),
 ('6', '1', '3'),
 ('7', '2', '3');

 

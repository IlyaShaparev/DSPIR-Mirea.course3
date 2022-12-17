CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT,DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS users (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    login VARCHAR(20) NOT NULL,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'ivan', 'ivan') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Alex' AND password = '123'
) LIMIT 1;

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Bob', '234') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Bob' AND password = '234'
) LIMIT 1;

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Alex', '345') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Alex' AND password = '345'
) LIMIT 1;

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Kate', '456') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Kate' AND password = '456'
) LIMIT 1;

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'Lilo', '567') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login = 'Lilo' AND password = '567'
) LIMIT 1;





CREATE TABLE IF NOT EXISTS elap (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    discipline VARCHAR(20) NOT NULL,
    mark INT NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO elap (discipline, mark)
SELECT * FROM (SELECT 'Mathematic', '5') AS tmp
WHERE NOT EXISTS (
    SELECT discipline FROM elap WHERE discipline = 'Mathematic' AND mark = '5'
) LIMIT 1;

INSERT INTO elap (discipline, mark)
SELECT * FROM (SELECT 'Enlish', '3') AS tmp
WHERE NOT EXISTS (
    SELECT discipline FROM elap WHERE discipline = 'Enlish' AND mark = '3'
) LIMIT 1;

INSERT INTO elap (discipline, mark)
SELECT * FROM (SELECT 'RSCHIR', '4') AS tmp
WHERE NOT EXISTS (
    SELECT discipline FROM elap WHERE discipline = 'RSCHIR' AND mark = '4'
) LIMIT 1;

INSERT INTO elap (discipline, mark)
SELECT * FROM (SELECT 'RKCHIR', '5') AS tmp
WHERE NOT EXISTS (
    SELECT discipline FROM elap WHERE discipline = 'RKCHIR' AND mark = '5'
) LIMIT 1;

INSERT INTO elap (discipline, mark)
SELECT * FROM (SELECT 'History', '4') AS tmp
WHERE NOT EXISTS (
    SELECT discipline FROM elap WHERE discipline = 'History' AND mark = '4'
) LIMIT 1;
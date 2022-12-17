CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS users (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(20) NOT NULL,
  password VARCHAR(40) NOT NULL,
  PRIMARY KEY (ID)
);



CREATE TABLE IF NOT EXISTS products (
  ID INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  price INTEGER,
  PRIMARY KEY (ID)
);

INSERT INTO users (login, password)
SELECT * FROM (SELECT 'ilya', '{SHA}QL0AFWMIX8NRZTKeof9cXsvbvu8=') AS tmp
WHERE NOT EXISTS (
    SELECT login FROM users WHERE login='ilya' AND password='123'
) LIMIT 1;

INSERT INTO products (name, price)
SELECT * FROM (SELECT 'Doski Duba', 200) AS tmp
WHERE NOT EXISTS (
    SELECT name FROM products WHERE name = 'Doski Duba' AND price = 200
) LIMIT 1;

INSERT INTO products (name, price)
SELECT * FROM (SELECT 'Doski Akatsii', 600) AS tmp
WHERE NOT EXISTS (
    SELECT name FROM products WHERE name = 'Doski Akatsii' AND price = 600
) LIMIT 1;

INSERT INTO products (name, price)
SELECT * FROM (SELECT 'Rasporki', 300) AS tmp
WHERE NOT EXISTS (
    SELECT name FROM products WHERE name = 'Rasporki' AND price = 300
) LIMIT 1;

INSERT INTO products (name, price)
SELECT * FROM (SELECT 'Doski Sosni', 150) AS tmp
WHERE NOT EXISTS (
    SELECT name FROM products WHERE name = 'Doski Sosni' AND price = 150
) LIMIT 1;

INSERT INTO products (name, price)
SELECT * FROM (SELECT 'Kirpich', 38) AS tmp
WHERE NOT EXISTS (
    SELECT name FROM products WHERE name = 'Kirpich' AND price = 38
) LIMIT 1;
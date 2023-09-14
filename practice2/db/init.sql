CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT,UPDATE,INSERT, DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS item (
  id INT(11) AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  price INT NOT NULL,
  PRIMARY KEY (ID)
);

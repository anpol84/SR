CREATE DATABASE IF NOT EXISTS appDB;
CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT SELECT, UPDATE, INSERT, DELETE ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;

USE appDB;
CREATE TABLE IF NOT EXISTS waiter (
  id INT(11) AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  salary INT(11) NOT NULL,
  PRIMARY KEY (id)
);
CREATE TABLE IF NOT EXISTS client (
  id INT(11) AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  table_number INT(11) NOT NULL,
  waiter_id INT(11),
  PRIMARY KEY (id),
  FOREIGN KEY (waiter_id) REFERENCES waiter(id) ON DELETE SET NULL
);

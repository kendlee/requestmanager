CREATE DATABASE IF NOT EXISTS request_manager;
USE request_manager;
CREATE TABLE IF NOT EXISTS users (
  id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  username VARCHAR( 64 ) NOT NULL ,
  password VARCHAR( 64 ) NOT NULL ,
  real_name VARCHAR( 100 ) NOT NULL ,
  UNIQUE (
    username
  )
);

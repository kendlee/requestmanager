CREATE DATABASE IF NOT EXISTS request_manager;
USE request_manager;
CREATE TABLE IF NOT EXISTS users (
  id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  username VARCHAR( 64 ) NOT NULL ,
  password VARCHAR( 64 ) NOT NULL ,
  real_name VARCHAR( 100 ) NOT NULL ,
  type TINYINT NOT NULL,
  UNIQUE (
    username
  )
);

CREATE TABLE IF NOT EXISTS residents (
  id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  name VARCHAR( 100 ) NOT NULL ,
  address VARCHAR( 255 ),
  sex TINYINT VARCHAR ( 1 ),
  status TINYINT VARCHAR ( 1 ),
  precinct VARCHAR ( 10 ),
  birthday DATE,
  barangay VARCHAR ( 100 ),
  category INT(), /*to categorize residents*/
  requests INT( 3 ) DEFAULT 0, /*for faster queries, simply tracks the number of requests*/
  remarks VARCHAR ( 255 )
  UNIQUE (
    name
  )
);
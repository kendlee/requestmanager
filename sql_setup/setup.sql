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
  sex VARCHAR ( 1 ),
  status VARCHAR ( 1 ),
  precinct VARCHAR ( 10 ),
  birthday DATE,
  barangay VARCHAR ( 100 ),
  category INT( 1 ), /*to categorize residents*/
  requests INT( 3 ) DEFAULT 0, /*for faster queries, simply tracks the number of requests*/
  remarks VARCHAR ( 255 )
  /*UNIQUE (
    name
  )*/
);

CREATE TABLE IF NOT EXISTS requests (
  id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  create_user_id int ( 11 ),
  FOREIGN KEY (create_user_id) REFERENCES users(id),
  creation_date DATE,
  mod_user_id int ( 11 ),
  FOREIGN KEY (mod_user_id) REFERENCES users(id),
  modified_date DATE,
  resident_id int ( 11 ),
  FOREIGN KEY (resident_id) REFERENCES residents(id),
  description VARCHAR ( 255 ),
  status VARCHAR ( 15 ),
  remarks VARCHAR ( 255 )
);
CREATE DATABASE IF NOT EXISTS webdb;

USE webdb;

CREATE TABLE IF NOT EXISTS users (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  username varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  password varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  email varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  extra_json varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE (username)
);

set sql_mode='ALLOW_INVALID_DATES';

CREATE TABLE IF NOT EXISTS activities (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  abbr varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  begin_date timestamp NOT NULL,
  end_date timestamp NOT NULL,
  PRIMARY KEY (id),
  UNIQUE (name)
);

commit;


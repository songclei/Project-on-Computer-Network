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

CREATE TABLE IF NOT EXISTS activities (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  abbr varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  begin_date date NOT NULL,
  end_date date NOT NULL,
  PRIMARY KEY (id)
);

commit;

CREATE DATABASE IF NOT EXISTS moviedb;

USE moviedb;

CREATE TABLE IF NOT EXISTS movies (
	id int AUTO_INCREMENT PRIMARY KEY,
	name varchar(100) UNIQUE NOT NULL,
	genre varchar(100) NOT NULL,
	studio varchar(50) NOT NULL,
	audience_rating int NOT NULL,
	release_year varchar(4) NOT NULL
);

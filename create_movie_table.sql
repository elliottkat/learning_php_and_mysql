CREATE DATABASE IF NOT EXISTS moviedb;

USE moviedb;

CREATE TABLE IF NOT EXISTS Movies (
	MovieId int AUTO_INCREMENT PRIMARY KEY,
	MovieName varchar(100) NOT NULL,
	Genre varchar(100) NOT NULL,
	LeadStudio varchar(50) NOT NULL,
	AudienceRating int NOT NULL,
	ReleaseYear varchar(4) NOT NULL
);

CREATE DATABASE IF NOT EXISTS moviedb;

USE moviedb;

CREATE TABLE IF NOT EXISTS Movies (
	MovieId int NOT NULL AUTO_INCREMENT,
	MovieName varchar(100),
	Genre varchar(100),
	LeadStudio varchar(50),
	AudienceRating int,
	ReleaseYear varchar(4),
	PRIMARY KEY (MovieId)
);

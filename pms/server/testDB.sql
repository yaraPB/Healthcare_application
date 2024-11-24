-- Just a test DB for log and registration

DROP DATABASE IF EXISTS testDB;
CREATE DATABASE testDB;
USE testDB;

CREATE TABLE Patient(
	id INT PRIMARY KEY AUTO_INCREMENT,
    EMAIL VARCHAR(30) NOT NULL,
    PASSWORD VARCHAR(30) NOT NULL
);

INSERT INTO PATIENT(EMAIL, PASSWORD) VALUES
('Alice@doe.com', 'one'),
('Bob@fii.com', 'two'),
('Colt@zeken.com', 'three');
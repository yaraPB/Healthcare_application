DROP DATABASE IF EXISTS pms_db;
CREATE DATABASE pms_db;
USE pms_db;

CREATE TABLE Patient(
	Pat_id INT PRIMARY KEY,
    Pat_Fname VARCHAR(30) NOT NULL,
    Pat_Lname VARCHAR(30) NOT NULL,
    Pat_Role VARCHAR(30) NOT NULL
);

INSERT INTO Patient (Pat_id, Pat_Fname, Pat_Lname, Pat_Role) VALUES
(1, 'Alice', 'Johnson', 'Patient'),
(2, 'Michael', 'Davis', 'Patient'),
(3, 'Sophia', 'Lee', 'Patient'),
(4, 'James', 'Wilson', 'Patient'),
(5, 'Olivia', 'Garcia', 'Patient');

CREATE TABLE Medication(
	Med_id INT PRIMARY KEY,
    Med_q INT NOT NULL, 
    Med_name VARCHAR(30) NOT NULL, 
    Med_exp DATE NOT NULL
);

INSERT INTO Medication (Med_id, Med_q, Med_name, Med_exp) VALUES
(1, 108, 'Ibuprofen', '2025-01-15'),
(2, 54, 'Amoxicillin', '2024-12-01'),
(3, 252, 'Aspirin', '2025-06-30'),
(4, 153, 'Paracetamol', '2025-05-20');

CREATE TABLE DOCTOR(
	Doc_id INT PRIMARY KEY,
    Doc_Fname VARCHAR(30) NOT NULL,
    Doc_Lname VARCHAR(30) NOT NULL,
    Doc_availability BOOLEAN
);

INSERT INTO DOCTOR values
(1, 'John', 'Smith', TRUE),
(2, 'Emily', 'Brown', FALSE),
(3, 'Alice', 'Jane', TRUE);


CREATE TABLE Appointment(
	Apt_id INT PRIMARY KEY,  -- SINCE THERE WILL BE MULTIPLE PRIMARY KEYS
    Pat_id INT NOT NULL,
	Doc_id INT NOT NULL,
    Apt_date DATE NOT NULL
);

INSERT INTO Appointment (Apt_id, Pat_id, Doc_id, Apt_date) VALUES
(1, 1, 1, '2024-10-20'),
(2, 2, 3, '2024-10-21'),
(3, 3, 2, '2024-10-22'),
(4, 4, 1, '2024-10-23'),
(5, 1, 3, '2024-10-24'),
(6, 1, 2, '2024-10-25');

CREATE TABLE Prescription(
	Doc_id INT NOT NULL,
    Med_id INT NOT NULL,
    Dosage FLOAT NOT NULL, 
    PRIMARY KEY (Doc_id, Med_id)
);

INSERT INTO Prescription (Doc_id, Med_id, Dosage) VALUES
(1, 1, 200),
(2, 2, 500),
(3, 3, 100),
(1, 4, 250),
(3, 2, 400),
(2, 3, 300);

CREATE TABLE Treatment(
	Pat_id INT NOT NULL,
    Med_id INT NOT NULL,
    num_days_treatment INT NOT NULL, 
    PRIMARY KEY (Pat_id, Med_id)
);

INSERT INTO Treatment (Pat_id, Med_id, num_days_treatment) VALUES
(1, 1, 15),
(1, 2, 30), 
(2, 1, 15), 
(3, 3, 60), 
(4, 1, 20), 
(5, 4, 45), 
(1, 3, 10);

ALTER TABLE Prescription
ADD constraint prescribe
FOREIGN KEY (Doc_id) REFERENCES Doctor(Doc_id);

ALTER TABLE Prescription
ADD constraint is_prescribed
FOREIGN KEY (Med_id) REFERENCES Medication(Med_id);

ALTER TABLE Treatment
ADD constraint is_taking
FOREIGN KEY (Pat_id) REFERENCES Patient(Pat_id);

ALTER TABLE Treatment
ADD constraint is_taken
FOREIGN KEY (Med_id) REFERENCES Medication(Med_id);

ALTER TABLE Appointment
ADD constraint attends 
FOREIGN KEY (Pat_id) references Patient(Pat_id);

ALTER TABLE Appointment
ADD constraint conduct
FOREIGN KEY (Doc_id) references Doctor(Doc_id);
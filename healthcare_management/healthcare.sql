DROP DATABASE IF EXISTS healthcare;
CREATE DATABASE healthcare;
USE healthcare;

CREATE TABLE patient(
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_last_name varchar(64) NOT NULL,
    patient_first_name varchar(64) NOT NULL,
    patient_phone varchar(10) NOT NULL UNIQUE,
    patient_email varchar(64) NOT NULL UNIQUE
);

CREATE TABLE doctor(
    doctor_id INT PRIMARY KEY AUTO_INCREMENT,
    doctor_last_name varchar(64) NOT NULL,
    doctor_first_name varchar(64) NOT NULL,
    doctor_speciality varchar(64) NOT NULL
);

CREATE TABLE APPOINTMENT(
    appointment_id INT PRIMARY KEY AUTO_INCREMENT,
    appointment_date DATETIME NOT NULL,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    CONSTRAINT has_appointment 
    FOREIGN KEY (patient_id)
    REFERENCES patient(patient_id),
    CONSTRAINT gives_appointment 
    FOREIGN KEY (doctor_id)
    REFERENCES doctor(doctor_id)
);

INSERT INTO patient (patient_last_name, patient_first_name, patient_phone, patient_email) VALUES
('Smith', 'John', '1234567890', 'john.smith@gmail.com'),
('Doe', 'Jane', '2345678901', 'jane.doe@yahoo.com'),
('Brown', 'James', '3456789012', 'james.brown@hotmail.com'),
('Johnson', 'Emily', '4567890123', 'emily.johnson@outlook.com'),
('Taylor', 'Michael', '5678901234', 'michael.taylor@gmail.com'),
('Lee', 'Sarah', '6789012345', 'sarah.lee@yahoo.com'),
('Wilson', 'David', '7890123456', 'david.wilson@hotmail.com'),
('Clark', 'Emma', '8901234567', 'emma.clark@outlook.com'),
('Davis', 'Chris', '9012345678', 'chris.davis@gmail.com'),
('Lopez', 'Sophia', '0123456789', 'sophia.lopez@yahoo.com');

INSERT INTO doctor (doctor_last_name, doctor_first_name, doctor_speciality) VALUES
('Adams', 'William', 'Cardiology'),
('Brown', 'Olivia', 'Dermatology'),
('Clark', 'Ethan', 'Neurology'),
('Davis', 'Isabella', 'Cardiology'),
('Evans', 'Mason', 'Radiology'),
('Garcia', 'Mia', 'Neurology'),
('Hall', 'Logan', 'General Medicine'),
('Jones', 'Ava', 'Psychiatry'),
('King', 'Liam', 'Cardiology'),
('Lopez', 'Charlotte', 'General Medicine');

INSERT INTO appointment (appointment_date, patient_id, doctor_id) VALUES
('2024-12-05 09:00:00', 1, 9),
('2024-12-05 10:30:00', 3, 7),
('2024-12-06 11:00:00', 2, 3),
('2024-12-06 14:00:00', 1, 4),
('2024-12-07 09:30:00', 5, 6),
('2024-12-07 13:00:00', 9, 6),
('2024-12-08 08:00:00', 7, 7),
('2024-12-08 15:00:00', 1, 5),
('2024-12-09 10:00:00', 9, 9),
('2024-12-09 16:00:00', 10, 4);
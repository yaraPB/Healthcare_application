DROP DATABASE IF EXISTS healthcare;
CREATE DATABASE healthcare;
USE healthcare;

CREATE TABLE patient(
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_last_name varchar(64) NOT NULL,
    patient_first_name varchar(64) NOT NULL,
    patient_phone varchar(10) NOT NULL UNIQUE,
    patient_email varchar(64) NOT NULL UNIQUE,
    patient_password varchar(64) NOT NULL
);

CREATE TABLE doctor(
    doctor_id INT PRIMARY KEY AUTO_INCREMENT,
    doctor_last_name varchar(64) NOT NULL,
    doctor_first_name varchar(64) NOT NULL,
    doctor_speciality varchar(64) NOT NULL
);

CREATE TABLE APPOINTMENT(
    appointment_id INT PRIMARY KEY AUTO_INCREMENT,
    appointment_date_beg DATETIME NOT NULL,
    appointment_date_end DATETIME NOT NULL,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    CONSTRAINT has_appointment 
    FOREIGN KEY (patient_id)
    REFERENCES patient(patient_id)
    ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT gives_appointment 
    FOREIGN KEY (doctor_id)
    REFERENCES doctor(doctor_id)
    ON UPDATE CASCADE ON DELETE CASCADE
);


-- Trigger to check availability and prevent conflicts
DELIMITER $$

CREATE TRIGGER before_appointment_insert
BEFORE INSERT ON appointment
FOR EACH ROW
BEGIN
    -- Check if the doctor is already booked for the time range
    IF EXISTS (
        SELECT 1
        FROM appointment
        WHERE doctor_id = NEW.doctor_id
        AND ((NEW.appointment_date_beg BETWEEN appointment_date_beg AND appointment_date_end)
             OR (NEW.appointment_date_end BETWEEN appointment_date_beg AND appointment_date_end)
             OR (appointment_date_beg BETWEEN NEW.appointment_date_beg AND NEW.appointment_date_end)
             OR (appointment_date_end BETWEEN NEW.appointment_date_beg AND NEW.appointment_date_end))
    ) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'The doctor is unavailable for this time slot.';
    END IF;

    -- Check if the patient already has an appointment for the time range
    IF EXISTS (
        SELECT 1
        FROM appointment
        WHERE patient_id = NEW.patient_id
        AND ((NEW.appointment_date_beg BETWEEN appointment_date_beg AND appointment_date_end)
             OR (NEW.appointment_date_end BETWEEN appointment_date_beg AND appointment_date_end)
             OR (appointment_date_beg BETWEEN NEW.appointment_date_beg AND NEW.appointment_date_end)
             OR (appointment_date_end BETWEEN NEW.appointment_date_beg AND NEW.appointment_date_end))
    ) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'The patient is unavailable for this time slot.';
    END IF;

    -- Set the appointment end time to 30 minutes after the start time
    SET NEW.appointment_date_end = DATE_ADD(NEW.appointment_date_beg, INTERVAL 30 MINUTE);
END $$

INSERT INTO patient (patient_last_name, patient_first_name, patient_phone, patient_email, patient_password) VALUES
('Smith', 'John', '1234567890', 'john.smith@gmail.com', 'somepassword'),
('Doe', 'Jane', '2345678901', 'jane.doe@yahoo.com', '12345'),
('Brown', 'James', '3456789012', 'james.brown@hotmail.com', 'passpass'),
('Johnson', 'Emily', '4567890123', 'emily.johnson@outlook.com', '567pass'),
('Taylor', 'Michael', '5678901234', 'michael.taylor@gmail.com', 'sdsxz'),
('Lee', 'Sarah', '6789012345', 'sarah.lee@yahoo.com', 'really_123'),
('Wilson', 'David', '7890123456', 'david.wilson@hotmail.com', 'csdad'),
('Clark', 'Emma', '8901234567', 'emma.clark@outlook.com', '01234'),
('Davis', 'Chris', '9012345678', 'chris.davis@gmail.com', 'passing_word'),
('Lopez', 'Sophia', '0123456789', 'sophia.lopez@yahoo.com', 'somepassword');

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
('Kurt', 'James', 'General Medicine'),
('Jones', 'Arthur', 'Cardiology'),
('Larson', 'Martha', 'Pediatry'),
('Heartstone', 'Alice', 'Cardiology'),
('Lopez', 'Charlotte', 'General Medicine');

INSERT INTO appointment (appointment_date_beg, appointment_date_end, patient_id, doctor_id) VALUES
('2024-12-05 09:00:00', '2024-12-07 09:30:00', 1, 9),
('2024-12-05 10:30:00', '2024-12-05 11:00:00', 3, 7),
('2024-12-06 11:00:00', '2024-12-06 11:30:00', 2, 3),
('2024-12-06 14:00:00', '2024-12-06 14:30:00', 1, 4),
('2024-12-07 09:30:00', '2024-12-07 10:00:00', 5, 6),
('2024-12-07 13:00:00', '2024-12-07 13:30:00', 9, 6),
('2024-12-08 08:00:00', '2024-12-08 08:30:00', 7, 7),
('2024-12-08 15:00:00', '2024-12-27 15:30:00', 1, 5),
('2024-12-09 10:30:00', '2024-12-09 11:00:00', 9, 9),
('2024-12-09 16:00:00', '2024-12-09 16:30:00', 10, 4);
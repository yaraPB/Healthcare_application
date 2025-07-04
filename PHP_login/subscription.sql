DROP DATABASE IF EXISTS LOGIN;
CREATE DATABASE LOGIN;
USE LOGIN;

CREATE TABLE CUSTOMER(
	CUS_ID INT AUTO_INCREMENT PRIMARY KEY,
    CUS_FIRST_NAME VARCHAR(64) NOT NULL,
    CUS_LAST_NAME VARCHAR(64) NOT NULL,
    CUS_INITIAL VARCHAR(1),
	CUS_AREA_CODE INT,
    CUS_PHONE VARCHAR(8) UNIQUE NOT NULL,
    CONSTRAINT chk_area_code CHECK (CUS_AREA_CODE BETWEEN 100 AND 999)
);
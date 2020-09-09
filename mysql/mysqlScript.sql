CREATE USER 'database_user'@'localhost' IDENTIFIED BY 'user_password';
GRANT ALL PRIVILEGES ON *.* TO 'database_user'@'localhost';
CREATE DATABASE database_name;
USE database_name;
CREATE TABLE appointmentTable (username VARCHAR(20), doctor VARCHAR(20), time DATETIME);
CREATE TABLE doctorTable (doctor VARCHAR(20), specialization VARCHAR(20), rating VARCHAR(20));

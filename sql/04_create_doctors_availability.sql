CREATE TABLE IF NOT EXISTS doctors_availability(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    doctors_id INT NOT NULL,
    weekday INT NOT NULL,
    daytime TIME NOT NULL,

    FOREIGN KEY (doctors_id) REFERENCES doctors(id)
);

CREATE TABLE IF NOT EXISTS appointments(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    doctors_id INT NOT NULL,
    users_id INT NOT NULL,
    timeslot DATETIME NOT NULL,

    FOREIGN KEY (users_id) REFERENCES users(id),
    FOREIGN KEY (doctors_id) REFERENCES doctors(id)
);

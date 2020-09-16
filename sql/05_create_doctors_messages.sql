CREATE TABLE IF NOT EXISTS doctors_messages(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    details VARCHAR(500) NOT NULL,
    introduction VARCHAR(100) NOT NULL,
    doctors_id INT NOT NULL UNIQUE,
    users_id INT NOT NULL,

    FOREIGN KEY (doctors_id) REFERENCES doctors(id),
    FOREIGN KEY (users_id) REFERENCES users(id)
);
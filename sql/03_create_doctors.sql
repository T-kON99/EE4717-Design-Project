CREATE TABLE IF NOT EXISTS doctors (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    rating DOUBLE DEFAULT 0.0,
    address VARCHAR(100) NOT NULL,
    image_link VARCHAR(100) NOT NULL,
    user_id INT NOT NULL UNIQUE,
    category_id INT NOT NULL,

    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
CREATE DATABASE IF NOT EXISTS user_status;
USE user_status;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    age INT,
    status TINYINT(1)
);

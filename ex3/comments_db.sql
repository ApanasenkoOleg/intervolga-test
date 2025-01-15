CREATE DATABASE comments_db;

USE comments_db;

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL
);
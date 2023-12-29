-- Create the 'photo_gallery' database
CREATE DATABASE IF NOT EXISTS photo_gallery;
USE photo_gallery;
-- Create a 'photos' table
CREATE TABLE IF NOT EXISTS photos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    path VARCHAR(255) NOT NULL
);
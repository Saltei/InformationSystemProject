CREATE DATABASE batch;
USE batch;

-- Media types
CREATE TABLE media (
    media_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    base_type VARCHAR(100),
    stock INT DEFAULT 0
);

-- Supplements like FBS, L-glutamine
CREATE TABLE supplements (
    supplement_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    supplier VARCHAR(100),
    concentration VARCHAR(50),
    stock INT DEFAULT 0
);

-- which supplement is used in which media
CREATE TABLE media_supplements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    media_id INT,
    supplement_id INT,
    amount_used VARCHAR(50),
    FOREIGN KEY (media_id) REFERENCES media(media_id) ON DELETE CASCADE,
    FOREIGN KEY (supplement_id) REFERENCES supplements(supplement_id) ON DELETE CASCADE
);

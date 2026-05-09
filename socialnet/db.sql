-- SocialNet Database Setup
-- Run this script to initialize the database

CREATE DATABASE IF NOT EXISTS socialnet
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE socialnet;

CREATE TABLE IF NOT EXISTS account (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username    VARCHAR(50)  NOT NULL UNIQUE,
    fullname    VARCHAR(100) NOT NULL,
    password    VARCHAR(255) NOT NULL,          -- bcrypt hash
    description TEXT         DEFAULT NULL,
    created_at  DATETIME     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional: seed an initial admin-created demo user (password: demo1234)
-- INSERT INTO account (username, fullname, password, description)
-- VALUES ('demo', 'Demo User', '$2y$12$...', 'Hello, I am a demo user!');
-- Tạo database
CREATE DATABASE IF NOT EXISTS socialnet;
USE socialnet;

-- Tạo bảng account
CREATE TABLE IF NOT EXISTS account (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    fullname VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    description TEXT
);

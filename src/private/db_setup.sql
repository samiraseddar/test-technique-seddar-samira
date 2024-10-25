CREATE DATABASE IF NOT EXISTS testdb;
USE testdb;

CREATE TABLE utilisateurs (
    id INT PRIMARY KEY,
    nom VARCHAR(255),
    ca DECIMAL(10, 2),
    aattainment_rate DECIMAL(10, 2)
);
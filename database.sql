CREATE DATABASE IF NOT EXISTS cih_bank;
USE cih_bank;

-- Adresse Table
CREATE TABLE adresse (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ville VARCHAR(50),
    quartier VARCHAR(50),
    rue VARCHAR(50),
    code_postal VARCHAR(10),
    email VARCHAR(50),
    telephone INT
);

-- Bank Table
CREATE TABLE bank (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(20) UNIQUE,
    bank_logo VARCHAR(100)
);

-- Agence Table
CREATE TABLE agence (
    id INT PRIMARY KEY AUTO_INCREMENT,
    longitude DECIMAL(9,6),
    latitude DECIMAL(9,6),
    bank_id INT,
    FOREIGN KEY (bank_id) REFERENCES bank(id)
);

-- Distributeur Table
CREATE TABLE distributeur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    longitude DECIMAL(9,6),
    latitude DECIMAL(9,6),
    agence_id INT,
    FOREIGN KEY (agence_id) REFERENCES agence(id)
);

-- User Table
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usersnames VARCHAR(50) UNIQUE,
    passwords VARCHAR(255),
    adresse_id INT,
    FOREIGN KEY (adresse_id) REFERENCES adresse(id)
);

-- Role Table
CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE
);


-- Account Table
CREATE TABLE account (
    id INT PRIMARY KEY AUTO_INCREMENT,
    rib VARCHAR(20),
    devise VARCHAR(10),
    balance DECIMAL(10,2),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(id)
);

-- Transaction Table
CREATE TABLE transaction (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type ENUM('credit', 'debit'),
    amount DECIMAL(10,2),
    account_id INT,
    FOREIGN KEY (account_id) REFERENCES account(id)
);
CREATE TABLE users(
    Id int PRIMARY KEY AUTO_INCREMENT,
    Username varchar(200),
    Email varchar(200),
    Age int,
    Password varchar(200)
);

ALTER TABLE users ADD Saldo DECIMAL(10, 2) DEFAULT 0.00;
